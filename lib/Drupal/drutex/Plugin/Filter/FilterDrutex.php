<?php

/**
 * @file
 * Contains \Drupal\filter\Plugin\Filter\FilterHtmlEscape.
 */

namespace Drupal\drutex\Plugin\Filter;

use Drupal\filter\Annotation\Filter;
use Drupal\Core\Annotation\Translation;
use Drupal\filter\Plugin\FilterBase;
use Drupal\drutex\Drutex;

/**
 * Provides a filter to display any HTML as plain text.
 *
 * @Filter(
 *   id = "filter_drutex_math",
 *   module = "drutex",
 *   title = @Translation("Drutex math"),
 *   type = FILTER_TYPE_TRANSFORM_IRREVERSIBLE,
 *   weight = -10
 * )
 */
class FilterDrutex extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode, $cache, $cache_id) {
    $matches = array();
    $drutex = new Drutex();
    $replacements = array();

    preg_match_all('/\$(.*?)\$/', $text, $matches, PREG_PATTERN_ORDER);

    $matches = $matches[1];
    foreach($matches as $expression) {
      $image = $drutex->render($expression);
      $text = str_replace('$' . $expression . '$', $image, $text);
    }


    return $text;
  }


  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    return t('No HTML tags allowed.');
  }

}
