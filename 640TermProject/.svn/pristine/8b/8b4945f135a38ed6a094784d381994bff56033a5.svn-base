/*
	Match button class to send POST request with the id of item to publish.php
	If the script succeeds, change the table data field of status to 'Published' or
	'Unpublished on the fly'. 

	Also added delete functionality to item and user.
	jQuery finds by button 'name' attr rather than class for delete because they
	were overlapping

	- Ari 
*/
$(function(){
	$("button[name='publish']").click(function(e){
		e.preventDefault();
		var the_id = $(this).attr("id");
		var that = this;
		var unpublishButton = $(that).closest('td').next().find('button');
		$.ajax({
			url:  "publish.php",
			type: "POST",
			data: {publish_id: the_id},
			success: function(result){
				$(that).closest("td").prev().html("Published");
				$(that).addClass("active");
				unpublishButton.removeClass("active");
			},
			error: function(result){
				console.log(result);
			}
		});
	});
	$("button[name='unpublish']").click(function(e){
		e.preventDefault();
		var the_id = $(this).attr("id");
		var that = this;
		var publishButton = $(that).closest('td').prev().find('button');
		$.ajax({
			url: "publish.php",
			type: "POST",
			data: {deny_id: the_id},
			success: function(result){
				$(that).closest("td").prev().prev().html("Unpublished");
				$(that).addClass("active");
				publishButton.removeClass("active");
			},
			error: function(result){
				console.log(result);
			}
		});
	});
	$("button[name='deleteItem']").click(function(e){
		e.preventDefault();
		var the_id = $(this).attr("id");
		var that = this;
		if (confirm("Delete this item?") == true) {
			$.ajax({
				url: "publish.php",
				type: "POST",
				data: {delete_id: the_id},
				success: function(result){
					$(that).closest("tr").remove();
					// If we are on the account page
					if(window.location.href.indexOf("account.php") > -1){
						var itemCount = $("#userListings tbody").children('tr').size()-1;
						if(itemCount > 0){
							$("#numItems").text(itemCount);
						} else if(itemCount == 0){
							$("#numItemsText").remove();
							$("#userListings").remove();
							$("#tableHolder").append('<p class="lead text-center">You currently have no items listed</p>');
						}
					}

				},
				error: function(result){
					console.log(result);
				}
			});

		} else {
			return 0;
		}
	});
	$("button[name='deleteUser']").click(function(e){
		e.preventDefault();
		var the_id = $(this).attr("id");
		var that = this;
		if (confirm("Delete this user?") == true) {
			$.ajax({
				url: "publish.php",
				type: "POST",
				data: {user_id: the_id},
				success: function(result){
					$(that).closest("tr").remove();
					console.log(result);
				},
				error: function(result){
					console.log(result);
				}
			});

		} else {
			return 0;
		}
	});
	$("button[name='makeAdmin']").click(function(e){
		e.preventDefault();
		var the_id = $(this).attr("id");
		var that = this;
		if (confirm("Notice: you can't undo this action.\nPlease only grant admin rights to trusted users registered with company emails.") == true) {
			$.ajax({
				url: "publish.php",
				type: "POST",
				data: {admin_id: the_id},
				success: function(result){
					$(that).addClass("active");
					console.log(result);
				},
				error: function(result){
					console.log(result);
				}
			});

		} else {
			return 0;
		}
	});
});
