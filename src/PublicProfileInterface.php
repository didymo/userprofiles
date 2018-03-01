<?php

namespace Drupal\userprofiles;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Public Profile entities.
 *
 * @ingroup userprofiles
 */
interface PublicProfileInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Public Profile name.
   *
   * @return string
   *   Name of the Public Profile.
   */
  public function getName();

  /**
   * Sets the Public Profile name.
   *
   * @param string $name
   *   The Public Profile name.
   *
   * @return \Drupal\userprofiles\PublicProfileInterface
   *   The called Public Profile entity.
   */
  public function setName($name);

  /**
   * Gets the Public Profile creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Public Profile.
   */
  public function getCreatedTime();

  /**
   * Sets the Public Profile creation timestamp.
   *
   * @param int $timestamp
   *   The Public Profile creation timestamp.
   *
   * @return \Drupal\userprofiles\PublicProfileInterface
   *   The called Public Profile entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Public Profile published status indicator.
   *
   * Unpublished Public Profile are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Public Profile is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Public Profile.
   *
   * @param bool $published
   *   TRUE to set this Public Profile to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\userprofiles\PublicProfileInterface
   *   The called Public Profile entity.
   */
  public function setPublished($published);

}
