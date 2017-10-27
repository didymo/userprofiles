<?php

namespace Drupal\service_clubs_manage_profiles\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\service_clubs_manage_profiles\Entity\PublicProfile;

/**
 * Form controller for Private Profile edit forms.
 *
 * @ingroup service_clubs_manage_profiles
 */
class PrivateProfileForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\service_clubs_manage_profiles\Entity\PrivateProfile */
    // This stuff should fill the form out for us, based on the entity.
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->getEntity();
    $entity->save();
    $status = parent::save($form, $form_state);

    $user = $entity->field_userref->entity;
    // Check if the user actually exists
    // if ($user) {
    // Load the public profile, so we can copy data.
    $public_profile = $user->entity;

    // Grab the states from the private profile form.
    $image_state = $entity->field_image_state->value;
    $firstname_state = $entity->field_firstname_state->value;
    $lastname_state = $entity->field_lastname_state->value;
    $contact_email_state = $entity->field_contact_email_state->value;
    $dob_state = $entity->field_dob_state->value;
    // $address_state = $entity->field_address_state->value;.
    $homephone_state = $entity->field_homephone_state->value;
    $mobile_state = $entity->field_mobile_state->value;
    $role_state = $entity->field_role_state->value;
    $certifications_state = $entity->field_certifications_state->value;

    // Grab the values from the private profile form.
    $image = $entity->field_image;
    $firstname = $entity->field_firstname->value;
    $lastname = $entity->field_lastname->value;
    $contact_email = $entity->field_contact_email->value;
    $dob = $entity->field_dob->value;
    // $address = $entity->field_address;.
    $homephone = $entity->field_homephone->value;
    $mobile = $entity->field_mobile->value;
    $role = $entity->field_role->value;
    $certifications = $entity->field_certifications;

    // First set everything to blank.
    $public_profile->field_firstname = "";
    $public_profile->field_image = NULL;
    $public_profile->field_lastname = "";
    $public_profile->field_contact_email = "";
    $public_profile->field_dob = "";
    // $public_profile->field_address = "";.
    $public_profile->field_homephone = "";
    $public_profile->field_mobile = "";
    $public_profile->field_role = "";
    $public_profile->field_certifications = "";

    // Reset the fields that have been specified.
    if ($image_state) {
      $public_profile->field_image = $image;
    }
    if ($firstname_state) {
      $public_profile->field_firstname = $firstname;
    }
    if ($lastname_state) {
      $public_profile->field_lastname = $lastname;
    }
    if ($contact_email_state) {
      $public_profile->field_contact_email = $contact_email;
    }
    if ($dob_state) {
      $public_profile->field_dob = $dob;
    }
    // If ($address_state) $public_profile->field_address = $address;.
    if ($homephone_state) {
      $public_profile->field_homephone = $homephone;
    }
    if ($mobile_state) {
      $public_profile->field_mobile = $mobile;
    }
    if ($role_state) {
      $public_profile->field_role = $role;
    }
    if ($certifications_state) {
      $public_profile->field_certifications = $certifications;
    }

    /*
    drupal_set_message($public_profile->field_firstname);
    drupal_set_message($public_profile->field_lastname);
    drupal_set_message($public_profile->field_contact_email);
    drupal_set_message($public_profile->field_dob);
     */

    \Drupal::database()->delete('public_profile')
      ->condition('name', $user->label())
      ->execute();

    $profile = PublicProfile::create([
      'name' => $user->label(),
      'field_firstname' => $public_profile->field_firstname,
      'field_lastname' => $public_profile->field_lastname,
      'field_image' => $public_profile->field_image,
      'field_contact_email' => $public_profile->field_contact_email,
      'field_dob' => $public_profile->field_dob,
      'field_homephone' => $public_profile->field_homephone,
      'field_mobile' => $public_profile->field_mobile,
      'field_role' => $public_profile->field_role,
      'field_certifications' => $public_profile->field_certifications,
      'field_userref' => $user,
    ]);
    $profile->save();
    drupal_set_message('Private Profile Saved!');
    // }.
    $form_state->setRedirect('entity.private_profile.edit_form', ['private_profile' => $entity->id()]);

  }

}
