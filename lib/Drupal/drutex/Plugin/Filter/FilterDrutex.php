<?php

/**
 * @file
 * Contains \Drupal\filter\Plugin\Filter\FilterHtmlEscape.
 */

namespace Drupal\drutex\Plugin\Filter;

use Drupal\filter\Annotation\Filter;
use Drupal\Core\Annotation\Translation;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a filter to display any HTML as plain text.
 *
 * @Filter(
 *   id = "filter_drutex",
 *   module = "drutex",
 *   title = @Translation("Drutex"),
 *   type = FILTER_TYPE_TRANSFORM_IRREVERSIBLE,
 *   weight = -10
 * )
 */
class FilterDrutex extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode, $cache, $cache_id) {
    $text = str_replace('foo', 'bar', $text);
    dpm($text);
    return $text;
  }

  /* TODO */

  /**
   * {@inheritdoc}
   */
  public function getHTMLRestrictions() {
    // Nothing is allowed.
    return array('allowed' => array());
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    return t('No HTML tags allowed.');
  }

}
