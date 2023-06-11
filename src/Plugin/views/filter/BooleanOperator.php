<?php

declare(strict_types=1);

namespace Drupal\tengstrom_views\Plugin\views\filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\filter\BooleanOperator as OverriddenClass;

/**
 * Simple filter to handle matching of boolean values.
 *
 * Definition items:
 * - label: (REQUIRED) The label for the checkbox.
 * - type: For basic 'true false' types, an item can specify the following:
 *    - true-false: True/false (this is the default)
 *    - yes-no: Yes/No
 *    - on-off: On/Off
 *    - enabled-disabled: Enabled/Disabled
 * - accept null: Treat a NULL value as false.
 * - use_equal: If you use this flag the query will use = 1 instead of <> 0.
 *   This might be helpful for performance reasons.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("tengstrom_views_boolean")
 */
class BooleanOperator extends OverriddenClass {

  /**
   * {@inheritdoc}
   *
   * Add data attribute with the default value for a grouped filter element.
   * This helps us with the reset fix.
   */
  public function groupForm(&$form, FormStateInterface $form_state): void {
    parent::groupForm($form, $form_state);

    $groupedFilterName = $this->options['group_info']['identifier'] ?? NULL;
    if (!$groupedFilterName) {
      return;
    }

    $defaultValue = $form[$groupedFilterName]['#default_value'];
    $form[$groupedFilterName]['#attributes']['data-default'] = $defaultValue;
  }

}
