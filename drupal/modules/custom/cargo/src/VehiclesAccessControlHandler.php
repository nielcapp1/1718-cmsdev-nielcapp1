<?php

namespace Drupal\cargo;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Vehicles entity.
 *
 * @see \Drupal\cargo\Entity\Vehicles.
 */
class VehiclesAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\cargo\Entity\VehiclesInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished vehicles entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published vehicles entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit vehicles entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete vehicles entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add vehicles entities');
  }

}
