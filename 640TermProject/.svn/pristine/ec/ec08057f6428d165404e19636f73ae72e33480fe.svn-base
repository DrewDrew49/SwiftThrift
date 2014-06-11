$(document).ready(function() {
	// Hash in url
	var hash = window.location.hash;
	if(hash != ''){
		$("#tabs").children('li').each(function(i){
			var link = $(this).children('a');
			if(link[0].hash == hash){
				link.click();
			}
		});
	}

	// Tab change
	$("#tabs a").click(function(e){
		e.preventDefault();
		window.location.hash = this.hash;
	});

	// Refresh
	$("#refresh").click(function(){
		location.reload(true);
	});

	if(window.location.href.indexOf("account.php") > -1){
		// Dropdown user menu
		$('#myinfo').click(function(e){
			e.preventDefault();
			$('#tabs a[href="#info"]').tab('show');
			window.location.hash = this.hash;
		});

		$('#myposts').click(function(e){
			e.preventDefault();
			$('#tabs a[href="#posts"]').tab('show');
			window.location.hash = this.hash;
		});
	}

});
