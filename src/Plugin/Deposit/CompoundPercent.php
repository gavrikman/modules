<?php


namespace Drupal\deposit\Plugin\Deposit;


use Drupal\deposit\Annotation\DepositPlugin;
use Drupal\deposit\DepositPluginBase;

/**
 * @DepositPlugin (
 * id = "compound_percent",
 * deriver = "Drupal\deposit\Derivative\DepositSimplePluginDerivative",
 * )
 */
class CompoundPercent extends DepositPluginBase {
  /**
   * @param int $years
   * @param float $percentages
   * @param float $depositAmount
   * @return float|int|void
   */
    public function calculatePercentages($years, $depositAmount, $percentages ) {
      $timesInYear = 1;
      $finalSum = $depositAmount * pow((1 + ($percentages / 100) / $timesInYear), $timesInYear * $years);
      return $finalSum;
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

      return parent::returnDepositInfo($years, $bank, $depositAmount, $percentageType, $percentages);

    }

}
