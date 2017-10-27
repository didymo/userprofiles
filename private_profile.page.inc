<?php

/**
 * @file
 * Contains private_profile.page.inc.
 *
 * Page callback for Private Profile entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Private Profile templates.
 *
 * Default template: private_profile.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_private_profile(array &$variables) {
  // Fetch PrivateProfile Entity Object.
  $private_profile = $variables['elements']['#private_profile'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
