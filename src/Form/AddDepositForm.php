<?php


namespace Drupal\deposit\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\deposit\DepositManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AddDepositForm extends FormBase {

  /**
   * @var \Drupal\deposit\DepositManager;
   */
  protected $deposit_plugin;

  /**
   * DepositControllerPlugin constructor.
   * @param \Drupal\deposit\DepositManager $deposit_plugin
   */
  public function __construct(DepositManager $deposit_plugin) {
    $this->deposit_plugin = $deposit_plugin;
  }

  public static function create(ContainerInterface $container) {

    return new static(
      $container->get('drupal.plugin.deposit')
    );
  }

  public function getFormId() {
    return 'add_deposit_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $deposit_types = [
      'simple' => $this->t('Simple Percent'),
      'compound' => $this->t('Compound Percent'),
    ];

    $form['deposit_type'] = [
      '#title' => 'Select the deposits type',
      '#type' => 'select',
      '#options' => $deposit_types,
      '#empty_option' => $this->t('Choose a deposit type'),
      '#required' => true,
    ];
    $sums = [100 => 100,
      200 => 200,
      300 => 300,
      400 => 400,
      500 => 500,
      600 => 600,
      700 => 700,
      800 => 800,
      1000 => 1000,
      1200 => 1200,
      1400 => 1400,
      5000 => 5000,
      31000 => 31000];

    $form['deposit_amount'] = [
      '#title' => 'Select the deposit amount',
      '#type' => 'select',
      '#options' => $sums,
      '#empty_option' => $this->t('Select the deposit amount'),
      '#required' => true,
    ];

    $percentages_list = [
      1 => 1,
      1.2  => 1.2,
      2 => 2,
      3 => 3,
      4 => 4,
      4.5 => 4.5,
      5 => 5,
      6 => 6,
      7 => 7,

      ];

    $form['percentages'] = [
      '#title' => 'Select the favorite percent =)',
      '#type' => 'select',
      '#options' => $percentages_list,
      '#empty_option' => $this->t('the %\'s'),
      '#required' => true,
    ];

    $banks = [
      'monobank' => 'MonoBank',
      'alpha' => 'Alpha',
      'private' => 'Private',
      'mazebank' => 'MazeBank',
    ];

    $form['banks'] = [
      '#title' => 'Select the bank',
      '#type' => 'select',
      '#options' => $banks,
      '#empty_option' => 'Choose the bank',
      '#required' => true,
    ];

    $years = [
      1 => 1,
      2 => 2,
      3 => 3,
      4 => 4,
      5 => 5,
      6 => 6,
      7 => 7,
      8 => 8,
      9 => 9,
      10 => 10,
      ];

    $form['years'] = [
      '#title' => $this->t('How many years ?'),
      '#type' => 'select',
      '#options' => $years,
      '#empty_option' => 'Choose - how many years ?',
      '#required' => true,
    ];

    $form['actions'] = ['#type' => 'actions'];

    $form['actions']['run'] = [
      '#type' => 'submit',
      '#value' => $this->t('Create deposit'),
      '#button_type' => 'primary',
    ];

    return $form;

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $years = $form_state->getValue('years');
    $bank = $form_state->getValue('banks');
    $percentages = $form_state->getValue('percentages');
    $depositAmount = $form_state->getValue('deposit_amount');
    $percentageType = $form_state->getValue('deposit_type');

    if ($percentageType == 'simple') {
      $plugin = $this->deposit_plugin->createInstance('simple_percentage:'.$bank);
      $plugin->returnDepositInfo($years, $bank, $depositAmount, $percentageType, $percentages);
    }
    else {
      $plugin = $this->deposit_plugin->createInstance('compound_percent:'.$bank);
      $plugin->returnDepositInfo($years, $bank, $depositAmount, $percentageType, $percentages);
    }
  }
}
