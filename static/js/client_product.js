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

function buyProduct(){
	$("#frmBuyProduct").submit(function(e) {
		e.preventDefault();
		var formAction = e.currentTarget.action;
		var formData = new FormData(this);
		var formType = "POST";
		
		Swal.fire({
			title: 'Confirmation',
			text: "Are you sure you want to continue?",
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
									location.replace(base_url() + 'purchased_products');
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

$( document ).ready(function() {
    $('.btnBuyProduct').click(function(){
        var checkoutProductId = $(this).data("id");
        var productDetailsUrl = base_url() + 'api/products/get_product_by_id?product_id=' + checkoutProductId;
        $.getJSON(productDetailsUrl, function(response) {
            $('input[name=checkout_product_id]').val(response.id);
            $('input[name=checkout_product_amount]').val(response.amount);
    
            if(response.file_name === null){
                $('.checkout_product_image').attr('src', base_url() +  'static/images/logo.png');
            }else{
                $('.checkout_product_image').attr('src', response.file_name);
            }
      
            $(".checkout_product_name").text(response.name);
            $(".checkout_product_short_desc").text(response.short_desc);
            $(".checkout_product_long_desc").text(response.long_desc);
            $(".checkout_product_amount").text(response.amount);
            $(".checkout_product_quantity").text(response.quantity);

            if(response.quantity <= 0){
                document.querySelector("#btnProceedBuyProduct").style.display = "none";
            }
        });
    });

    buyProduct();
});

