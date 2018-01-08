<?php

namespace Drupal\university;

use Drupal\Core\Entity\ContentEntityStorageInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\university\Entity\StudentInterface;

/**
 * Defines the storage handler class for Student entities.
 *
 * This extends the base storage class, adding required special handling for
 * Student entities.
 *
 * @ingroup university
 */
interface StudentStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Student revision IDs for a specific Student.
   *
   * @param \Drupal\university\Entity\StudentInterface $entity
   *   The Student entity.
   *
   * @return int[]
   *   Student revision IDs (in ascending order).
   */
  public function revisionIds(StudentInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Student author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Student revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\university\Entity\StudentInterface $entity
   *   The Student entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(StudentInterface $entity);

  /**
   * Unsets the language for all Student with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
