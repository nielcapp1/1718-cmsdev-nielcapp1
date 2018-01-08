<?php

namespace Drupal\university\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Instructor entities.
 *
 * @ingroup university
 */
interface InstructorInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Instructor name.
   *
   * @return string
   *   Name of the Instructor.
   */
  public function getName();

  /**
   * Sets the Instructor name.
   *
   * @param string $name
   *   The Instructor name.
   *
   * @return \Drupal\university\Entity\InstructorInterface
   *   The called Instructor entity.
   */
  public function setName($name);

  /**
   * Gets the Instructor creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Instructor.
   */
  public function getCreatedTime();

  /**
   * Sets the Instructor creation timestamp.
   *
   * @param int $timestamp
   *   The Instructor creation timestamp.
   *
   * @return \Drupal\university\Entity\InstructorInterface
   *   The called Instructor entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Instructor published status indicator.
   *
   * Unpublished Instructor are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Instructor is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Instructor.
   *
   * @param bool $published
   *   TRUE to set this Instructor to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\university\Entity\InstructorInterface
   *   The called Instructor entity.
   */
  public function setPublished($published);

  /**
   * Gets the Instructor revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Instructor revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\university\Entity\InstructorInterface
   *   The called Instructor entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Instructor revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Instructor revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\university\Entity\InstructorInterface
   *   The called Instructor entity.
   */
  public function setRevisionUserId($uid);

}
