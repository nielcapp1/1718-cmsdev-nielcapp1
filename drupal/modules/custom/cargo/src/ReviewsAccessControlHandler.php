<?php

namespace Drupal\cargo;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Reviews entity.
 *
 * @see \Drupal\cargo\Entity\Reviews.
 */
class ReviewsAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\cargo\Entity\ReviewsInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished reviews entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published reviews entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit reviews entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete reviews entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add reviews entities');
  }

}
