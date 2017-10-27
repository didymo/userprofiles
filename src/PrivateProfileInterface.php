<?php

namespace Drupal\service_clubs_manage_profiles;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Private Profile entities.
 *
 * @ingroup service_clubs_manage_profiles
 */
interface PrivateProfileInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Private Profile name.
   *
   * @return string
   *   Name of the Private Profile.
   */
  public function getName();

  /**
   * Sets the Private Profile name.
   *
   * @param string $name
   *   The Private Profile name.
   *
   * @return \Drupal\service_clubs_manage_profiles\PrivateProfileInterface
   *   The called Private Profile entity.
   */
  public function setName($name);

  /**
   * Gets the Private Profile creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Private Profile.
   */
  public function getCreatedTime();

  /**
   * Sets the Private Profile creation timestamp.
   *
   * @param int $timestamp
   *   The Private Profile creation timestamp.
   *
   * @return \Drupal\service_clubs_manage_profiles\PrivateProfileInterface
   *   The called Private Profile entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Private Profile published status indicator.
   *
   * Unpublished Private Profile are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Private Profile is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Private Profile.
   *
   * @param bool $published
   *   TRUE to set to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\service_clubs_manage_profiles\PrivateProfileInterface
   *   The called Private Profile entity.
   */
  public function setPublished($published);

}
