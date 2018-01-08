<?php

namespace Drupal\university;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface InstitutionStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Institution revision IDs for a specific Institution.
   *
   * @param \Drupal\university\Entity\InstitutionInterface $entity
   *   The Institution entity.
   *
   * @return int[]
   *   Institution revision IDs (in ascending order).
   */
  public function revisionIds(InstitutionInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Institution author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Institution revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\university\Entity\InstitutionInterface $entity
   *   The Institution entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(InstitutionInterface $entity);

  /**
   * Unsets the language for all Institution with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
