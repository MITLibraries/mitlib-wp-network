function preventSearch(textField,button) {
	var $textField = $( textField );
	var $button = $( button );

	// only one of the two form variants exists on a given page
	if ( ! $textField.length || ! $button.length ) {
		return;
	}

	// By default submit is disabled 
	$button.prop('disabled', true);

	// if has a value from previous search, activate
	if($textField.val().trim().length !=0 ) {			
			$button.prop('disabled', false); 
	}		

	$textField.on('keyup input', function(e) {
		if($(this).val().trim().length !=0 ) {			
			$button.prop('disabled', false); 
		} else {
			$textField.focus();		
		    $button.prop('disabled', true);
		    e.preventDefault();
		}
	});
}

// Toggles clear-search visibility and disables submit while the v2 field is empty
function setupClearSearch(textField,clearButton,submitButton) {
	var field = document.querySelector( textField );
	if ( ! field ) {
		return;
	}

	// scope clear/submit lookups to the field's own form, since their selectors aren't guaranteed unique page-wide
	var scope = field.closest('form') || document;
	var clear = scope.querySelector( clearButton );
	var submit = scope.querySelector( submitButton );
	if ( ! clear || ! submit ) {
		return;
	}

	function toggleState() {
		var hasValue = field.value.trim().length != 0;
		// an empty string here would just fall back to the stylesheet's display:none, so set an explicit value
		clear.style.display = hasValue ? 'inline-block' : 'none';
		submit.disabled = !hasValue;
	}

	toggleState();

	field.addEventListener('keyup', toggleState);
	field.addEventListener('input', toggleState);

	clear.addEventListener('click', function() {
		field.value = '';
		field.focus();
		toggleState();
	});
}


jQuery( document ).ready(function() {
	var $tabs = $('#multisearch');

	// If javascript is present, we disable the nojs class.
	$tabs.removeClass("nojs");

	// add r-tabs class to force styling of the form to be consistent with the other tabs.
	$tabs.addClass("r-tabs");

	// prevent submission until text field is not empty 
	preventSearch( '#searchinput-bento', '.search-bento .button-search');

	// v2 hero form: reveal clear-search button and toggle submit when field has input
	setupClearSearch( '#basic-search-main', '#clear-search', '.btn.button-primary');
});

