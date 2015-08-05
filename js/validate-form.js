function buildElement(formId, fieldId) {
	var element = "form#"+formId+" #"+fieldId;
	return element;
}

function focusOnFirstError(formId) {
	$('form#'+formId+' input.'+inputErrorClass+':first').focus();
}

function formsToIgnore() { //check for forms to ignore
	var formIgnoreItems = "";
	for (i=0;i<ignoreForms.length;i++) {
		if (i>0) {
			formIgnoreItems += ", "; 
		}
		formIgnoreItems += ignoreForms[i];
	}
	return formIgnoreItems;
}

function countFormErrors(formId) {
	var errorCounter = $('form#'+formId+' '+inputWrapper+'.'+inputWrapperErrorClass).size();
	return errorCounter;
}

function addFormError(formId) {
	var formSelector = 'form#'+formId;
	var errorMessageSelector = formSelector+' p.error-summary';
	var errorCounter = countFormErrors(formId);
	if (errorCounter > 0) {
		if ($(errorMessageSelector).length) {
			$(errorMessageSelector).html(errorCounter + ' field(s) are invalid.');
		} else {
			$(formSelector).prepend('<p class=\"error-summary\">' + errorCounter + ' field(s) are invalid.</p>');
		}
	}
}

function removeAllErrors(formId) {
	removeFormError(formId);
	removeAllFieldErrors(formId);
}

function removeFormError(formId) {
	$('form#'+formId+' p.error-summary').remove();
}

function removeAllFieldErrors(formId) {
	var formSelector = 'form#'+formId;
	$(formSelector+' '+inputWrapper).removeClass(inputWrapperErrorClass);
	$(formSelector+' input[type=text], '+formSelector+' textarea, '+formSelector+' select, '+formSelector+' input[type=checkbox], '+formSelector+' input[type=password], '+formSelector+' input[type=file], '+formSelector+' input[type=radio]').removeClass(inputErrorClass);
	$(formSelector+' '+inputWrapper+' p.error-message').remove();
}

function addFieldError(formId, fieldId, fieldErrorMessage) {
	var element = buildElement(formId, fieldId);
	$(element).addClass(inputErrorClass)
			  .parents(inputWrapper).addClass(inputWrapperErrorClass)
									.append('<p class=\"error-message\">' + fieldErrorMessage + '</p>');
}

function removeFieldError(formId, fieldId) {
	var element = buildElement(formId, fieldId);
	$(element).removeClass(inputErrorClass)
			  .parents(inputWrapper).removeClass(inputWrapperErrorClass);
	$(element).parents(inputWrapper).children('p.error-message').remove();
}

function validateAlpha(alpha) {
	var regex = /^[-\sa-zA-Z]+$/
	return regex.test(alpha);
}

function validateDigit(digit) {
	var regex = /^[0-9]+$/
	return regex.test(digit);
}

/*function validateEmail(email) {
	var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	return regex.test(email);
}
*/
function validateField(formId, fieldId) {
	if (fieldId) {
		removeFieldError(formId, fieldId);
	
		var element = buildElement(formId, fieldId);
		var fieldValue = jQuery.trim(jQuery(element).val());
		var fieldLength = fieldValue.length;
		var fieldErrorMessage = "";
		
		if ($(element).hasClass('text')) {			
			if ($(element).hasClass('alpha')  && fieldLength > 0) { // from string start to end, only contains '-' "whitespace" or 'aA'-'zZ' 
				if (validateAlpha(fieldValue) == false) {
					fieldErrorMessage = alphaFieldError;
				}
			} else if ($(element).hasClass('digit')  && fieldLength > 0) {
				if (validateDigit(fieldValue) == false) {
					fieldErrorMessage = digitFieldError;
				}
			} else if ($(element).hasClass('email')  && fieldLength > 0) {
				if (validateEmail(fieldValue) == false) {
					fieldErrorMessage = emailFieldError;
				}
			} else if ($(element).hasClass('required') && fieldLength == 0) {
				fieldErrorMessage = requiredTextError;
			} 
		} else if ($(element).is('.textarea.required') && fieldLength == 0) {
			fieldErrorMessage = requiredTextareaError;
		} else if ($(element).is('.password.required') && fieldLength == 0) {
			fieldErrorMessage = requiredPasswordError;
		} else if ($(element).is('.password.confpwd_required') && (fieldValue != password.value)) {
				fieldErrorMessage = confpwdFieldError;
		} else if ($(element).is('.confpassword') && (fieldValue != password.value && fieldLength != 0)) {
				fieldErrorMessage = confpwdFieldError;
		} else if ($(element).is('.checkbox.required') && !$(element).is(':checked')) {
			fieldErrorMessage = requiredCheckboxError;
		} else if ($(element).is('.radio.required')) {
			if((batchfrm.batch_type[0].checked == false) && (batchfrm.batch_type[1].checked == false)) {
				fieldErrorMessage = requiredRadioError;
			}
		} else if ($(element).is('.select.required') && (fieldLength == 0 || fieldValue == '')) {
			fieldErrorMessage = requiredSelectError;
		}   
		
		if (!fieldErrorMessage) {
			return false;
		} else {
			if (customErrorSelectors.length > 0) {
				for (i=0;i<customErrorSelectors.length;i++) { //check for overrides
					if (customErrorSelectors[i] == element) {
						fieldErrorMessage = customErrorMessages[i];
					}
				}
			}
			addFieldError(formId, fieldId, fieldErrorMessage);
			return true;
		}
	}
}

function validateForm(formId, matchingElements) {
	removeAllErrors(formId);
	
	matchingElements.each(function(index) {
		var elementId = $(this).attr('id');
		var fieldErrorStatus = validateField(formId, elementId);
	});
	
	if (countFormErrors(formId) > 0) {
		if (focusFirstError == true) {
			focusOnFirstError(formId);
		}
		if (errorSummary == true) {
			addFormError(formId);
		}
		return true;
	} else {
		if (errorSummary == true) {
			removeFormError(formId);
		}
		return false;
	}
}

$().ready(function() {
	//attach plugin to all forms with a submit button (except for ignored forms)
	$('form:not('+ formsToIgnore() +')').submit(function() {
		var formId = $(this).attr('id');
		var matchingElements = $('form#'+ formId +' input[type=text], form#'+ formId +' textarea, form#'+ formId +' select, form#'+ formId +' input[type=checkbox], form#'+ formId +' input[type=password], form#'+ formId +' input[type=file], form#'+ formId +' input[type=radio]');
		if (!matchingElements == "") {
			var formError = validateForm(formId, matchingElements);
			if (formError == true) {
				return false
			} else {
				return true;
			}
		}
	});
	
	//check whether to eagerly validate each field
	/*if (eagerValidation == true) {
		$('form input[type=text], form textarea, form select, form input[type=checkbox], form input[type=password], form input[type=file], form input[type=radio]').focusout(function() {
			var fieldId = $(this).attr('id');
			var formId = $('#'+fieldId).parents('form').attr('id');
			if (validateField(formId, fieldId) == false) {
				removeFieldError(formId, fieldId);
			}
			removeFormError(formId);
			addFormError(formId);
		});
	}*/
});