<?php

/**
 * @file
 * Contains reviews.page.inc.
 *
 * Page callback for Reviews entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Reviews templates.
 *
 * Default template: reviews.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_reviews(array &$variables) {
  // Fetch Reviews Entity Object.
  $reviews = $variables['elements']['#reviews'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
