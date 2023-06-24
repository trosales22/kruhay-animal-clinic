<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form id="frmEditProduct" method="POST" action="<?php echo base_url(). 'api/products/update_product'; ?>" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <input type="hidden" name="product_id">

          <div class="modal-body">
            <div class="row form-group">
				<div class="col-sm-6">
					<label for="frmEditProductTxtProductName">Name</label>
					<input type="text" class="form-control" id="frmEditProductTxtProductName" name="name" placeholder="Enter product name.." required>
				</div>

				<div class="col-sm-6">
					<label for="frmEditProductImgProductDisplayPhoto">Display Photo</label>
					<input type="file" id="frmEditProductImgProductDisplayPhoto" name="product_img" accept="image/png, image/jpeg" />
				</div>
			</div>
			
			<div class="row form-group">
				<div class="col-sm-12">
					<label for="frmEditProductTxtProductShortDesc">Short Description</label>
					<textarea class="form-control" rows="2" id="frmEditProductTxtProductShortDesc" name="short_desc" placeholder="Write short description.." style="resize: none;"></textarea>
				</div>
			</div>

			<div class="row form-group">
				<div class="col-sm-12">
					<label for="frmEditProductTxtProductLongDesc">Long Description</label>
					<textarea class="form-control" rows="5" id="frmEditProductTxtProductLongDesc" name="long_desc" placeholder="Write long description.." style="resize: none;"></textarea>
				</div>
			</div>

			<div class="row form-group">
				<div class="col-sm-4">
					<label for="frmEditProductTxtProductAmount">Amount</label>
					<input type="text" class="form-control" id="frmEditProductTxtProductAmount" name="amount" placeholder="Enter amount..">
				</div>

				<div class="col-sm-4">
					<label for="frmEditProductTxtProductQuantity">Quantity</label>
					<input type="number" class="form-control" id="frmEditProductTxtProductQuantity" name="quantity" placeholder="Enter quantity..">
				</div>

				<div class="col-sm-4">
					<label for="frmEditProductTxtProductExpirationDate">Expiration Date</label>
					<input type="date" class="form-control" id="frmEditProductTxtProductExpirationDate" name="expiration_date" placeholder="Enter expiration date.." required>
				</div>
			</div>

			<div class="alert alert-info">
				<strong>Reminder!</strong>
				<br />Maximum width: <b>5000px</b> | Maximum height: <b>5000px</b> | Maximum file size: <b>5MB</b>
			</div>
          </div>
          
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
</div>
