<?php
	$sessionData = $this->session->userdata('client_session');

    if($sessionData){
        $sessionFullname = $sessionData['first_name'] . ' ' . $sessionData['last_name'];
    }
?>
<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
        <a href="" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-secondary">Kruhay</span> <span class="text-primary">Animal</span> <span class="text-secondary">Clinic</span></h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="<?php echo base_url(); ?>" class="nav-item nav-link">Home</a>
                <a href="<?php echo base_url(); ?>about" class="nav-item nav-link">About</a>
                <a href="<?php echo base_url(); ?>products" class="nav-item nav-link">Products</a>
                <a href="<?php echo base_url(); ?>services" class="nav-item nav-link">Services</a>
                <a href="<?php echo base_url(); ?>bookings" class="nav-item nav-link">Booking</a>
                <a href="<?php echo base_url(); ?>contact" class="nav-item nav-link">Contact Us</a>
                <?php
                if($sessionData){
                ?>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $sessionFullname; ?></a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="<?php echo base_url(); ?>reservation" class="dropdown-item">Reservation List</a>
                        <form method="POST" id="frmLogoutClient" action="<?php echo base_url(). 'client_login/logout'; ?>">
                            <button type="submit" class="dropdown-item" style="cursor: pointer;">Logout</button>
                        </form>
                    </div>
                </div>
                <?php }else{?>
                <a href="<?php echo base_url(); ?>client_registration" class="nav-item nav-link">Registration</a>
                <a href="<?php echo base_url(); ?>client_login" class="nav-item nav-link">Login</a>
                <?php }?>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->