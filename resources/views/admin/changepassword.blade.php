<x-adminl>
	<div class="row page-title-header">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
			  <div class="card-body">
			  <div class="row">
					<div class="col-sm-6">
						<h4 class="card-title">Change Password  </h4>
					</div>
					<div class="col-sm-6 pull-end">
						
					</div>
				</div>
				<hr/>
				<?php if(@$error_msg!=''){ ?>
					<p class="alert alert-danger"><?php echo $error_msg; ?></p>
				<?php } ?>
				<?php if(@$success_msg!=''){ ?>
					<p class="alert alert-success"><?php echo $success_msg; ?></p>
				<?php } ?>
				
					<form class="" method="POST" action="" id="changepassword-form">
@csrf
  <div class="row mb-3">
	<div class="col-md-12">
		<label for="old_password" class="form-label">Old Password</label>
		<input type="password" placeholder="Enter Old Password" class="form-control" name="old_password" id="old_password">
	</div>
  </div>
  <div class="row mb-3">
	  <div class="col-md-6">
		<label for="new_password" class="form-label">New Password</label>
		<input type="password" placeholder="New Password" class="form-control" name="new_password" id="new_password">
	  </div>
	  <div class="col-md-6">
		<label for="confirm_password" class="form-label">Old Password</label>
		<input type="password" class="form-control" placeholder="Conform Password" name="confirm_password" id="confirm_password">
	  </div>
  </div>
  <div class="row mb-3">
  <div class="col-12 text-center">
  <p>&nbsp;</p>
    <button type="submit" class="btn btn-info btn-lg">Change Password</button>
 
  </div>
  </div>
  
  
</form>

			  </div>
			</div>
		  </div>	
	</div>
	
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	
  <script>
	$(document).ready(function() {
	   $("#changepassword-form").validate({
		  rules: {
			 old_password: 'required',
			 new_password: 'required',
			 confirm_password: {
				 required: true,
				 equalTo: "#new_password"
			 }
		  },
		  messages: {
			   old_password: 'Enter old password ',
			   new_password: 'New password required',
			   confirm_password: {
				   equalTo:'Password and confirm password not match ',
				   required:'Required Confirm password '
			   }
			   
			}
		  
	   });
	});
</script>

</x-adminl>
