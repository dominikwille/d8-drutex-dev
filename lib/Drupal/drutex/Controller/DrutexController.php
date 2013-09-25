<?php

namespace Drupal\drutex\Controller;

class EXecRenderController {
  public function content() {
    return array(
      '#type' => 'markup', 
      '#markup' => t('Welcome to Drutex!'), 
    ); 
  } 
} 