<?php

namespace Drupal\userprofiles\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Private Profile entities.
 */
class PrivateProfileViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['private_profile']['table']['base'] = [
      'field' => 'id',
      'title' => $this->t('Private Profile'),
      'help' => $this->t('The Private Profile ID.'),
    ];

    return $data;
  }

}
