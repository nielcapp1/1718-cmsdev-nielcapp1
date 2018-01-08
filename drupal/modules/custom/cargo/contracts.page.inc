<?php

/**
 * @file
 * Contains contracts.page.inc.
 *
 * Page callback for Contracts entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Contracts templates.
 *
 * Default template: contracts.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_contracts(array &$variables) {
  // Fetch Contracts Entity Object.
  $contracts = $variables['elements']['#contracts'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
