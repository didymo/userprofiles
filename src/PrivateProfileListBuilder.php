<?php

namespace Drupal\service_clubs_manage_profile;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Private Profile entities.
 *
 * @ingroup service_clubs_manage_profile
 */
class PrivateProfileListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Private Profile ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\service_clubs_manage_profile\Entity\PrivateProfile */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.private_profile.edit_form', [
          'private_profile' => $entity->id(),
        ]
      )
    );
    return $row + parent::buildRow($entity);
  }

}
