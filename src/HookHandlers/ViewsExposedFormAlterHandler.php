<?php

declare(strict_types=1);

namespace Drupal\tengstrom_views\HookHandlers;

use Drupal\Core\Form\FormStateInterface;
use Drupal\tengstrom_general\HookHandlers\FormAlterHandlers\FormAlterHandlerInterface;

class ViewsExposedFormAlterHandler implements FormAlterHandlerInterface {

  public function alter(array &$form, FormStateInterface $formState, string $formId): void {
    $this->improveExposedFiltersForm($form, $formState);
  }

  /**
   * Improves the exposed filters form by fixing issues with the reset button
   * and adding information about whether the form has been submitted.
   */
  protected function improveExposedFiltersForm(array &$form, FormStateInterface $formState) {
    $form['#attributes']['class'][] = 'list-filters';
    $form['#attached']['library'][] = 'tengstrom_views/tengstrom_views';

    $form['is_submitted'] = [
      '#type' => 'hidden',
    ];

    if (!empty($form['actions']['submit'])) {
      $form['actions']['submit']['#attributes']['class'][] = 'list-filters-submit';
    }

    if (!empty($form['actions']['reset'])) {
      $form['actions']['reset']['#attributes']['class'][] = 'list-filters-reset';
      $form['actions']['reset']['#access'] = TRUE;
    }

    $input = $formState->getUserInput();
    $form['#is_submitted'] = !empty($input['is_submitted']);
  }

}
