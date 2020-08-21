<?php
namespace Drupal\deposit;

use Drupal\Component\Plugin\PluginBase;

/**
 * Class DepositPluginBase
 * @package Drupal\deposit
 */
abstract class DepositPluginBase extends PluginBase implements DepositPluginInterface {

  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  public function getId() {
   return $this->pluginDefinition['id'];
  }

  public function calculatePercentages() {

  }

  /**
   * @param float $years
   * @param string $bank
   * @param float $depositAmount
   * @param string $percentageType
   * @param float $percentages
   * @return mixed|string
   */
  public function returnDepositInfo(float $years, string $bank, float $depositAmount, string $percentageType, float $percentages) {

    return "Вы взяли депозит в $bank.
    Первоначальный вклад $depositAmount под $percentageType, размер % = $percentages.
    Ваш тип процента $percentageType. Время депозита $years г.
    Ожидаемая сумма:" . $this->calculatePercentages();
  }

}
