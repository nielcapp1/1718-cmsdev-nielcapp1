<?php

namespace Drupal\cargo\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Reviews entities.
 *
 * @ingroup cargo
 */
interface ReviewsInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Reviews name.
   *
   * @return string
   *   Name of the Reviews.
   */
  public function getName();

  /**
   * Sets the Reviews name.
   *
   * @param string $name
   *   The Reviews name.
   *
   * @return \Drupal\cargo\Entity\ReviewsInterface
   *   The called Reviews entity.
   */
  public function setName($name);

  /**
   * Gets the Reviews creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Reviews.
   */
  public function getCreatedTime();

  /**
   * Sets the Reviews creation timestamp.
   *
   * @param int $timestamp
   *   The Reviews creation timestamp.
   *
   * @return \Drupal\cargo\Entity\ReviewsInterface
   *   The called Reviews entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Reviews published status indicator.
   *
   * Unpublished Reviews are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Reviews is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Reviews.
   *
   * @param bool $published
   *   TRUE to set this Reviews to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\cargo\Entity\ReviewsInterface
   *   The called Reviews entity.
   */
  public function setPublished($published);

}
