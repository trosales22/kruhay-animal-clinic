<?php
	$sessionData = $this->session->userdata('client_session');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kruhay Animal Clinic - Contact Us</title>
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
            <h4 class="text-secondary mb-3">Contact Us</h4>
            <h1 class="display-4 m-0">Contact For <span class="text-primary">Any Query</span></h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form id="frmSubmitFeedback" method="POST" action="<?php echo base_url(). 'api/feedback/submit_feedback'; ?>">
                        <div class="control-group">
                            <input type="text" class="form-control p-4" name="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" spellcheck="false" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control p-4" name="mobile_number" placeholder="Mobile Number" required="required" data-validation-required-message="Please enter your mobile number" spellcheck="false" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control p-4" name="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" spellcheck="false" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control p-4" name="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" spellcheck="false"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control p-4" rows="6" name="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message" style="resize: none;" spellcheck="false"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <?php
                            if($sessionData){
                            ?>
                            <div>
                                <button class="btn btn-primary py-3 px-5" type="submit" id="sendMessageButton">Submit</button>
                            </div>
                            <?php }else{?>
                            <div class="alert alert-danger">
                                <span class="icon text-red-50" style="margin-right: auto;">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span> <b>Login to proceed.</b>
                            </div>
                        <?php }?>
                    </form>
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

    <!-- Contact Javascript File -->
    <script src="<?php echo base_url(); ?>static/landing_page/mail/jqBootstrapValidation.min.js"></script>
    <script src="<?php echo base_url(); ?>static/landing_page/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="<?php echo base_url(); ?>static/landing_page/js/main.js"></script>
    <script src="<?php echo base_url(); ?>static/SBAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="<?php echo base_url(); ?>static/js/feedback.js"></script>
    <script src="<?php echo base_url(); ?>static/js/client_logout.js"></script>
</body>
</html>