
$(document).ready(function(){
	var table = $('#dtTable').DataTable();

	$("#success-alert").fadeTo(1000, 500).slideUp(500, function(){
    	$("#success-alert").slideUp(500);
    });

    $("#error-alert").fadeTo(1000, 500).slideUp(500, function(){
    	$("#error-alert").slideUp(500);
	});
});