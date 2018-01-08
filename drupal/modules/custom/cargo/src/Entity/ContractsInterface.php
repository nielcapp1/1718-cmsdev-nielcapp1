<?php

namespace Drupal\cargo\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Contracts entities.
 *
 * @ingroup cargo
 */
interface ContractsInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Contracts name.
   *
   * @return string
   *   Name of the Contracts.
   */
  public function getName();

  /**
   * Sets the Contracts name.
   *
   * @param string $name
   *   The Contracts name.
   *
   * @return \Drupal\cargo\Entity\ContractsInterface
   *   The called Contracts entity.
   */
  public function setName($name);

  /**
   * Gets the Contracts creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Contracts.
   */
  public function getCreatedTime();

  /**
   * Sets the Contracts creation timestamp.
   *
   * @param int $timestamp
   *   The Contracts creation timestamp.
   *
   * @return \Drupal\cargo\Entity\ContractsInterface
   *   The called Contracts entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Contracts published status indicator.
   *
   * Unpublished Contracts are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Contracts is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Contracts.
   *
   * @param bool $published
   *   TRUE to set this Contracts to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\cargo\Entity\ContractsInterface
   *   The called Contracts entity.
   */
  public function setPublished($published);

}
