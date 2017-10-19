<?php

namespace Drupal\userprofiles;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Public Profile entity.
 *
 * @see \Drupal\userprofiles\Entity\PublicProfile.
 */
class PublicProfileAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\userprofiles\PublicProfileInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished public profile entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published public profile entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit public profile entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete public profile entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add public profile entities');
  }

}
