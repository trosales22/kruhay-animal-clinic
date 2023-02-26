<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kruhay Animal Clinic</title>
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

    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="<?php echo base_url(); ?>static/landing_page/img/carousel-1.jpeg">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h3 class="text-white mb-3 d-none d-sm-block">Best Pet Services</h3>
                            <h1 class="display-3 text-white mb-3">Keep Your Pet Happy</h1>
                            <a href="<?php echo base_url(); ?>bookings" class="btn btn-lg btn-primary mt-3 mt-md-4 px-4">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="<?php echo base_url(); ?>static/landing_page/img/carousel-2.jpeg">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h3 class="text-white mb-3 d-none d-sm-block">Best Pet Services</h3>
                            <h1 class="display-3 text-white mb-3">Pet Spa & Grooming</h1>
                            <a href="<?php echo base_url(); ?>bookings" class="btn btn-lg btn-primary mt-3 mt-md-4 px-4">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
                <h1 class="display-4 mb-4"><span class="text-primary">About</span> <span class="text-secondary">Us</span></h1>
                <h5 class="text-muted mb-3">Kruhay Animal Clinic Background</h5>
                <p class="mb-4">
                The clinic was name after a Kinaray-a word "Kruhay" means "Long Live!” a language native in Antique. The owner, Dr. Petuco is a proud Antiqueño.
                Dr. Petuco worked at Doctor Binglo’s Pet Station in Cebu City. He then moved to Manila for Animal Station in White Plains Quezon City 
                and worked for nine years in Fil-Chinese Animal Clinic in Ortigas Extension before starting his own Animal Clinic, which is the Kruhay Animal Clinic.
                The clinic was slowly recognized for having a good customer service, experienced and passionate doctor towards his patients (dogs and cats). 
                Kruhay Animal Clinic has now hundreds of regular customers/client in Parañaque and nearby cities.<br/><br/>

                At first, Dr. Petuco run the clinic by himself before making a team made up of Antiqueños. Three assistants, Carl Jay Onido 21 years old, 
                Christian Sumande 22 years old, and Ernesto Beloya, 27 years old. Jestoni Beloya, 33 years old is the groomer.
                </p>
            </div>
            <div class="col-lg-5">
                <div class="row px-3">
                    <div class="col-12 p-0">
                        <img class="img-fluid w-100" src="<?php echo base_url(); ?>static/landing_page/img/about-1.jpeg">
                    </div>
                    <div class="col-6 p-0">
                        <img class="img-fluid w-100" src="<?php echo base_url(); ?>static/landing_page/img/about-2.jpeg">
                    </div>
                    <div class="col-6 p-0">
                        <img class="img-fluid w-100" src="<?php echo base_url(); ?>static/landing_page/img/about-3.jpeg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Services Start -->
    <div class="container-fluid bg-light pt-5">
        <div class="container py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h4 class="text-secondary mb-3">Our Services</h4>
                <h1 class="display-4 m-0"><span class="text-primary">Premium</span> Pet Services</h1>
            </div>
            <div class="row pb-3">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-house display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Pet Boarding</h3>
                        <p>It's taking your dog or cat to a facility away from home for an overnight stay or longer.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-vaccine display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h4 class="mb-3">Pet Vaccination</h4>
                        <p>Core vaccines are considered vital to all pets based on risk of exposure, severity of disease or transmissibility to humans</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-grooming display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Pet Grooming</h3>
                        <p>With proper pet grooming, you will get rid of shedding, fleas, ticks, and various health conditions.</</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    <!-- Features Start -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <img class="img-fluid w-100" src="<?php echo base_url(); ?>static/landing_page/img/feature.jpeg">
            </div>
            <div class="col-lg-7 py-5 py-lg-0 px-3 px-lg-5">
                <h4 class="text-secondary mb-3">Why Choose Us?</h4>
                <h1 class="display-4 mb-4"><span class="text-primary">Special Care</span> On Pets</h1>
                <p class="mb-4">Kruhay Animal Clinic welcomes you & your dogs/cats! Our services range from vaccination, diagnosis</p>
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
    <!-- Features End -->

    <!-- Testimonial Start -->
    <div class="container-fluid bg-light my-5 p-0 py-5">
        <div class="container p-0 py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h4 class="text-secondary mb-3">Testimonial</h4>
                <h1 class="display-4 m-0">Our Client <span class="text-primary">Says</span></h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="bg-white mx-3 p-4">
                    <div class="d-flex align-items-end mb-3 mt-n4 ml-n4">
                        <img class="img-fluid" src="<?php echo base_url(); ?>static/images/testimonials/testimonials (1).png" style="width: 80px; height: 80px;" alt="">
                        <div class="ml-3">
                            <h5>Eloisa</h5>
                            <i>Customer</i>
                        </div>
                    </div>
                    <p class="m-0">
                        Even before our first visit, Kruhay was already very responsive to my inquiries via Messenger. 
                        It showed that they have genuine concern for the animals regardless of pay. 
                        Charlie and I finally went for a check-up today, and he had his best vet experience with Doc Gette and the rest of the staff. 
                        Glad to have found a reliable vet for my furbaby!
                    </p>
                </div>
                <div class="bg-white mx-3 p-4">
                    <div class="d-flex align-items-end mb-3 mt-n4 ml-n4">
                        <img class="img-fluid" src="<?php echo base_url(); ?>static/images/testimonials/testimonials (2).png" style="width: 80px; height: 80px;" alt="">
                        <div class="ml-3">
                            <h5>Clarence</h5>
                            <i>Customer</i>
                        </div>
                    </div>
                    <p class="m-0">
                        Doc Rogette is a superbly competent Vet with compassion not just for his animal patient but also for the owners as well. 
                        We have a lot of dogs (all Aspins) and we entrust them all to his care. We are very appreciative.
                    </p>
                </div>
                <div class="bg-white mx-3 p-4">
                    <div class="d-flex align-items-end mb-3 mt-n4 ml-n4">
                        <img class="img-fluid" src="<?php echo base_url(); ?>static/images/testimonials/testimonials (3).png" style="width: 80px; height: 80px;" alt="">
                        <div class="ml-3">
                            <h5>Vianice</h5>
                            <i>Customer</i>
                        </div>
                    </div>
                    <p class="m-0">Very hands on and friendly doctor and staff.</p>
                </div>
                <div class="bg-white mx-3 p-4">
                    <div class="d-flex align-items-end mb-3 mt-n4 ml-n4">
                        <img class="img-fluid" src="<?php echo base_url(); ?>static/images/testimonials/testimonials (4).png" style="width: 80px; height: 80px;" alt="">
                        <div class="ml-3">
                            <h5>Brends</h5>
                            <i>Veterinarian</i>
                        </div>
                    </div>
                    <p class="m-0">
                        Doc. Rogette takes very good care of Bucky. He patiently answers all of our questions about our puppy. 
                        He and his staff handle Bucky with so much care and gentleness which makes Bucky comfortable during his appointments. 
                        He is also responsive to our chats and messages. We are very thankful that we found this clinic. Kudos to Kruhay team
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

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
    <script src="<?php echo base_url(); ?>static/js/client_registration.js"></script>
</body>
</html>