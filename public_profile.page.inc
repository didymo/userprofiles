<?php

/**
 * @file
 * Contains public_profile.page.inc.
 *
 * Page callback for Public Profile entities.
 */

use Drupal\Core\Render\Element;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Prepares variables for Public Profile templates.
 *
 * Default template: public_profile.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_public_profile(array &$variables) {
  // Fetch PublicProfile Entity Object.
  $public_profile = $variables['elements']['#public_profile'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
