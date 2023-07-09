<div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form id="frmEditService" method="POST" action="<?php echo base_url(). 'api/services/update_service'; ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <input type="hidden" name="service_id">

          <div class="modal-body">
            <div class="row form-group">
              <div class="col-sm-6">
                <label for="frmEditServiceTxtServiceName">Name</label>
                <input type="text" class="form-control" id="frmEditServiceTxtServiceName" name="name" placeholder="Enter name.." required>
              </div>

              <div class="col-sm-6">
                <label for="frmEditServiceTxtServiceAmount">Amount</label>
                <input type="text" class="form-control" id="frmEditServiceTxtServiceAmount" name="amount" placeholder="Enter amount..">
              </div>
            </div>
			
            <div class="row form-group">
              <div class="col-sm-6">
                <label for="frmEditServiceTxtServiceShortDesc">Short Description</label>
                <textarea class="form-control" rows="2" id="frmEditServiceTxtServiceShortDesc" name="short_desc" placeholder="Write short description.." style="resize: none;" spellcheck="false"></textarea>
              </div>

              <div class="col-sm-6">
                <label for="frmEditServiceImgDisplayPhoto">Display Photo</label>
                <input type="file" id="frmEditServiceImgDisplayPhoto" name="service_img" accept="image/png, image/jpeg, image/jpg" />
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
