<?php

namespace Drupal\university;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface InstructorStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Instructor revision IDs for a specific Instructor.
   *
   * @param \Drupal\university\Entity\InstructorInterface $entity
   *   The Instructor entity.
   *
   * @return int[]
   *   Instructor revision IDs (in ascending order).
   */
  public function revisionIds(InstructorInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Instructor author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Instructor revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\university\Entity\InstructorInterface $entity
   *   The Instructor entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(InstructorInterface $entity);

  /**
   * Unsets the language for all Instructor with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
