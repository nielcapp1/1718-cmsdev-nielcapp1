<?php

namespace Drupal\university\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Institution entities.
 *
 * @ingroup university
 */
interface InstitutionInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Institution name.
   *
   * @return string
   *   Name of the Institution.
   */
  public function getName();

  /**
   * Sets the Institution name.
   *
   * @param string $name
   *   The Institution name.
   *
   * @return \Drupal\university\Entity\InstitutionInterface
   *   The called Institution entity.
   */
  public function setName($name);

  /**
   * Gets the Institution creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Institution.
   */
  public function getCreatedTime();

  /**
   * Sets the Institution creation timestamp.
   *
   * @param int $timestamp
   *   The Institution creation timestamp.
   *
   * @return \Drupal\university\Entity\InstitutionInterface
   *   The called Institution entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Institution published status indicator.
   *
   * Unpublished Institution are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Institution is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Institution.
   *
   * @param bool $published
   *   TRUE to set this Institution to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\university\Entity\InstitutionInterface
   *   The called Institution entity.
   */
  public function setPublished($published);

  /**
   * Gets the Institution revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Institution revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\university\Entity\InstitutionInterface
   *   The called Institution entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Institution revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Institution revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\university\Entity\InstitutionInterface
   *   The called Institution entity.
   */
  public function setRevisionUserId($uid);

}
