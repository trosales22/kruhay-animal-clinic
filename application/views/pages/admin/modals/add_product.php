<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form id="frmAddProduct" method="POST" action="<?php echo base_url(). 'api/products/add_product'; ?>" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="row form-group">
				<div class="col-sm-6">
					<label for="inputProductName">Name</label>
					<input type="text" class="form-control" id="inputProductName" name="name" placeholder="Enter product name.." required>
				</div>

				<div class="col-sm-6">
					<label for="imgProductDisplayPhoto">Display Photo</label>
					<input type="file" id="imgProductDisplayPhoto" name="product_img" accept="image/png, image/jpeg" />
				</div>
			</div>
			
			<div class="row form-group">
				<div class="col-sm-12">
					<label for="inputProductShortDesc">Short Description</label>
					<textarea class="form-control" rows="2" id="inputProductShortDesc" name="short_desc" placeholder="Write short description.." style="resize: none;"></textarea>
				</div>
			</div>

			<div class="row form-group">
				<div class="col-sm-12">
					<label for="inputProductLongDesc">Long Description</label>
					<textarea class="form-control" rows="5" id="inputProductLongDesc" name="long_desc" placeholder="Write long description.." style="resize: none;"></textarea>
				</div>
			</div>

			<div class="row form-group">
				<div class="col-sm-6">
					<label for="inputProductAmount">Amount</label>
					<input type="text" class="form-control" id="inputProductAmount" name="amount" placeholder="Enter amount..">
				</div>

				<div class="col-sm-6">
					<label for="inputProductQuantity">Quantity</label>
					<input type="number" class="form-control" id="inputProductQuantity" name="quantity" placeholder="Enter quantity..">
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
