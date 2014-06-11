$(document).ready(function(){
	// Once a dropdown element is clicked
	$('#category-selector li > a').click(function(e){
		e.preventDefault();
		// Update the visible text
		$('.dropdown-toggle').html(this.innerHTML + ' <span class="caret"></span>');
		// And the hidden input
		$("input[name=categoryID]").val($(this).data("id"));
	});
});
