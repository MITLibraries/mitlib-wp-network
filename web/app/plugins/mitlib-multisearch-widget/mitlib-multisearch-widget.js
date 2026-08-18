function preventSearch(textField,button) {

	// By default submit is disabled 
	$( button ).prop('disabled', true);

	// if has a value from previous search, activate
	if($( textField ).val().trim().length !=0 ) {			
			$( button ).prop('disabled', false); 
	}		

	$( textField ).on('keyup input', function(e) {
		if($(this).val().trim().length !=0 ) {			
			$( button ).prop('disabled', false); 
		} else {
			$( textField ).focus();		
		    $( button ).prop('disabled', true);
		    e.preventDefault();
		}
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
});

