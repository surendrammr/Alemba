/*
 * Reset form after submission
 */
function resetForm($form) {
    $form[0].reset();

    if (window.grecaptcha) {
        grecaptcha.reset();
    }

    $('.upload-files-container').html('');

    $('.responsiv-uploader-fileupload').removeClass('is-populated');
}

/*
 * Set invalid fields after form is validated
 */
addEventListener('ajax:invalid-field', function (event) {
    const {element, fieldName, fieldMessages, isFirst} = event.detail;

    if (element.type === 'radio') {
        document.getElementsByName(fieldName).forEach(element => setInvalidElement(element))
    }

    if (element.type === 'checkbox') {
        document.getElementsByName(fieldName + '[]').forEach(element => setInvalidElement(element))
    }

    if (fieldName === 'g-recaptcha-response') {
        document.querySelectorAll('[data-validate-for="g-recaptcha-response"]').forEach(element => element.style.display = 'block');
    }

    setInvalidElement(element)
});

/*
 * Clear errors on new form submission
 */
addEventListener('ajax:promise', function (event) {
    event.target.closest('form').querySelectorAll('.is-invalid').forEach(function (el) {
        el.classList.remove('is-invalid');

        document.querySelectorAll('[data-validate-for="g-recaptcha-response"]').forEach(element => element.style.display = 'none');
    });
});

function setInvalidElement(element) {
    element.classList.add('is-invalid');
}
