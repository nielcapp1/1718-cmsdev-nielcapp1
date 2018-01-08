<?php

namespace Drupal\university\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\university\Entity\StudentInterface;

/**
 * Class StudentController.
 *
 *  Returns responses for Student routes.
 */
class StudentController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Student  revision.
   *
   * @param int $student_revision
   *   The Student  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($student_revision) {
    $student = $this->entityManager()->getStorage('student')->loadRevision($student_revision);
    $view_builder = $this->entityManager()->getViewBuilder('student');

    return $view_builder->view($student);
  }

  /**
   * Page title callback for a Student  revision.
   *
   * @param int $student_revision
   *   The Student  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($student_revision) {
    $student = $this->entityManager()->getStorage('student')->loadRevision($student_revision);
    return $this->t('Revision of %title from %date', ['%title' => $student->label(), '%date' => format_date($student->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Student .
   *
   * @param \Drupal\university\Entity\StudentInterface $student
   *   A Student  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(StudentInterface $student) {
    $account = $this->currentUser();
    $langcode = $student->language()->getId();
    $langname = $student->language()->getName();
    $languages = $student->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $student_storage = $this->entityManager()->getStorage('student');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $student->label()]) : $this->t('Revisions for %title', ['%title' => $student->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all student revisions") || $account->hasPermission('administer student entities')));
    $delete_permission = (($account->hasPermission("delete all student revisions") || $account->hasPermission('administer student entities')));

    $rows = [];

    $vids = $student_storage->revisionIds($student);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\university\StudentInterface $revision */
      $revision = $student_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $student->getRevisionId()) {
          $link = $this->l($date, new Url('entity.student.revision', ['student' => $student->id(), 'student_revision' => $vid]));
        }
        else {
          $link = $student->link($date);
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
              Url::fromRoute('entity.student.translation_revert', ['student' => $student->id(), 'student_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.student.revision_revert', ['student' => $student->id(), 'student_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.student.revision_delete', ['student' => $student->id(), 'student_revision' => $vid]),
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

    $build['student_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
