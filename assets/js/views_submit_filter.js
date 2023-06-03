(function (Drupal) {
  const submitButtonSelector = '.list-filters .list-filters-submit';
  const isSubmittedFieldSelector = 'input[name="is_submitted"]';

  function onClick(event) {
    const parentFormElement = event.target.closest('.list-filters');

    parentFormElement.querySelector(isSubmittedFieldSelector).value = '1';
  }

  Drupal.behaviors.viewsSubmitFilter = {
    attach: (context, settings) => {
      const submitButtons = document.querySelectorAll(submitButtonSelector);

      submitButtons.forEach((submitButton) => {
        submitButton.prependEventListener('click', onClick);
      });
    },
    detach: (context, settings) => {
      const submitButtons = document.querySelectorAll(submitButtonSelector);

      submitButtons.forEach((submitButton) => {
        submitButton.removeEventListener('click', onClick);
      });
    }
  };
}(Drupal));
