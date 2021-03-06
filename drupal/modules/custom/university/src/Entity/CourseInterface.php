<?php

namespace Drupal\university\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Course entities.
 *
 * @ingroup university
 */
interface CourseInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Course name.
   *
   * @return string
   *   Name of the Course.
   */
  public function getName();

  /**
   * Sets the Course name.
   *
   * @param string $name
   *   The Course name.
   *
   * @return \Drupal\university\Entity\CourseInterface
   *   The called Course entity.
   */
  public function setName($name);

  /**
   * Gets the Course creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Course.
   */
  public function getCreatedTime();

  /**
   * Sets the Course creation timestamp.
   *
   * @param int $timestamp
   *   The Course creation timestamp.
   *
   * @return \Drupal\university\Entity\CourseInterface
   *   The called Course entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Course published status indicator.
   *
   * Unpublished Course are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Course is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Course.
   *
   * @param bool $published
   *   TRUE to set this Course to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\university\Entity\CourseInterface
   *   The called Course entity.
   */
  public function setPublished($published);

  /**
   * Gets the Course revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Course revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\university\Entity\CourseInterface
   *   The called Course entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Course revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Course revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\university\Entity\CourseInterface
   *   The called Course entity.
   */
  public function setRevisionUserId($uid);

}
