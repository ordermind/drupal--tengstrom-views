(function (Drupal) {
  const resetButtonSelector = '.list-filters .list-filters-reset';

  function onClick(event) {
    event.preventDefault();

    const parentFormElement = event.target.closest('.list-filters');

    parentFormElement.querySelectorAll('input[type="text"],input[type="hidden"],input[type="date"], select.select2-widget').forEach(element => {
      element.value = null;
      const changeEvent = new Event('change');
      element.dispatchEvent(changeEvent);
    });

    parentFormElement.querySelectorAll('select:not(.select2-widget)').forEach(element => {
      // For regular select elements set the value for select elements to either a specified default value or,
      // as a fallback, the first option in the select list.
      if (element.hasAttribute('data-default')) {
        element.value = element.getAttribute('data-default');
      } else {
        element.value = element.querySelector('option').value;
      }
    });

    parentFormElement.querySelector('.list-filters-submit').click();
  }

  Drupal.behaviors.viewsResetFilterFix = {
    attach: (context, settings) => {
      const resetButtons = document.querySelectorAll(resetButtonSelector);

      resetButtons.forEach((resetButton) => {
        resetButton.addEventListener('click', onClick);
      });
    },
    detach: (context, settings) => {
      const resetButtons = document.querySelectorAll(resetButtonSelector);

      resetButtons.forEach((resetButton) => {
        resetButton.removeEventListener('click', onClick);
      });
    }
  };
}(Drupal));
