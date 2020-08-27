<?php

namespace Drupal\deposit\Controller;

use Drupal\Core\Controller\ControllerBase;



class DepositPluginController extends ControllerBase {

  public function deposit_list() {
    //$dataBaseConnection =  Database::getConnection();
    $database = \Drupal::database();
    $query = $database->query("SELECT deposit_info FROM {deposit}");
    $results = $query->fetchCol();

    return [
      '#theme' => 'results',
      '#results' => $results,
    ];
  }
}
