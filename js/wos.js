$(document).ready(function() {
	var getSheep = function() {
		var sheepTpl = '<tr><td>##SERVICE##</td><td>##USERNAME##</td><td>##PASSWORD##</td><td>##DEST##</td><td>##INFO##</td></tr>';
		$.getJSON('service.php', {
			service: 'get'
		},
		function(sheep) {
			var tbody = $('#sheep').empty();

			for (var i = 0; i < sheep.length; i++) {
				var html = sheepTpl.replace('##SERVICE##', sheep[i].service).replace('##USERNAME##', sheep[i].username).replace('##PASSWORD##', sheep[i].password).replace('##DEST##', sheep[i].domain_ip).replace('##INFO##', sheep[i].comments.substr(0,50));

				tbody.append(html);
			}
		});
	};

	getSheep();
	setInterval(getSheep, 5000);

	$('#addsheep').click(function() {
		$('input,textarea').prop('disabled', false);
		$('#add').dialog({
			width: 600,
			buttons: {
				'Save': function() {
					$('input,textarea').prop('disabled', true);
					$.post('service.php', {
						service: 'save',
						svc: $('#svc').val(),
						username: $('#username').val(),
						password: $('#password').val(),
						destination: $('#destination').val(),
						comments: $('#comments').val()
					}, function() {
						$('input,textarea').val('');
						$('#add').dialog('close');
						getSheep();
					});
				},
				'Cancel': function() {
					$('#add').dialog('close');
				}
			}
		});
	}).button();

	$('form').submit(function() {
		return false;
	});

	$('#svc').autocomplete({
		source: 'service.php?service=autocompleteSvc',
		minLength: 2
	});
});

