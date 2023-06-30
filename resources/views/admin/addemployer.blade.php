<x-adminl>
	<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
	<div class="row page-title-header">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
			  <div class="card-body">
			  <div class="row">
					<div class="col-sm-6">
						<h4 class="card-title">Add/Update Company </h4>
					</div>
					<div class="col-sm-6 pull-end">
						<a class="pull-end text-end btn btn-info" style="float:right;" href="/admin/employers">Back To List</a>
					</div>
				</div>
				<hr/>
				<?php if(@$error_msg!=''){ ?>
					<p class="alert alert-danger"><?php echo $error_msg; ?></p>
				<?php } ?>
				<?php if(@$success_msg!=''){ ?>
					<p class="alert alert-success"><?php echo $success_msg; ?></p>
				<?php } ?>
				
					<form class="forms-sample" method="post" id="add_jobsform" enctype="multipart/form-data">
					   @csrf
						<div class="row mb-3">
							<div class="col-md-4">
								<label for="name" class="form-label">Name</label>
								<input type="text" value="<?php echo @$formdata->name; ?>" placeholder="Name" name="name" class="form-control">
							</div>
							
						  <div class="col-md-4">
								<label for="name" class="form-label">Password (leave blank if not update)</label>
								<input type="password" value="" placeholder="Password" name="password" class="form-control">
							</div>
							<div class="col-md-4">
								<label for="name" class="form-label">Email</label>
								<input type="text" value="<?php echo @$formdata->email; ?>" placeholder="Email" name="email" class="form-control">
							</div>
						</div>
						<div class="row mb-12">
							<div class="col-md-6">
								<label for="name" class="form-label">Address </label>
								<input type="text" value="<?php echo @$formdata->address1; ?>" placeholder="Address" name="address1" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="name" class="form-label">Address 1</label>
								<input type="text" value="<?php echo @$formdata->address2; ?>" placeholder="Address 1" name="address2" class="form-control">
							</div>
						</div>
						<div class="row mb-12">
							<div class="col-md-6">
								<label for="name" class="form-label">City</label>
								<input type="text" value="<?php echo @$formdata->city; ?>" placeholder="City" name="city" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="name" class="form-label">State</label>
								<input type="text" value="<?php echo @$formdata->state; ?>" placeholder="State" name="state" class="form-control">
							</div>
						</div>
						<div class="row mb-12">
							<div class="col-md-6">
								<label for="name" class="form-label">Postal Code </label>
								<input type="text" value="<?php echo @$formdata->postal_code; ?>" placeholder="Postal Code " name="postal_code" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="name" class="form-label">Country</label>
								<input type="text" value="<?php echo @$formdata->country; ?>" placeholder="country" name="country" class="form-control">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12">
								<label for="address2" class="form-label">Status </label><br/>
								<label><input <?php if(@$formdata->status == 1){ ?>checked="checked"<?php } ?> type="checkbox" value="1" name="status"> Active</label>
							  </div>
							 
						</div>
					  <div class="row mb-3">
					  <div class="col-12 text-center">
						<p>&nbsp;</p>
						<button type="submit" class="btn btn-info btn-lg"><?php if(@$id!==''){ echo 'Update'; }else{ echo 'Add';} ?> Company </button>
					 
					  </div>
					  </div>
					</form>
					
			  </div>
			</div>
		  </div>	
	</div>
	
	
<script>
 
	
	$(document).ready(function() {
	   $("#add_jobsform").validate({
		  rules: {
			 name: 'required',
			 email: {
				 required: true,
				 email: true
			 },
			 address1: 'required',
			 address2: 'required',
			 state: 'required',
			 city: 'required',
			 postal_code: 'required',
			 country: 'required'
		  },
		  messages: {
				name: 'Name required',
				 email: {
					required:'Email required',
					email:'Valid email required'
				 },
				 address1: 'Address required',
				 address2: 'Address 1 required',
				 state: 'State required',
				 city: 'City required',
				 postal_code: 'Postal code required',
				 country: 'Country required'
			}
		  
	   });
	});
</script>

</x-adminl>
