<?php

namespace Drupal\deposit\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class DepositSimplePluginDerivative extends DeriverBase {

  public function getDerivativeDefinitions($base_plugin_definition) {

    $banks = [
      'monobank',
      'alpha',
      'private',
      'mazebank',
    ];

    foreach ($banks as $bank) {
        $this->derivatives[$bank] = $base_plugin_definition;
      }


    return $this->derivatives;
  }

}
