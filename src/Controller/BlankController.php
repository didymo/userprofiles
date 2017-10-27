<?php

namespace Drupal\service_clubs_manage_profiles\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Drupal\service_clubs_manage_profiles\Entity\PrivateProfile;
use Drupal\service_clubs_manage_profiles\Entity\PublicProfile;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Controller for service clubs manage profiles.
 */
class BlankController extends ControllerBase {

  /**
   * Creates blank public and profile entities.
   */
  public function genblank() {
    // Check to see if a new user has actually been made,
    // stops mashing of the link and therefore the user and
    // entities going out of sync
    // load the user list and check last.
    $users = User::loadMultiple();
    $uids = array_keys($users);
    $ulastID = end($uids);
    // Load the privates and check last.
    $privates = PrivateProfile::loadMultiple();
    $ppids = array_keys($privates);
    $plastID = end($ppids);

    \Drupal::logger('BlankController')->error('user last id: ' . $ulastID);
    \Drupal::logger('BlankController')->error('prof last id: ' . $plastID);

    if ($plastID >= $ulastID) {
      \Drupal::logger('BlankController')->error("Access to genblank form did not gen");
    }
    elseif ($plastID + 1 == $ulastID) {
      // Create new private.
      $private = PrivateProfile::create([
        'label' => User::load($ulastID)->getAccountName(),
        'name' => User::load($ulastID)->getAccountName(),
        'field_firstname' => "",
        'field_lastname' => "",
        'field_dob' => "",
        'field_homephone' => "",
        'field_mobile' => "",
        'field_role' => "",
        'field_address' => "",
        'field_certifications' => [""],
      ]);
      $private->save();
      // Create new public.
      $public = PublicProfile::create([
        'label' => User::load($ulastID)->getAccountName(),
        'name' => User::load($ulastID)->getAccountName(),
        'field_firstname' => "",
        'field_lastname' => "",
        'field_dob' => "",
        'field_homephone' => "",
        'field_mobile' => "",
        'field_role' => "",
        'field_address' => "",
        'field_certifications' => [""],
      ]);
      $public->save();
    }

    $build = [
      '#type' => 'markup',
      '#markup' => t('.'),
    ];

    return $build;
  }

  /**
   * Removes deleted profiles.
   */
  public function removeDeleted() {
    // Load the user list and check last.
    $users = User::loadMultiple();
    $uids = array_keys($users);
    $ulastID = end($uids);
    // Load the privates and check last.
    $privates = PrivateProfile::loadMultiple();
    $ppids = array_keys($privates);
    $plastID = end($ppids);

    foreach ($ppids as $pid) {
      if (!(in_array($pid, $uids))) {
        PrivateProfile::delete($pid);
        PublicProfile::delete($pid);
      }
    }
  }

  /**
   * Creates redirection to any current user edit page.
   */
  public function accessProfileLink() {

    $user = \Drupal::currentUser()->id();
    $query = \Drupal::database()->select('private_profile__field_userref', 'usrref');
    $query->addField('usrref', 'entity_id');
    $query->condition('usrref.field_userref_target_id', $user);
    $private_profile = $query->execute()->fetchField();

    if ($private_profile != NULL) {
      $url = base_path() . '/profile/' . $private_profile . '/edit';
    }
    else {
      $url = '/';
      drupal_set_message($this->t('You do not have a profile set up.'), 'error');
    }
    return new RedirectResponse($url);
  }

}
