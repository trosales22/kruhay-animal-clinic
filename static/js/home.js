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

function isEmpty(value){
	return (
	  // null or undefined
	  (value == null) ||
  
	  // has length and it's zero
	  (value.hasOwnProperty('length') && value.length === 0) ||
  
	  // is an Object and has no keys
	  (value.constructor === Object && Object.keys(value).length === 0)
	);
}

//initialize datatable
$('#tbl_reservations').DataTable();
$('#tbl_products').DataTable();

$('#inputProductAmount').maskMoney();

//products
function addProduct(){
	$("#frmAddProduct").submit(function(e) {
		e.preventDefault();
		var formAction = e.currentTarget.action;
		var formData = new FormData(this);
		var formType = "POST";
		
		Swal.fire({
			title: 'Confirmation',
			text: "Are you sure you want to add this product?",
			icon: 'warning',
			showCancelButton: true,
			reverseButtons: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: formAction,
					type: formType,
					data: formData,
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function(data) {
						var obj = data;
							
						if(obj.flag === 0){
							Swal.fire(
								'Error!',
								obj.msg,
								'error'
							);
						}else{
							Swal.fire({
								title: 'Success!',
								text: obj.msg,
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
			}
		});
	});
}

$('.btnAddProduct').click(function(){
	//clear all fields
	$("input[name='name']").val("");
	$("input[name='short_desc']").val("");
	$("input[name='long_desc']").val("");
	$("input[name='amount']").val("");
	$("input[name='quantity']").val("");
});

addProduct();
