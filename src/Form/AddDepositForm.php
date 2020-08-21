<?php


namespace Drupal\deposit\Form;


use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class AddDepositForm extends FormBase {

  public function getFormId()
  {
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

    $percentages_list = [ 1, 1.2, 2, 3, 4, 4.5, 5, 6, 7, ];
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

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['run'] = [
      '#type' => 'submit',
      '#value' => $this->t('Create deposit'),
      '#button_type' => 'primary',
    ];

    return $form;

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // TODO: Implement submitForm() method.
  }
}
