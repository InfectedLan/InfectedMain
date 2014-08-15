$(document).ready(function() {
	$('.game-application-add').submit(function(e) {
		e.preventDefault();
		$.getJSON('../api/json/addGameApplication.php' + '?' + $(this).serialize(), function(data){
			if (data.result) {
				$(location).attr('href', 'pages/competitions.html');
			} else {
				error(data.message); 
			}
		});
	});
});