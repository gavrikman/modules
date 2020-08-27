<?php
namespace Drupal\deposit;

use Drupal\Component\Plugin\PluginBase;
use Drupal\Core\Database\Database;

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

  /**
   * @param int $years
   * @param float $depositAmount
   * @param float $percentages
   * @return float|void
   */
  public function calculatePercentages(int $years, float $depositAmount, float $percentages) {

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
    $outPutInformation =  "Вы взяли депозит в $bank.
    Первоначальный вклад $depositAmount под $percentageType % , размер % = $percentages.
    Время депозита $years г.
    Ожидаемая сумма:" . $this->calculatePercentages($years, $depositAmount, $percentages);
    $dataBaseConnection =  Database::getConnection();
    $dataBaseConnection->insert('deposit')->fields([
      'deposit_info' => $outPutInformation,
    ])->execute();
    return $outPutInformation;
  }

}
