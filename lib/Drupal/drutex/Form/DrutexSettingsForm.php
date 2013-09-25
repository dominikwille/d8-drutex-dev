<?php
/**
 * @file
 * Contains \Drupal\hello\Form\HelloConfigForm.
 */

namespace Drupal\drutex\Form;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Config\Context\ContextInterface;
use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configure text display settings for this the hello world page.
 */
class DrutexSettingsForm extends ConfigFormBase {

  /**
   * Constructs a \Drupal\hello\Form\HelloConfigForm object.
   *
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The factory for configuration objects.
   * @param \Drupal\Core\Config\Context\ContextInterface $context
   *   The configuration context to use.
   */
  public function __construct(ConfigFactory $config_factory, ContextInterface $context) {
    parent::__construct($config_factory, $context);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('config.context.free')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'hello.settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $config = $this->configFactory->get('hello.settings');
    $case = $config->get('case');
    $form['hello_case'] = array(
      '#type' => 'radios',
      '#title' => $this->t('Configure Hello World Text'),
      '#default_value' => $case,
      '#options' => array(
        'upper' => $this->t('UPPER'),
        'title' => $this->t('Title'),
      ),
      '#description' => $this->t('Choose the case of your "Hello, world!" message.'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    $this->configFactory->get('hello.settings')
      ->set('case', $form_state['values']['hello_case'])
      ->save();

    parent::submitForm($form, $form_state);
  }
}
