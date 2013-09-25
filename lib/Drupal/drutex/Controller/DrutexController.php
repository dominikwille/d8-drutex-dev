<?php

namespace Drupal\drutex\Controller;

class DrutexController {
  public function content() {
    return array(
      '#type' => 'markup', 
      '#markup' => t('Welcome to Drutex!'), 
    ); 
  } 
} 