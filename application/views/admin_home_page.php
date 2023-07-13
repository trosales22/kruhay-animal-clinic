<?php
	$session_data = $this->session->userdata('admin_session');
	$session_username = $session_data['username'];

	if (!$session_data) {
		redirect(base_url('admin_login'));
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>static/images/logo.ico"/>
  <meta name="description" content="Kruhay Animal Clinic">
  
  <title>Kruhay Animal Clinic - Admin Home</title>

  <!-- Custom fonts for this template -->
  <link href="<?php echo base_url(); ?>static/SBAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?php echo base_url(); ?>static/SBAdmin/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>static/SBAdmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.css">
	<link href="<?php echo base_url(); ?>static/css/parsley.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>static/js/libraries/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>static/css/sweetalert2.min.css" rel="stylesheet">
  <style>
  div.gallery {
    margin: 5px;
    border: 1px solid #ccc;
    float: left;
    width: 180px;
  }

  div.gallery:hover {
    border: 1px solid #777;
  }

  div.gallery img {
    width: 100%;
    height: 200px;
  }

  div.desc {
    padding: 15px;
    text-align: center;
  }

  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
  }

  /* Style the buttons that are used to open the tab content */
  .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
  }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

		<?php include 'pages/admin/sidebar.php';?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

				<?php include 'pages/admin/topbar.php';?>

        <!-- Tab links -->
        <div class="tab">
          <button class="tablinks active" onclick="openTab(event, 'Reservations')">Reservations</button>
          <button class="tablinks" onclick="openTab(event, 'Products')">Products</button>
          <button class="tablinks" onclick="openTab(event, 'Services')">Services</button>
          <button class="tablinks" onclick="openTab(event, 'PurchasedProducts')">Purchased Products</button>
        </div>

        <!-- Tab content -->
        <div id="Reservations" class="tabcontent" style="display: block;">
          <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Reservations</h1>

            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="tbl_reservations" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Client Details</th>
                        <th>Schedule Date & Time</th>
                        <th>Service Type</th>
                        <th>Pet Name</th>
                        <th>Address (if Home Service)</th>
                        <th>Status</th>
                        <th>Date Created</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php foreach($reservations as $reservation){?>
                        <tr>
                          <td>
                            <b>Name:</b> <?php echo $reservation->client_name;?><br/>
                            <b>Contact #:</b> <?php echo $reservation->client_contact_number;?><br/>
                            <b>Email:</b> <?php echo $reservation->client_email;?><br/>
                          </td>
                          <td><?php echo $reservation->schedule_date . ' (' . $reservation->schedule_time . ')'; ?></td>
                          <td><?php echo $reservation->service_type;?></td>
                          <td><?php echo $reservation->pet_name;?></td>
                          <td><?php echo $reservation->address;?></td>
                          <td><?php echo $reservation->status;?></td>
                          <td><?php echo $reservation->created_at;?></td>
                        </tr> 
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="Products" class="tabcontent">
          <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Products</h1>
            
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <a class="btnAddProduct btn btn-success btn-icon-split" href="#" data-toggle="modal" data-target="#addProductModal">
                  <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                  </span>
                  <span class="text">Add Product</span>
                </a>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="tbl_products" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Display Photo</th>
                        <th>Name</th>
                        <th>Short Description</th>
                        <th>Amount</th>
                        <th>Quantity</th>
                        <th>Expiration Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php foreach($products as $product){?>
                        <tr>
                          <td style="text-align: center;">
                            <?php 
                              if(empty($product->file_name) || is_null($product->file_name)){
                                echo '<div class="alert alert-danger">
                                        <span class="icon text-red-50" style="margin-right: auto;">
                                          <i class="fas fa-exclamation-triangle"></i>
                                        </span> <b>NO IMAGE AVAILABLE!</b>
                                      </div>';
                              }else{
                                echo "<img src='" . $product->file_name . "' style='width: 150px; height: 150px;' />";
                              }
                            ?>
                          </td>
                          <td><?php echo $product->name;?></td>
                          <td><?php echo $product->short_desc;?></td>
                          <td>&#8369;<?php echo $product->amount;?></td>
                          <td><?php echo $product->quantity;?></td>
                          <td><?php echo $product->expiration_date;?></td>
                          <td>
                            <a href="#" data-toggle="modal" data-id="<?php echo $product->id;?>" data-target="#editProductModal" class="btnEditProduct btn btn-success btn-icon-split">
                              <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                              </span>
                              <span class="text">Edit</span>
                            </a>

                            <a href="#" data-toggle="modal" data-id="<?php echo $product->id;?>" data-target="#deleteProductModal" class="btnDeleteProduct btn btn-danger btn-icon-split">
                              <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                              </span>
                              <span class="text">Delete</span>
                            </a>
                          </td>
                        </tr> 
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="Services" class="tabcontent">
          <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Services</h1>
            
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <a class="btnAddService btn btn-success btn-icon-split" href="#" data-toggle="modal" data-target="#addServiceModal">
                  <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                  </span>
                  <span class="text">Add Service</span>
                </a>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="tbl_services" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Display Photo</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php foreach($services as $service){?>
                        <tr>
                          <td style="text-align: center;">
                            <?php 
                              if(empty($service->file_name) || is_null($service->file_name)){
                                echo '<div class="alert alert-danger">
                                        <span class="icon text-red-50" style="margin-right: auto;">
                                          <i class="fas fa-exclamation-triangle"></i>
                                        </span> <b>NO IMAGE AVAILABLE!</b>
                                      </div>';
                              }else{
                                echo "<img src='" . $service->file_name . "' style='width: 150px; height: 150px;' />";
                              }
                            ?>
                          </td>
                          <td><?php echo $service->name;?></td>
                          <td><?php echo $service->short_desc;?></td>
                          <td>&#8369;<?php echo $service->amount;?></td>
                          <td>
                            <a href="#" data-toggle="modal" data-id="<?php echo $service->id;?>" data-target="#editServiceModal" class="btnEditService btn btn-success btn-icon-split">
                              <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                              </span>
                              <span class="text">Edit</span>
                            </a>

                            <a href="#" data-toggle="modal" data-id="<?php echo $service->id;?>" data-target="#deleteServiceModal" class="btnDeleteService btn btn-danger btn-icon-split">
                              <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                              </span>
                              <span class="text">Delete</span>
                            </a>
                          </td>
                        </tr> 
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="PurchasedProducts" class="tabcontent">
          <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Purchased Products</h1>
            
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="tbl_purchased_products" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Purchased By</th>
                        <th>Date Purchased</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php foreach($purchased_products as $purchased_product){?>
                        <tr>
                          <td><?php echo $purchased_product->product_name;?> <b>(&#8369;<?php echo $purchased_product->product_amount;?>)</b></td>
                          <td><?php echo $purchased_product->status;?></td>
                          <td>
                            <b>Name: </b><?php echo $purchased_product->customer_name;?><br />
                            <b>Contact #: </b><?php echo $purchased_product->customer_contact_no;?><br />
                            <b>Email: </b><?php echo $purchased_product->customer_email;?>
                          </td>
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
      <!-- End of Main Content -->

      <?php include 'pages/admin/footer.php';?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php include 'pages/admin/modals/logout.php';?>
  <?php include 'pages/admin/modals/add_product.php';?>
  <?php include 'pages/admin/modals/edit_product.php';?>
  <?php include 'pages/admin/modals/add_service.php';?>
  <?php include 'pages/admin/modals/edit_service.php';?>
	
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>static/SBAdmin/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>static/SBAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>static/SBAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>static/SBAdmin/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url(); ?>static/SBAdmin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>static/SBAdmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
	<script src="<?php echo base_url(); ?>static/SBAdmin/js/demo/datatables-demo.js"></script>
	<script src="https://parsleyjs.org/dist/parsley.min.js"></script>
	<script src="<?php echo base_url(); ?>static/js/libraries/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script src="<?php echo base_url(); ?>static/js/admin_home.js"></script>
</body>

</html>
