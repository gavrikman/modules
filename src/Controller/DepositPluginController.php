<?php

namespace Drupal\deposit\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\deposit\DepositManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


class DepositPluginController extends ControllerBase {

  /**
   * @var \Drupal\deposit\DepositManager;
   */
  protected $deposit_plugin;

  /**
   * DepositControllerPlugin constructor.
   * @param \Drupal\deposit\DepositManager $deposit_plugin
   */
  public function __construct(DepositManager $deposit_plugin) {
    $this->deposit_plugin = $deposit_plugin;

  }

  public function description() {
    $build = [];
    $deposit_plugins = $this->deposit_plugin->getDefinitions();

    $items = [];

    foreach ($deposit_plugins as $plugin_id => $deposit_plugin) {

      $plugin = $this->deposit_plugin->createInstance($plugin_id, ['of' => 'configuration values']);
      $items[] = $plugin->calculatePercentages();
    }
    $build['plugins'] = [
      '#theme' => 'item_list',
      '#title' => 'Sandwich plugins',
      '#items' => $items,
    ];
    return $build;
  }
  public static function create(ContainerInterface $container) {
    return new static($container->get('drupal.plugin.deposit'));
  }
}
