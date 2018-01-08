<?php

/**
 * @file
 * Contains vehicles.page.inc.
 *
 * Page callback for Vehicles entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Vehicles templates.
 *
 * Default template: vehicles.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_vehicles(array &$variables) {
  // Fetch Vehicles Entity Object.
  $vehicles = $variables['elements']['#vehicles'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
