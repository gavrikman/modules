<?php

namespace Drupal\deposit\Plugin\Deposit;

use Drupal\deposit\Annotation\DepositPlugin;
use Drupal\deposit\DepositPluginBase;

/**
 * @DepositPlugin (
 * id = "simple_percentage",
 * deriver = "Drupal\deposit\Derivative\DepositSimplePluginDerivative",
 * )
 */
class SimplePercentage extends DepositPluginBase {

  /**
   * @param int $years
   * @param float $percentages
   * @param float $sum
   * @return float|int|void
   */
  public function calculatePercentages() {
    $percentages = $this->getPluginDefinition()['bank_name'];
/*    $percentages = $percentages / 100;
    $forYear = $sum * $percentages;
    $percentagesSum = $forYear * $years;
    return $sum + $percentagesSum;*/
    return $percentages;
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
  $id = $this->getDerivativeId();
  return parent::returnDepositInfo($years, $bank, $depositAmount, $percentageType, $percentages);
}
}
