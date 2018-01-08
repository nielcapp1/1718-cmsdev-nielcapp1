<?php

namespace Drupal\cargo\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Vehicles entities.
 *
 * @ingroup cargo
 */
interface VehiclesInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Vehicles name.
   *
   * @return string
   *   Name of the Vehicles.
   */
  public function getName();

  /**
   * Sets the Vehicles name.
   *
   * @param string $name
   *   The Vehicles name.
   *
   * @return \Drupal\cargo\Entity\VehiclesInterface
   *   The called Vehicles entity.
   */
  public function setName($name);

  /**
   * Gets the Vehicles creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Vehicles.
   */
  public function getCreatedTime();

  /**
   * Sets the Vehicles creation timestamp.
   *
   * @param int $timestamp
   *   The Vehicles creation timestamp.
   *
   * @return \Drupal\cargo\Entity\VehiclesInterface
   *   The called Vehicles entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Vehicles published status indicator.
   *
   * Unpublished Vehicles are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Vehicles is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Vehicles.
   *
   * @param bool $published
   *   TRUE to set this Vehicles to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\cargo\Entity\VehiclesInterface
   *   The called Vehicles entity.
   */
  public function setPublished($published);

}
