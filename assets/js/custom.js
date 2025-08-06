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

const initFocusInFields = (element) => {
	$(element).each(function() {
		$(this).on("focusin", function() {
			$(this).data("original-value", $(this).val().trim());
		});
	
		$(this).on("input", function() {
			const newValue = $(this).val().trim();
			const originalValue = $(this).data("original-value").trim();
			const skeleton = $(this).data('skeleton').trim();

			if(skeleton) {
				$(`#${skeleton}`).hide();
				$(`#${skeleton}`).addClass('loading-skeleton');
			}
	
			if (newValue !== '' && newValue !== originalValue) {
				const action = $(this).data('action');
				const method = $(this).data('method');
				const name = $(this).attr('name');
				const form = createForm(action, method, {
					[name]: newValue
				});

				$(`#${skeleton}`).show();
	
				submitForm(form, true).done(function(response){
					if(skeleton) {
						if(response.status) {
							if(response.name) {
								$(`input[name=name]`).val(response.name);
								$(`input[name=picture]`).val(response.picture);
								$(`input[name=address]`).val(response.address);
								$(`input[name=platform_url]`).val(response.platform_url);

								$(`#${skeleton}`).find('img').attr('src', response.picture);
								$(`#${skeleton}`).find('.card-title').text(response.name);
								$(`#${skeleton}`).find('.card-text').text(response.address);

								$(`#${skeleton}`).removeClass('loading-skeleton');
							}
						} else {
							$(`#${skeleton}`).hide();
						}
					}
				}).fail(function(){
					if(skeleton) {
						$(`#${skeleton}`).hide();
					}
				});
			}

			return;
		});
	});
}

initFocusInFields('.focus-in-field');

const logoFormat = (logo) => {
	if (!logo.id) {
		return logo.text;
	}

	return `<img src="${$(logo.element).data("logo")}" class="mb-1 me-2" height="30" width="30" /> ${logo.text}`;
}

const initSelectWithLogo = (element) => {
	const $element = $(element);
	const options = {
		templateResult: logoFormat,
		templateSelection: logoFormat,
		escapeMarkup: function (es) {
			return es;
		}
	};

	if ($element.closest('#general-modal').length > 0) {
		options.dropdownParent = $('#general-modal');
	}

	$element.select2(options);
};

const initMinicolors = (element) => {
	$(element).minicolors({
		control: $(element).attr("data-control") || "hue",
		defaultValue: $(element).attr("data-defaultValue") || "",
		format: $(element).attr("data-format") || "hex",
		keywords: $(element).attr("data-keywords") || "",
		inline: $(element).attr("data-inline") === "true",
		letterCase: $(element).attr("data-letterCase") || "lowercase",
		opacity: $(element).attr("data-opacity"),
		position: $(element).attr("data-position") || "bottom left",
		swatches: $(element).attr("data-swatches") ? $(element).attr("data-swatches").split("|") : [],
		change: function (value, opacity) {
			if (!value) return;
			if (opacity) value += ", " + opacity;
		},
		theme: "bootstrap",
	});
};

$('.custom-collapse').on('show.bs.collapse', function () {
	const toggleBtn = $('[data-bs-target="#' + this.id + '"]');
	toggleBtn.find('i').removeClass('fa-chevron-right').addClass('fa-chevron-down');
});

$('.custom-collapse').on('hide.bs.collapse', function () {
	const toggleBtn = $('[data-bs-target="#' + this.id + '"]');
	toggleBtn.find('i').removeClass('fa-chevron-down').addClass('fa-chevron-right');
});

const generateRandomString = (length = 10) => {
	const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	let result = '';

	for (let i = 0; i < length; i++) {
		result += chars.charAt(Math.floor(Math.random() * chars.length));
	}

	return result;
}

const initRatings = () => {
	$('.rating-radio').each(function () {
		let $lastChecked = null;
		const $inputs = $(this).find('input[type="radio"]');

		$inputs.off('click');

		$inputs.on('click', function () {
			if ($(this).is($lastChecked)) {
				$(this).prop('checked', false);
				$lastChecked = null;
			} else {
				$lastChecked = $(this);
			}
		});
	});
}

