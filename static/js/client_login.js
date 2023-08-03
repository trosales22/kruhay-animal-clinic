function base_url() {
	var pathparts = location.pathname.split('/');
	var url;

	if (location.host == 'localhost') {
		url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
	}else{
		url = location.origin + "/"; // http://stackoverflow.com/
	}
	return url;
}

$("#frmLoginClient").submit(function(e) {
    //prevent Default functionality
    e.preventDefault();

    //get the action-url of the form
	var actionUrl = e.currentTarget.action;

	$.ajax({
		url: actionUrl,
		type: 'POST',
		data: $("#frmLoginClient").serialize(),
		success: function(data) {
			var res = $.parseJSON(data);

			if(res.status !== "OK"){
				$.alert({
					title: 'Warning!',
					content: res.msg,
					useBootstrap: false,
					theme: 'supervan',
					buttons: {
						'Ok, Got It!': function () {
							//do nothing
						}
					}
				});
			}else{
				$.alert({
					title: 'Welcome Home!',
					content: 'Successfully logged in.',
					useBootstrap: false,
					theme: 'supervan',
					buttons: {
						'Proceed': function () {
							location.replace(base_url());
						}
					}
				});

				
			}
		},
		error: function(err){
			console.log(err.message);
		}
	});
});
