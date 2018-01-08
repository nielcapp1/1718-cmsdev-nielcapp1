<?php

namespace Drupal\university;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Institution entity.
 *
 * @see \Drupal\university\Entity\Institution.
 */
class InstitutionAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\university\Entity\InstitutionInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished institution entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published institution entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit institution entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete institution entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add institution entities');
  }

}