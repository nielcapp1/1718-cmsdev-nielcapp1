<?php

/**
 * @file
 * Contains institution.page.inc.
 *
 * Page callback for Institution entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Institution templates.
 *
 * Default template: institution.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_institution(array &$variables) {
  // Fetch Institution Entity Object.
  $institution = $variables['elements']['#institution'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
