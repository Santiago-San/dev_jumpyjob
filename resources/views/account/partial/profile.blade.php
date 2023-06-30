<form class="/profile" method="post" id="profile_form" >
   @csrf
	<div class="row mb-3">
		<div class="col-md-6">
		<label for="name" class="form-label">Name</label>
		<input type="text" value="<?php echo @$userdata->name; ?>" placeholder="Name" name="name" class="form-control">
	  </div>
	  <div class="col-md-6">
		<label for="email" class="form-label">Email</label>
		<input type="email" name="email" placeholder="Email" readonly="" value="<?php echo @$userdata->email; ?>" class="form-control">
	  </div>
	</div>
	<div class="row mb-3">
	  <div class="col-12">
		<label for="address1" class="form-label">Address</label>
		<input type="text" class="form-control" name="address1" value="<?php echo @$userdata->address1; ?>" placeholder="Address 1">
	  </div>
	</div>
	<div class="row mb-3">
	  <div class="col-12">
		<label for="address2" class="form-label">Address 2</label>
		<input type="text" class="form-control" name="address2" id="address2" value="<?php echo @$userdata->address2; ?>" placeholder="Address 2">
	  </div>
	</div>
	<div class="row mb-3">
  <div class="col-md-6">
    <label for="city" class="form-label">City</label>
    <input type="text" class="form-control" id="city" name="city" value="<?php echo @$userdata->city; ?>">
  </div>
  <div class="col-md-4">
    <label for="state" class="form-label">State</label>
    <input type="text" class="form-control" id="state" name="state" value="<?php echo @$userdata->state; ?>">
  </div>
  <div class="col-md-2">
    <label for="postal_code" class="form-label">Zip</label>
    <input type="text" class="form-control" name="postal_code" id="postal_code" value="<?php echo @$userdata->postal_code; ?>">
  </div>
  </div>
  <div class="row mb-3">
  <div class="col-12 text-center">
  <p>&nbsp;</p>
    <button type="submit" class="btn btn-info btn-lg">Update Profile</button>
 
  </div>
  </div>
</form>
<script>
	$(document).ready(function() {
	   $("#profile_form").validate({
		  rules: {
			 name: 'required',
			 address1: 'required',
			 address2: 'required',
			 city: 'required',
			 state: 'required',
			 postal_code: 'required'
			 
		  },
		  messages: {
			   name: 'Please fill your name ',
			   address1: 'Fill address line 1',
			   address2: 'Fill address line 2',
			   city: 'Fill your city ',
			   state: 'Fill your state',
			   postal_code: 'Fill postal code '
			}
		  
	   });
	});
</script>