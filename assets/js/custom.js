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

const notify = (text) => {
    toastr.info(
      text,
      ``,
      {
        positionClass: "toastr toast-top-center",
        containerId: "toast-top-center",
      }
    );
}

const ajax_error_message_rsp = (jqXHR, exception) => {
	let _ajx_error_msg = "";
    
	if (jqXHR.status === 0) {
		_ajx_error_msg = "Not connect.\n Verify Network.";
	} else if (jqXHR.status == 404) {
		_ajx_error_msg = "Requested page not found. [404]";
	} else if (jqXHR.status == 500) {
		_ajx_error_msg = "Internal Server Error [500].";
	} else if (exception === "parsererror") {
		_ajx_error_msg = "Requested JSON parse failed.";
	} else if (exception === "timeout") {
		_ajx_error_msg = "Time out error.";
	} else if (exception === "abort") {
		_ajx_error_msg = "Ajax request aborted.";
	} else {
		try {
			const responseJson = JSON.parse(jqXHR.responseText);
			_ajx_error_msg = responseJson.message || "Unknown error occurred";
		} catch (e) {
			_ajx_error_msg = "Uncaught Error.";
		}
	}

	return _ajx_error_msg;
}

$(document).on('click', '.general-modal-button', function(event) {
	const modal = $('#general-modal');

	if (event.originalEvent && event.originalEvent.isTrusted) {
        const action = $(this).data('action');
		const form = createForm(action, "GET", {});

		submitForm(form, true).done(function(response){
			if (response.html) {
				modal.find('form').attr('action', action);
				modal.find('.modal-body').html(response.html);
				modal.find('.modal-dialog').removeClass('modal-xl');
				validateForm(".general-modal-form");
				if(response.footer) {
					modal.find('.modal-footer').html(response.footer);
				}
				if(response.title) {
					modal.find('.modal-title').text(response.title);
				}
				if(response.classXl) {
					modal.find('.modal-dialog').addClass('modal-xl');
				}
				modal.modal('show');
			}
		});
    } else {
		let data = $(this).data();
		modal.find('form').attr('action', `${data.action}`);
		modal.find('.modal-body').html(data.question);
		validateForm(".general-modal-form");
		if(data.footer) {
			modal.find('.modal-footer').html(data.footer);
		}
		if(data.title) {
			modal.find('.modal-title').text(data.title);
		}
		modal.modal('show');
    }
});

$('.focus-in-field').each(function() {
	$(this).on("focusin", function() {
		$(this).data("original-value", $(this).val().trim());
	});

	$(this).on("input", function() {
		const newValue = $(this).val().trim();
		const originalValue = $(this).data("original-value").trim();

		if (newValue !== '' && newValue !== originalValue) {
			const action = $(this).data('action');
			const method = $(this).data('method');
			const name = $(this).attr('name');
			const form = createForm(action, method, {
				[name]: newValue
			});

			submitForm(form, true);
		}

		return;
	});
});