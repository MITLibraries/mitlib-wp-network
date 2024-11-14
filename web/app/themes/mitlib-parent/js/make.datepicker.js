$("#hourCalendar").glDatePicker({
	showAlways: true,
	selectedDate: todayDate,
	
	prevArrow: '<i class="fa-regular fa-arrow-left"></i>',
	nextArrow: '<i class="fa-regular fa-arrow-right"></i>',
	dowNames: "SMTWTFS",
	dowOffset: 1,
	onClick: function(target, cell, date, date2) {
		var newDate = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
		
		var path = window.location.pathname;
		var newUrl = path+"?d="+newDate;

		window.location = newUrl;
	}
	
});