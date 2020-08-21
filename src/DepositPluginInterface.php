<?php


namespace Drupal\deposit;

use Drupal\Component\Plugin\PluginInspectionInterface;

interface DepositPluginInterface extends PluginInspectionInterface {
  /**
   * get plugin id
   */
  public function getId();

  /**
   * @param int $years
   *
   * @param float $percentages
   *
   * @param float $sum
   *
   * calculate the percentages to deposit
   * @return float
   */
  public function calculatePercentages();

  /**
   * @param float $years
   * @param string $bank
   * @param float $depositAmount
   * @param string $percentageType
   * @param float $percentages
   * @return mixed
   */
  public function  returnDepositInfo(float $years, string $bank, float $depositAmount, string $percentageType, float $percentages);






}
