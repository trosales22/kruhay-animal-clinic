<?php
	$sessionData = $this->session->userdata('client_session');
    $userId = null;
    $fullName = null;
    $email = null;

    if($sessionData){
        $userId =  $sessionData['user_id'];
        $fullName = $sessionData['first_name'] . ' ' . $sessionData['last_name'];
        $email = $sessionData['email'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kruhay Animal Clinic - Bookings</title>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.3/dist/css/datepicker.min.css">
</head>

<body>
    <?php include 'pages/landing/topbar.php';?>
    <?php include 'pages/landing/navbar.php';?>

    <br />

    <!-- Booking Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="bg-primary py-5 px-4 px-sm-5">
                        <form id="frmReserveBooking" class="py-2" type="POST" action="<?php echo base_url(). 'api/reservation/reserve_booking'; ?>">
                            <input type="text" id="txtReservationUserId" value="<?php echo $userId; ?>" style="display: none;"/>
                            <input type="text" id="txtReservationName" value="<?php echo $fullName; ?>" style="display: none;"/>
                            <input type="text" id="txtReservationEmail" value="<?php echo $email; ?>" style="display: none;"/>
                        
                            <div class="form-group">
                                <input type="text" name="pet_name" required class="form-control border-0 p-4" placeholder="Pet Name" />
                            </div>

                            <div class="form-group">
                                <input type="text" name="schedule_date" id="schedule_date" required class="form-control border-0 p-4 datetimepicker-input" placeholder="Reservation Date" autocomplete="off"/>
                            </div>

                            <div class="form-group">
                                <select class="custom-select border-0 px-4" style="height: 47px;" name="schedule_time" required>
                                    <option selected disabled>Select Schedule Time</option>
                                    <option value="9am-10am">9am-10am</option>
                                    <option value="10am-11am">10am-11am</option>
                                    <option value="11am-12pm">11am-12pm</option>
                                    <option value="12pm-1pm">12pm-1pm</option>
                                    <option value="1pm-2pm">1pm-2pm</option>
                                    <option value="2pm-3pm">2pm-3pm</option>
                                    <option value="3pm-4pm">3pm-4pm</option>
                                    <option value="4pm-5pm">4pm-5pm</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" name="address" required class="form-control border-0 p-4" placeholder="Address (for Home Service)" />
                            </div>
                            <div class="form-group">
                                <select class="custom-select border-0 px-4" style="height: 47px;" name="service_type" required>
                                    <option selected disabled>Select A Service</option>
                                    <option value="Home Service (Pet Vaccination)">Home Service (Pet Vaccination)</option>
                                    <option value="Home Service (Pet Deworming)">Home Service (Pet Deworming)</option>
                                    <option value="Pet Grooming">Pet Grooming</option>
                                    <option value="Pet Boarding">Pet Boarding</option>
                                </select>
                            </div>

                            <?php
                            if($sessionData){
                            ?>
                            <div>
                                <button id="submitBtn" class="btn btn-success btn-block border-0 py-3">Book Now</button>
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
                <div class="col-lg-7 py-5 py-lg-0 px-3 px-lg-5">
                    <h4 class="text-secondary mb-3">Going for a vacation?</h4>
                    <h1 class="display-4 mb-4">Book For <span class="text-primary">Your Pet</span></h1>
                    <div class="row py-2">
                        <div class="col-sm-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <h1 class="flaticon-house font-weight-normal text-secondary m-0 mr-3"></h1>
                                    <h5 class="text-truncate m-0">Pet Boarding</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <h1 class="flaticon-vaccine font-weight-normal text-secondary m-0 mr-3"></h1>
                                    <h5 class="m-0">Pet Vaccination</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <h1 class="flaticon-grooming font-weight-normal text-secondary m-0 mr-3"></h1>
                                    <h5 class="text-truncate m-0">Pet Grooming</h5>
                                </div>
                            </div>
                        </div>  
                        <div class="col-sm-6">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <h1 class="flaticon-vaccine font-weight-normal text-secondary m-0 mr-3"></h1>
                                    <h5 class="m-0">Pet Deworming</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking Start -->

    <!-- Services Start -->
    <div class="container-fluid bg-light pt-5">
        <div class="container center">
            <div class="d-flex flex-column text-center mb-5">
                <h4 class="text-primary mb-3">Our Services</h4>
                <h1 class="display-4 m-0"><span class="text-secondary">Premium</span> <span class="text-primary">Pet</span> Services</h1>
            </div>
            <div class="row pb-4">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-house display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Pet Boarding</h3>
                        <p>It's taking your dog or cat to a facility away from home for an overnight stay or longer.</</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-vaccine display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h4 class="mb-3">Pet Vaccination</h4>
                        <p>Core vaccines are considered vital to all pets based on risk of exposure, severity of disease or transmissibility to humans.</</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-grooming display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3">Pet Grooming</h3>
                        <p>With proper pet grooming, you will get rid of shedding, fleas, ticks, and various health conditions.</</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-vaccine display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h4 class="mb-3">Pet Deworming</h4>
                        <p>Deworming is an important preventative care regime for reducing parasites (internal and external) and improving your pet's health.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

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
    <script src="https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.3/dist/js/datepicker-full.min.js"></script>
    <script src="<?php echo base_url(); ?>static/js/client_booking.js"></script>
    <script src="<?php echo base_url(); ?>static/js/client_logout.js"></script>
</body>
</html>