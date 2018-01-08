<?php

namespace Drupal\university\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\university\Entity\InstitutionInterface;

/**
 * Class InstitutionController.
 *
 *  Returns responses for Institution routes.
 */
class InstitutionController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Institution  revision.
   *
   * @param int $institution_revision
   *   The Institution  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($institution_revision) {
    $institution = $this->entityManager()->getStorage('institution')->loadRevision($institution_revision);
    $view_builder = $this->entityManager()->getViewBuilder('institution');

    return $view_builder->view($institution);
  }

  /**
   * Page title callback for a Institution  revision.
   *
   * @param int $institution_revision
   *   The Institution  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($institution_revision) {
    $institution = $this->entityManager()->getStorage('institution')->loadRevision($institution_revision);
    return $this->t('Revision of %title from %date', ['%title' => $institution->label(), '%date' => format_date($institution->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Institution .
   *
   * @param \Drupal\university\Entity\InstitutionInterface $institution
   *   A Institution  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(InstitutionInterface $institution) {
    $account = $this->currentUser();
    $langcode = $institution->language()->getId();
    $langname = $institution->language()->getName();
    $languages = $institution->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $institution_storage = $this->entityManager()->getStorage('institution');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $institution->label()]) : $this->t('Revisions for %title', ['%title' => $institution->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all institution revisions") || $account->hasPermission('administer institution entities')));
    $delete_permission = (($account->hasPermission("delete all institution revisions") || $account->hasPermission('administer institution entities')));

    $rows = [];

    $vids = $institution_storage->revisionIds($institution);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\university\InstitutionInterface $revision */
      $revision = $institution_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $institution->getRevisionId()) {
          $link = $this->l($date, new Url('entity.institution.revision', ['institution' => $institution->id(), 'institution_revision' => $vid]));
        }
        else {
          $link = $institution->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.institution.translation_revert', ['institution' => $institution->id(), 'institution_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.institution.revision_revert', ['institution' => $institution->id(), 'institution_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.institution.revision_delete', ['institution' => $institution->id(), 'institution_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['institution_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
