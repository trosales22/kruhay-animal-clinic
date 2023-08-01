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

$("#frmLoginAdmin").submit(function(e) {
    //prevent Default functionality
    e.preventDefault();

    //get the action-url of the form
	var actionUrl = e.currentTarget.action;

	$.ajax({
		url: actionUrl,
		type: 'POST',
		data: $("#frmLoginAdmin").serialize(),
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		},
		success: function(data) {
			var res = $.parseJSON(data);

			if(res.status !== "OK"){
				Swal.fire(
					'Error!',
					res.msg,
					'error'
				);
			}else{
				Swal.fire({
					title: 'Success!',
					text: 'Successfully logged in.',
					icon: 'success',
					allowOutsideClick: false,
					allowEscapeKey: false,
					showCancelButton: false,
					confirmButtonText: 'Ok, Got It!'
				}).then((result) => {
					if (result.value) {
						location.replace(base_url() + 'admin_home');
					}
				});			
			}
		},
		error: function(xhr, status, error){
			var errorMessage = xhr.status + ': ' + xhr.statusText;
			Swal.fire(
				'Error!',
				errorMessage,
				'error'
			);
		}
	});
});
