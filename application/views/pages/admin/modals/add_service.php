<div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form id="frmAddService" method="POST" action="<?php echo base_url(). 'api/services/add_service'; ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="row form-group">
				<div class="col-sm-6">
					<label for="inputServiceName">Name</label>
					<input type="text" class="form-control" id="inputServiceName" name="name" placeholder="Enter name.." required>
				</div>

				<div class="col-sm-6">
					<label for="inputServiceAmount">Amount</label>
					<input type="text" class="form-control" id="inputServiceAmount" name="amount" placeholder="Enter amount..">
				</div>
			</div>
			
			<div class="row form-group">
				<div class="col-sm-12">
					<label for="inputServiceShortDesc">Short Description</label>
					<textarea class="form-control" rows="2" id="inputServiceShortDesc" name="short_desc" placeholder="Write short description.." style="resize: none;" spellcheck="false"></textarea>
				</div>
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
