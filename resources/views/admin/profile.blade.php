<x-adminl>
	<div class="row page-title-header">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
			  <div class="card-body">
			  <div class="row">
					<div class="col-sm-6">
						<h4 class="card-title">Update Profile </h4>
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
				
					<form style="width:80%;margin-left:10%;" class="forms-sample" method="post" id="add_jobsform" enctype="multipart/form-data">
					   @csrf
					   <div class="row mb-3">
							<div class="col-md-12">
								<label for="name" class="form-label">Email</label>
								<input type="email" readonly="readonly" value="<?php echo @$formdata->email; ?>" placeholder="Email" name="email" class="form-control">
							</div>
					   </div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label for="name" class="form-label">Name</label>
								<input type="text" value="<?php echo @$formdata->name; ?>" placeholder="name" name="name" class="form-control">
							</div>
							
						  
						</div>
						
					
						
						
						
						
						
					
					  <div class="row mb-3">
					  <div class="col-12 text-center">
						<p>&nbsp;</p>
						<button type="submit" class="btn btn-info btn-lg">Update Profile</button>
					 
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
	   $("#add_jobsform").validate({
		  rules: {
			 name: 'required'
			
			      
		  },
		  messages: {
				name: 'Name required'
				
			}
		  
	   });
	});
</script>

</x-adminl>
