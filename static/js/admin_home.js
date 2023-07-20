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
$('#tbl_services').DataTable();
$('#tbl_purchased_products').DataTable();
$('#tbl_feedbacks').DataTable();

$('#inputProductAmount').maskMoney();
$('#inputServiceAmount').maskMoney();
$('#frmEditProductTxtProductAmount').maskMoney();
$('#frmEditServiceTxtServiceAmount').maskMoney();

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
						var obj = JSON.parse(data);
							
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

$(document.body).on('click', '.btnAddProduct', function() {
	//clear all fields
	$("input[name='name']").val("");
	$("input[name='short_desc']").val("");
	$("input[name='long_desc']").val("");
	$("input[name='amount']").val("");
	$("input[name='quantity']").val("");
});

addProduct();

$(document.body).on('click', '.btnEditProduct', function() {
	var productId = $(this).data('id');
	var url = base_url() + 'api/products/get_product_by_id?product_id=' + productId;
	$.getJSON(url, function(response) {
		$("input[name='product_id']").val(response.id);
		$("input[id='frmEditProductTxtProductName']").val(response.name);
		$("textarea[id='frmEditProductTxtProductShortDesc']").val(response.short_desc);
		$("textarea[id='frmEditProductTxtProductLongDesc']").val(response.long_desc);
		$("input[id='frmEditProductTxtProductAmount']").val(response.amount);
		$("input[id='frmEditProductTxtProductQuantity']").val(response.quantity);
		$("input[id='frmEditProductTxtProductExpirationDate']").val(response.expiration_date);
	});
});

function modifyProduct(){
	$("#frmEditProduct").submit(function(e) {
		e.preventDefault();
		var formAction = e.currentTarget.action;
		var formData = new FormData(this);
		var formType = "POST";

		Swal.fire({
			title: 'Confirmation',
			text: "Are you sure you want to modify this product?",
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

modifyProduct();

function deleteProduct(){
	$(document.body).on('click', '.btnDeleteProduct', function() {
		var productId = $(this).data('id');

		Swal.fire({
			title: 'Confirmation',
			text: "Are you sure you want to delete this product?",
			icon: 'warning',
			showCancelButton: true,
			reverseButtons: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: base_url() + 'api/products/delete_product?product_id=' + productId,
					type: 'DELETE',
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function(data) {
						var obj = JSON.parse(data);
							
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

deleteProduct();

//services
function addService(){
	$("#frmAddService").submit(function(e) {
		e.preventDefault();
		var formAction = e.currentTarget.action;
		var formData = new FormData(this);
		var formType = "POST";
		
		Swal.fire({
			title: 'Confirmation',
			text: "Are you sure you want to add this service?",
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
						var obj = JSON.parse(data);
							
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

$(document.body).on('click', '.btnAddService', function() {
	//clear all fields
	$("input[name='name']").val("");
	$("input[name='short_desc']").val("");
	$("input[name='long_desc']").val("");
	$("input[name='amount']").val("");
});

addService();

$(document.body).on('click', '.btnEditService', function() {
	var serviceId = $(this).data('id');
	var url = base_url() + 'api/services/get_service_by_id?service_id=' + serviceId;
	$.getJSON(url, function(response) {
		$("input[name='service_id']").val(response.id);
		$("input[id='frmEditServiceTxtServiceName']").val(response.name);
		$("textarea[id='frmEditServiceTxtServiceShortDesc']").val(response.short_desc);
		$("input[id='frmEditServiceTxtServiceAmount']").val(response.amount);
	});
});

function modifyService(){
	$("#frmEditService").submit(function(e) {
		e.preventDefault();
		var formAction = e.currentTarget.action;
		var formData = new FormData(this);
		var formType = "POST";

		Swal.fire({
			title: 'Confirmation',
			text: "Are you sure you want to modify this service?",
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

modifyService();

function deleteService(){
	$(document.body).on('click', '.btnDeleteService', function() {
		var serviceId = $(this).data('id');

		Swal.fire({
			title: 'Confirmation',
			text: "Are you sure you want to delete this service?",
			icon: 'warning',
			showCancelButton: true,
			reverseButtons: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: base_url() + 'api/services/delete_service?service_id=' + serviceId,
					type: 'DELETE',
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function(data) {
						var obj = JSON.parse(data);
							
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

deleteService();

function openTab(evt, id) {
	// Declare all variables
	var i, tabcontent, tablinks;
  
	// Get all elements with class="tabcontent" and hide them
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
	  tabcontent[i].style.display = "none";
	}
  
	// Get all elements with class="tablinks" and remove the class "active"
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
	  tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
  
	// Show the current tab, and add an "active" class to the button that opened the tab
	document.getElementById(id).style.display = "block";
	evt.currentTarget.className += " active";
}