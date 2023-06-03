<?php

declare(strict_types=1);

namespace Drupal\tengstrom_views\HookHandlers\PreprocessHandlers;

use Drupal\tengstrom_general\HookHandlers\PreprocessHandlers\PreprocessHandlerInterface;

/**
 * Hook handler for hook_template_preprocess_views_exposed_form().
 */
class PreprocessViewsExposedFormHandler implements PreprocessHandlerInterface {

  public function preprocess(array &$variables): void {
    $variables['is_submitted'] = !empty($variables['form']['#is_submitted']);
  }

}
