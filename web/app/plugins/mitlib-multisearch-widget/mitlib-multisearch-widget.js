// Toggles clear-search visibility and disables submit while the v2 field is empty
function setupClearSearch(textField,clearButton) {
	var field = document.querySelector( textField );
	if ( ! field ) {
		return;
	}

	// scope clear/submit lookups to the field's own form, since their selectors aren't guaranteed unique page-wide
	var scope = field.closest('form') || document;
	var clear = scope.querySelector( clearButton );
	if ( ! clear ) {
		return;
	}

	function toggleState() {
		var hasValue = field.value.trim().length != 0;
		clear.style.display = hasValue ? 'inline-block' : 'none';
	}

	toggleState();

	field.addEventListener('keyup', toggleState);
	field.addEventListener('input', toggleState);

	// Clear the input when the clear button is clicked
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

	// v2 hero form: reveal clear-search button and toggle submit when field has input
	setupClearSearch( '#basic-search-main', '#clear-search');
});

