<?php

namespace Drupal\service_clubs_manage_profile\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Public Profile entities.
 */
class PublicProfileViewsData extends EntityViewsData implements EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['public_profile']['table']['base'] = [
      'field' => 'id',
      'title' => $this->t('Public Profile'),
      'help' => $this->t('The Public Profile ID.'),
    ];

    return $data;
  }

}
