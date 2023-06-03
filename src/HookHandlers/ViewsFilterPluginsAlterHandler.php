<?php

declare(strict_types=1);

namespace Drupal\tengstrom_views\HookHandlers;

use Drupal\tengstrom_views\Plugin\views\filter\BooleanOperator;

class ViewsFilterPluginsAlterHandler {

  public function alter(array &$plugins): void {
    $this->replaceBooleanFilterPluginClass($plugins);
  }

  /**
   * Replace default boolean filter class with our own.
   */
  protected function replaceBooleanFilterPluginClass(array &$plugins): void {
    $plugins['boolean']['class'] = BooleanOperator::class;
  }

}
