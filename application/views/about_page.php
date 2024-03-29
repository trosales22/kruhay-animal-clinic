<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kruhay Animal Clinic - About</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="<?php echo base_url(); ?>static/images/logo.ico" rel="icon">
    <meta name="description" content="Kruhay Animal Clinic">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="static/landing_page/lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="static/landing_page/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="static/landing_page/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="static/landing_page/css/style.css" rel="stylesheet">
    <link href="static/css/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'pages/landing/topbar.php';?>
    <?php include 'pages/landing/navbar.php';?>

    <!-- About Start -->
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
                <h4 class="text-secondary mb-3">About Us</h4>
                <h5 class="text-muted mb-3">Kruhay Animal Clinic Background</h5>
                <p class="mb-4">
                The clinic was name after a Kinaray-a word "Kruhay" means "Long Live!” a language native in Antique. 
                The owner, Dr. Petuco is a proud Antiqueño. Dr. Petuco worked at Doctor Binglo’s Pet Station in Cebu City. 
                He then moved to Manila for Animal Station in White Plains Quezon City and worked for nine years in 
                Fil-Chinese Animal Clinic in Ortigas Extension before starting his own Animal Clinic, which is the Kruhay Animal Clinic. 
                The clinic was slowly recognized for having a good customer service, experienced and passionate doctor 
                towards his patients (dogs and cats). Kruhay Animal Clinic has now hundreds of regular customers/client in Parañaque and nearby cities. 
                At first, Dr. Petuco run the clinic by himself before making a team made up of Antiqueños. 
                Three assistants, Carl Jay Onido, Christian Sumande, and Ernesto Beloya. Jestoni Beloya is the groomer of the animal clinic.
                </p>
            </div>
            <div class="col-lg-5">
                <div class="row px-3">
                    <div class="col-12 p-0">
                        <img class="img-fluid w-100" src="<?php echo base_url(); ?>static/landing_page/img/about-4.jpeg">
                    </div>
                    <div class="col-12 p-0">
                        <img class="img-fluid w-100" src="<?php echo base_url(); ?>static/landing_page/img/about-5.jpeg">
                    </div>
                </div><br/>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m21!1m12!1m3!1d123636.0534256335!2d120.95846437633963!3d14.448665856185597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m6!3e6!4m0!4m3!3m2!1d14.448620799999999!2d121.02834639999999!5e0!3m2!1sen!2sph!4v1672839895322!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!-- About End -->

    <!-- Features Start -->
    <div class="container-fluid bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid w-100" src="<?php echo base_url(); ?>static/landing_page/img/feature.jpeg">
                </div>
                <div class="col-lg-7 py-5 py-lg-0 px-3 px-lg-5">
                    <h4 class="text-secondary mb-3">Why Choose Us?</h4>
                    <h1 class="display-4 mb-4"><span class="text-primary">Special Care</span> On Pets</h1>
                    <div class="row py-2">
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-4">
                                <h1 class="flaticon-cat font-weight-normal text-secondary m-0 mr-3"></h1>
                                <h5 class="text-truncate m-0">Best In Industry</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-4">
                                <h1 class="flaticon-doctor font-weight-normal text-secondary m-0 mr-3"></h1>
                                <h5 class="text-truncate m-0">Emergency Services</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <h1 class="flaticon-care font-weight-normal text-secondary m-0 mr-3"></h1>
                                <h5 class="text-truncate m-0">Special Care</h5>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <h1 class="flaticon-dog font-weight-normal text-secondary m-0 mr-3"></h1>
                                <h5 class="text-truncate m-0">Customer Support</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    <!-- Team Start -->
    <div class="container mt-5 pt-5 pb-3">
        <div class="d-flex flex-column text-center mb-5">
            <h1 class="display-4 m-0">Meet Our <span class="text-primary">Team Member</span></h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="<?php echo base_url(); ?>static/landing_page/img/team-1.jpeg">
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Dr. Rogette S. Petuco</h5>
                            <i>Owner</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="<?php echo base_url(); ?>static/landing_page/img/team-2.jpeg">
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Carlo Jay Onido</h5>
                            <i>Veterinary assistant</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="<?php echo base_url(); ?>static/landing_page/img/team-3.jpeg">
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Christian Sumande</h5>
                            <i>Veterinary assistant</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team card position-relative overflow-hidden border-0 mb-4">
                    <img class="card-img-top" src="<?php echo base_url(); ?>static/landing_page/img/team-4.jpeg">
                    <div class="card-body text-center p-0">
                        <div class="team-text d-flex flex-column justify-content-center bg-light">
                            <h5>Jestoni Beloya</h5>
                            <i>Groomer</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <?php include 'pages/landing/footer.php';?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="static/js/libraries/jquery-3.4.1.min.js"></script>
    <script src="static/js/libraries/bootstrap.bundle.min.js"></script>
    <script src="static/landing_page/lib/easing/easing.min.js"></script>
    <script src="static/landing_page/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="static/landing_page/lib/tempusdominus/js/moment.min.js"></script>
    <script src="static/landing_page/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="static/landing_page/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="static/landing_page/js/main.js"></script>

    <script src="static/SBAdmin/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="static/js/client_logout.js"></script>
</body>
</html>