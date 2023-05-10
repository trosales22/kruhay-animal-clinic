<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kruhay Animal Clinic - Products</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>static/images/logo.ico"/>
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

    <!-- Products Start -->
    <div class="container-fluid bg-light pt-5">
        <div class="container py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h1 class="text-secondary mb-3"><span class="text-primary">Our</span> Products</h1>
            </div>
            <div class="row pb-3">
                <?php 
                    if(empty($products)){
                        echo "<img src='" . base_url() . "static/images/no_record_found.png' style='width: 250px; height: 100%; margin-left: auto; margin-right: auto;' />";
                    }else{
                ?>
                <?php foreach($products as $product){?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                            <?php 
                                if(empty($product->file_name)){
                                    echo "<img src='" . base_url() . "static/images/logo.png' style='width: 150px; height: 150px; margin-left: auto; margin-right: auto;' />";
                                }else{
                                    echo "<img src='" . $product->file_name . "' style='width: 150px; height: 150px; margin-left: auto; margin-right: auto;' />";
                                }
                            ?>
                            <h3 class="mb-3"><?php echo $product->name;?></h3>
                            <p style="text-align: left;">
                                <b>Details:</b> <?php echo $product->short_desc;?></br>
                                <b>Amount:</b> ₱<?php echo $product->amount;?><br/>
                                <b>Qty:</b> <?php echo $product->quantity;?>
                            </p>

                            <?php 
                                if($product->quantity <= 0){
                                    echo '
                                    <div class="alert alert-danger">
                                        <span class="icon text-red-50" style="margin-right: auto;">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span> <b>Out of stock</b>
                                    </div>
                                    ';
                                }else{
                            ?>
                            <a href="#" data-toggle="modal" data-id="<?php echo $product->id;?>" data-target="#buyProductModal" class="btnBuyProduct btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-shopping-cart"></i>
                                </span>
                                <span class="text">Buy</span>
                            </a>
                            <?php }?>
                        </div>
                    </div>
                <?php }}?>
            </div>
        </div>
    </div>
    <!-- Products End -->

    <?php include 'pages/landing/modals/buy_product.php';?>
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
    <!-- Stripe JS library -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?php echo base_url(); ?>static/js/client_product.js" STRIPE_PUBLISHABLE_KEY="<?php echo $this->config->item('stripe_key'); ?>" defer></script>
    <script src="<?php echo base_url(); ?>static/js/client_logout.js"></script>
</body>
</html>