$("#select-with-logo").change(function () {
	if($('.logo-preview').length) {
		const logo = $(this).find(':selected').data('logo');

		fetch(logo)
			.then(res => {
				if (res.ok) return res.blob();
			})
			.then(blob => {
				const reader = new FileReader();
				reader.onload = () => {
					$('.logo-preview').attr('src', reader.result);
					$('#picture').val(reader.result);
				};
				reader.readAsDataURL(blob);
				$('.logo-preview').removeClass("d-none");
				$('.item-img').val('');
				$('.drag-label').hide();
				$('.logo-buttons').removeClass("d-none");
			})
			.catch(err => {
				$('.logo-preview').attr('src', "");
				$('#picture').val("");
			});
	}

	if($('#review-platform').length) {
		let options = '';
		const platforms = $(this).find(':selected').data('platforms');

		if(platforms && platforms.length) {
			platforms.forEach(platform => {
				options += `<option value="${platform.id}">${platform.name}</option>`;
			});
		}

		$('#review-platform').html(options);
	}
});

$(document).on('change', 'input[name="color"]', function() {
	$("#selected-color").val(this.value).trigger('change');
});

$(document).on('change', "#selected-color", function() {
	const selectedColor = this.value;
	$(".change-bg-color").css('background-color', selectedColor);

	const styleId = 'existing-style';
	const $existingStyle = $(`#${styleId}`);

	const cssRules = `
	.rating label:hover::before,
	.rating label:hover ~ *::before,
	.rating input:checked ~ label::before {
		color: ${selectedColor} !important;
	}
	label.rating-circle:hover {
		border-color: ${selectedColor};
		filter: drop-shadow(0 0 4px);
	}
	input[type="radio"]:checked + label.rating-circle {
		background-color: ${selectedColor};
		color: #ffffff;
		border-color: ${selectedColor};
		box-shadow: 0 0 10px ${selectedColor};
	}`;

	if ($existingStyle.length) {
		$existingStyle.html(cssRules);
	} else {
		$('<style>', {
			id: styleId,
			text: cssRules
		}).appendTo('head');
	}

	const hasMatch  = $('input[name="color"]').filter(function () {
		return selectedColor === this.value;
	}).length > 0;

	if(!hasMatch) {
		$('input[name="color"]').prop('checked', false);
	}
});

$(document).on('click', '.remove-question', function() {
	const id = $(this).attr('id');
	$(`.${id}`).remove();
	resetQuestionNumbers();
});

$(document).on('input', '.question-list > input[name="questions[]"]', function() {
	const className = $(this).closest('.question-list').find("a").attr('id');
	const question  = $("#questions").find(`.${className}`).find("h6");
	let html = question.html();

	let spanMatch = html.match(/<span[^>]*>.*?<\/span>/);
	let prefix = "";

	if (spanMatch) {
		prefix = html.substring(0, html.indexOf(spanMatch[0]) + spanMatch[0].length);
	}

	question.html(`${prefix}. ${$(this).val()}`);
});

const iconFormat = (ficon) => {
	if (!ficon.id) {
		return ficon.text;
	}

	return `<i class='flag-icon flag-icon-${$(ficon.element).data("flag")}'></i>${ficon.text}`;
}

const initSelectWithFlag = (element) => {
	const $element = $(element);
	const options = {
		templateResult: iconFormat,
		templateSelection: iconFormat,
		escapeMarkup: function (es) {
			return es;
		},
	};

	if ($element.closest('#general-modal').length > 0) {
		options.dropdownParent = $('#general-modal');
	}

	$element.select2(options);
}

function typeWriterEffect(text, element) {
	const speed = 20;
	let index = 0;
	const $el = $(element);

	if (!$el.length) return;

	$el.val('');

	if ($el.data('type-writer-timeout')) {
		clearTimeout($el.data('type-writer-timeout'));
	}

	function updateRows(currentText) {
		const approxCharsPerRow = 50;
		const rowsNeeded = Math.ceil(currentText.length / approxCharsPerRow);
		$el.attr('rows', (rowsNeeded || 1) + 2);
	}

	function type() {
		if (index < text.length) {
			let currentVal = $el.val();
			let newVal = currentVal + text.charAt(index);
			$el.val(newVal);
			updateRows(newVal);
			index++;
			const timeout = setTimeout(type, speed);
			$el.data('type-writer-timeout', timeout);
		} else {
			$el.removeData('type-writer-timeout');
		}
	}

	type();
}