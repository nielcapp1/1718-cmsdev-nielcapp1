<?php

namespace Drupal\university;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\university\Entity\InstructorInterface;

/**
 * Defines the storage handler class for Instructor entities.
 *
 * This extends the base storage class, adding required special handling for
 * Instructor entities.
 *
 * @ingroup university
 */
class InstructorStorage extends SqlContentEntityStorage implements InstructorStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(InstructorInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {instructor_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {instructor_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(InstructorInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {instructor_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('instructor_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
