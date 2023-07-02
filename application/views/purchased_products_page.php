<?php
	$sessionData = $this->session->userdata('client_session');

    if (!$sessionData) {
		redirect(base_url('client_login'));
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kruhay Animal Clinic - Purchases Products</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="<?php echo base_url(); ?>static/images/logo.ico" rel="icon">
    <meta name="description" content="Kruhay Animal Clinic">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="<?php echo base_url(); ?>static/landing_page/lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url(); ?>static/landing_page/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>static/landing_page/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url(); ?>static/landing_page/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>static/css/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'pages/landing/topbar.php';?>
    <?php include 'pages/landing/navbar.php';?>

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="d-flex flex-column text-center mb-5 pt-5">
            <h1 class="display-4 m-0"><span class="text-secondary">Purchased</span> <span class="text-primary">Products</span></h1>
        </div>
        <div class="row justify-content-center col-12 col-sm-12 mb-5">
            <div class="col-12 col-sm-12 mb-5">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tbl_reservations" width="100%" cellspacing="0">
                                <thead>
                                    <tr style="background-color: #6c757d;" class="text-warning">
                                        <th>Product</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Date Purchased</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php foreach($purchased_products as $purchased_product){?>
                                        <tr>
                                            <td><?php echo $purchased_product->product_name . ' (&#8369;' . $purchased_product->product_amount . ')'; ?></td>
                                            <td><?php echo $purchased_product->payment_method;?></td>
                                            <td><?php echo $purchased_product->status;?></td>
                                            <td><?php echo $purchased_product->date_purchased;?></td>
                                        </tr> 
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <?php include 'pages/landing/footer.php';?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>static/landing_page/lib/easing/easing.min.js"></script>
    <script src="<?php echo base_url(); ?>static/landing_page/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>static/landing_page/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>static/landing_page/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?php echo base_url(); ?>static/landing_page/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?php echo base_url(); ?>static/landing_page/js/main.js"></script>
    <script src="<?php echo base_url(); ?>static/SBAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="<?php echo base_url(); ?>static/js/client_logout.js"></script>
</body>
</html>