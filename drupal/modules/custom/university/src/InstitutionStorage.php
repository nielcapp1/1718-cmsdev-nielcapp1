<?php

namespace Drupal\university;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\university\Entity\InstitutionInterface;

/**
 * Defines the storage handler class for Institution entities.
 *
 * This extends the base storage class, adding required special handling for
 * Institution entities.
 *
 * @ingroup university
 */
class InstitutionStorage extends SqlContentEntityStorage implements InstitutionStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(InstitutionInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {institution_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {institution_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(InstitutionInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {institution_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('institution_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
