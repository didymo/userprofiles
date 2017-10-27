<?php

namespace Drupal\service_clubs_manage_profiles\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Public Profile edit forms.
 *
 * @ingroup service_clubs_manage_profiles
 */
class PublicProfileForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\service_clubs_manage_profiles\Entity\PublicProfile */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Public Profile.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Public Profile.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.public_profile.canonical', ['public_profile' => $entity->id()]);
  }

}
