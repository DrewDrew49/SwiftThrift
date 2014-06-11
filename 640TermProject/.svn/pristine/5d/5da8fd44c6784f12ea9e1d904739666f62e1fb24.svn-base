// counts key strokes and subtracts from limit
// updates the characters id in send_message.php to show characters left
$(document).ready(function(){
	var limit = 1500;
	$('#characters').html(limit + ' characters remaining');

	$('#message').keyup(function(){
		var length = $('#message').val().length;
		var remaining = limit - length;

		$('#characters').html(remaining + ' characters remaining');
	});
});