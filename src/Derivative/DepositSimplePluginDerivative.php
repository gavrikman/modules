<?php

namespace Drupal\deposit\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Unish\generateMakeCase;

class DepositSimplePluginDerivative extends DeriverBase {

  public function getDerivativeDefinitions($base_plugin_definition) {

    $this->derivatives['privat_bank'] = $base_plugin_definition;
    $this->derivatives['privat_bank']['bank_name'] = 'Простий процент в Приват Банку';
    $this->derivatives['privat_bank']['year_bet'] = 2.75;
    $this->derivatives['privat_bank']['start_money'] = 2.15;
    $this->derivatives['privat_bank']['years'] = 4;

    return $this->derivatives;
  }

}
