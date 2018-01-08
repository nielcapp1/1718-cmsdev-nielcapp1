<?php

namespace Drupal\university\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\university\Entity\InstructorInterface;

/**
 * Class InstructorController.
 *
 *  Returns responses for Instructor routes.
 */
class InstructorController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Instructor  revision.
   *
   * @param int $instructor_revision
   *   The Instructor  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($instructor_revision) {
    $instructor = $this->entityManager()->getStorage('instructor')->loadRevision($instructor_revision);
    $view_builder = $this->entityManager()->getViewBuilder('instructor');

    return $view_builder->view($instructor);
  }

  /**
   * Page title callback for a Instructor  revision.
   *
   * @param int $instructor_revision
   *   The Instructor  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($instructor_revision) {
    $instructor = $this->entityManager()->getStorage('instructor')->loadRevision($instructor_revision);
    return $this->t('Revision of %title from %date', ['%title' => $instructor->label(), '%date' => format_date($instructor->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Instructor .
   *
   * @param \Drupal\university\Entity\InstructorInterface $instructor
   *   A Instructor  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(InstructorInterface $instructor) {
    $account = $this->currentUser();
    $langcode = $instructor->language()->getId();
    $langname = $instructor->language()->getName();
    $languages = $instructor->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $instructor_storage = $this->entityManager()->getStorage('instructor');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $instructor->label()]) : $this->t('Revisions for %title', ['%title' => $instructor->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all instructor revisions") || $account->hasPermission('administer instructor entities')));
    $delete_permission = (($account->hasPermission("delete all instructor revisions") || $account->hasPermission('administer instructor entities')));

    $rows = [];

    $vids = $instructor_storage->revisionIds($instructor);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\university\InstructorInterface $revision */
      $revision = $instructor_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $instructor->getRevisionId()) {
          $link = $this->l($date, new Url('entity.instructor.revision', ['instructor' => $instructor->id(), 'instructor_revision' => $vid]));
        }
        else {
          $link = $instructor->link($date);
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
              Url::fromRoute('entity.instructor.translation_revert', ['instructor' => $instructor->id(), 'instructor_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.instructor.revision_revert', ['instructor' => $instructor->id(), 'instructor_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.instructor.revision_delete', ['instructor' => $instructor->id(), 'instructor_revision' => $vid]),
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

    $build['instructor_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
