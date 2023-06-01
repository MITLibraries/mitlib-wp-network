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

	// Call Responsive Tabs plugin.
	$tabs.responsiveTabs({
		rotate: false,
		startCollapsed: false,
		collapsible: false,
		setHash: true
	});


	$( '#search_tabs_nav a' ).click( function(e) {
		$( '#search_tabs_nav a' ).removeAttr( "aria-expanded" );
		$( '#search_tabs_nav a .current' ).remove();
		$(this).attr( "aria-expanded", "true" ).prepend( "<span class='sr current'>Current: </span>" );
	});

	// prevent submission until text field is not empty 
	preventSearch( '#searchinput-bento', '.search-bento .button-search');

	preventSearch( '#searchinput-bookslocal', 'form#booksearch .button-search');

	preventSearch( '#searchinput-article', 'form#edssearch .button-search');

	preventSearch( '#searchinput-site', '.search-site .button-search');


});

