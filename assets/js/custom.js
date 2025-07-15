function updateRule(id, condition) {
    const $li = $('#' + id);
    const $icon = $li.find('i');

    if (condition) {
        $icon.removeClass('fa-circle-xmark text-danger')
            .addClass('fa-circle-check text-success');
    } else {
        $icon.addClass('fa-circle-xmark text-danger')
            .removeClass('fa-circle-check text-success');
    }
}

function validatePassword() {
    const password = $('#password').val();
    const confirmPassword = $('#password_confirmation').val();

    updateRule('length-rule', password.length >= 8);
    updateRule('special-rule', /[!@#$%^&*(),.?":{}|<>]/.test(password));
    updateRule('number-rule', /\d/.test(password));
    updateRule('uppercase-rule', /[A-Z]/.test(password));
    updateRule('lowercase-rule', /[a-z]/.test(password));
    updateRule('match-rule', password !== "" && password === confirmPassword);
}

$('#password, #password_confirmation').on('input', validatePassword);