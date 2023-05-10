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
<div class="modal fade" id="buyProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="frmBuyProduct" class="py-2" type="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buy <strong><span class="checkout_product_name"></span></strong></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <input type="text" name="checkout_user_id" value="<?php echo $userId; ?>" style="display: none;"/>
                <input type="text" name="checkout_fullname" value="<?php echo $fullName; ?>" style="display: none;"/>
                <input type="text" name="checkout_email" value="<?php echo $email; ?>" style="display: none;"/>

                <input type="text" name="checkout_product_id" style="display: none;">
                <input type="text" name="checkout_product_amount" style="display: none;">

                <div class="modal-body">
                    <img class="img-responsive checkout_product_image" style='width: 150px; height: 150px; margin-left: auto; margin-right: auto; display: block;' />

                    <h5>
                        <strong>Name:</strong> <span class="checkout_product_name"></span> <br/>
                        <strong>Short Description:</strong> <span class="checkout_product_short_desc"></span> <br/>
                        <strong>Long Description:</strong> <span class="checkout_product_long_desc"></span> <br/>
                        <strong>Amount:</strong> &#8369;<span class="checkout_product_amount"></span> <br/>
                        <strong>Qty:</strong> <span class="checkout_product_quantity"></span> <br/>
                    </h5>

                    <?php
                        if($sessionData){
                        ?>
                        <div id="paymentElement">
                            <!--Stripe.js injects the Payment Element-->
                        </div><br/>
                        
                        <div>
                            <button id="submitBtn" class="btn btn-success btn-block border-0 py-3">Proceed</button>
                        </div>
                        <?php }else{?>
                        <div class="alert alert-danger">
                            <span class="icon text-red-50" style="margin-right: auto;">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span> <b>Login to proceed.</b>
                        </div>
                    <?php }?>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </form>

            <!-- Display processing notification -->
            <div id="frmProcess" class="hidden">
                <span class="ring"></span> Processing...
            </div>
        </div>
    </div>
</div>