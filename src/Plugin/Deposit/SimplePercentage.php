<?php

namespace Drupal\deposit\Plugin\Deposit;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\deposit\Annotation\DepositPlugin;
use Drupal\deposit\DepositPluginBase;
use mysql_xdevapi\SqlStatementResult;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @DepositPlugin (
 * id = "simple_percentage",
 * deriver = "Drupal\deposit\Derivative\DepositSimplePluginDerivative",
 * )
 */
class SimplePercentage extends DepositPluginBase implements ContainerFactoryPluginInterface {


  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  /**
   * @param int $years
   * @param float $percentages
   * @param float $depositAmount
   * @return float|int|void
   */
  public function calculatePercentages( $years, $depositAmount, $percentages) {
    $percentages = $percentages / 100;
    $forYear = $depositAmount * $percentages;
    $percentagesSum = $forYear * $years;
    return $depositAmount + $percentagesSum;

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
