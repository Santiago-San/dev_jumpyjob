<x-navbar>
	<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="<?php echo public_path('css/userdashboard.css'); ?>">
	<style>
		{{ include public_path('css/userdashboard.css') }}
	</style>
<div class="container">
    <div class="row profile">
		<div class="col-sm-3">
			@include('account/partial/leftnav') 
		</div>
		<div class="col-sm-9">
            <div class="profile-content">
				<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
					
					<h2 class="page-top-heading">Add/Update Jobs</h2>
					
				</div>
				<div class="tab-content p-3 border bg-light" id="nav-tabContent">
					<div id="ajax_response"></div>
					<?php if($error_msg!=''){ ?><p class="text text-danger">{{$error_msg}}</p><?php } ?>
					<?php if($success_msg!=''){ ?><p class="text text-success">{{$success_msg}}</p><?php } ?>
					<form class="/jobs/add/" method="post" id="add_jobsform" enctype="multipart/form-data">
					   @csrf
						<div class="row mb-3">
							<div class="col-md-6">
								<label for="name" class="form-label">Job Title</label>
								<input type="text" value="<?php echo @$formdata->title; ?>" placeholder="Job Title" name="title" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="name" class="form-label">Job Slug</label>
								<input type="text" value="<?php echo @$formdata->slug; ?>" placeholder="Job Slug" name="slug" class="form-control">
							</div>
						  
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label for="name" class="form-label">Job Category</label>
								<select class="form-control" name="cat_id" onchange="getSubCategory(this.value)">
									<option value="">Select Job Category</option>
									<?php if($parentCat){
										foreach($parentCat as $pk=>$pv){
											?>
											<option <?php if(@$formdata->cat_id == $pv->id){ ?>selected="selected"<?php } ?> value="<?php echo $pv->id; ?>"><?php echo $pv->name; ?></option>
											<?php 
										}
									} ?>
								</select>
								
							</div>
							<div class="col-md-6">
								<label for="name" class="form-label">Job Sub Category</label>
								<select class="form-control" name="sub_cat_id" id="sub_cat_id">
									<option value="">Select Job Sub Category</option>
									
								</select>
								
							</div>
						  
						</div>
						<div class="row mb-3">
							<div class="col-md-4">
								<label for="name" class="form-label">Package/Years</label>
								<input type="text" value="<?php echo @$formdata->package_anum; ?>" class="form-control" name="package_anum">
							</div>
							<div class="col-md-4">
								<label for="name" class="form-label">Gender </label>
								<select class="form-control" name="gender">
									<option value="">Select Gender</option>
									<option <?php if(@$formdata->gender=='male'){ ?>selected="selected"<?php } ?> value="male">Male</option>
									<option <?php if(@$formdata->gender=='female'){ ?>selected="selected"<?php } ?> value="female">Female</option>
									<option <?php if(@$formdata->gender=='both'){ ?>selected="selected"<?php } ?> value="both">Both</option>
									<option <?php if(@$formdata->gender=='any'){ ?>selected="selected"<?php } ?> value="any">Any</option>
								</select>
							</div>
							<div class="col-md-4">
								<label for="name" class="form-label">Number Of Vecancy</label>
								<input type="text" placeholder="vacancy" value="<?php echo @$formdata->vacancy ; ?>" class="form-control" name="vacancy">
							</div>							
							
						</div>
						<div class="row mb-3">
							<div class="col-md-4">
								<label for="name" class="form-label">Job Type</label>
								<select class="form-control" name="job_type">
									<option value="">Select Job Type</option>
									<option <?php if(@$formdata->job_type == 'part-time'){ ?>selected="selected"<?php } ?> value="part-time">Part Time</option>
									<option <?php if(@$formdata->job_type == 'full-time'){ ?>selected="selected"<?php } ?> value="full-time">Full Time</option>
								</select>
							</div>
							<div class="col-md-4">
								<label for="name" class="form-label">Job Latitute </label>
								<input type="text" value="<?php echo @$formdata->job_lat; ?>" placeholder="Job Latitute" name="job_lat" class="form-control">
							</div>
							<div class="col-md-4">
								<label for="name" class="form-label">Job Logitute </label>
								<input type="text" value="<?php echo @$formdata->job_long; ?>" placeholder="Job Longitute" name="job_long" class="form-control">
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-12">
								<label for="name" class="form-label">Job Address</label>
								<textarea class="form-control" placeholder="Job Address" name="job_address"><?php echo @$formdata->job_address; ?></textarea>
							</div>
						</div>
						<div class="row mb-3">
						  <div class="col-md-4">
							<label for="city" class="form-label">Job City</label>
							<input type="text" class="form-control" placeholder="Job City" id="city" name="city" value="<?php echo @$formdata->city; ?>">
						  </div>
						  <div class="col-md-4">
							<label for="state" class="form-label">Job State</label>
							<input type="text" class="form-control" id="state" placeholder="Job State" name="state" value="<?php echo @$formdata->state; ?>">
						  </div>
						  <div class="col-md-4">
							<label for="postal_code" class="form-label">Postal Code </label>
							<input type="text" class="form-control" placeholder="Job " name="postal_code" id="postal_code" value="<?php echo @$formdata->postal_code; ?>">
						  </div>
						  </div>
						<div class="row mb-3">
						  <div class="col-6">
							<label for="address1" class="form-label">Job Skills</label>
							<textarea class="form-control" name="job_skills"><?php echo @$formdata->job_skills; ?></textarea>
						  </div>
						  <div class="col-6">
							<?php 
							$imgdata = '';
							if(isset($formdata->image) && !empty($formdata->image)){ 
								$imgdata ='<div class="">
									<img src="'.imagePath($formdata->image).'" style="max-width:105px;float:right;padding:5px;">
								</div>';
								} ?>
							<label for="name" class="form-label">Job Image</label>
							<input type="file" placeholder="Job Image " name="image" class="form-control">
							<?php echo @$imgdata; ?>
						  </div>
						</div>
						<div class="row mb-3">
						  <div class="col-12">
							<label for="address1" class="form-label">Short Description</label>
							<textarea class="form-control" name="short_description"><?php echo @$formdata->short_description; ?></textarea>
						  </div>
						</div>
						<div class="row mb-3">
						  <div class="col-12">
							<label for="address2" class="form-label">Description </label>
							<textarea class="form-control" style="min-height:45px;" name="description" id="description"><?php echo @$formdata->description; ?></textarea>
						  </div>
						</div>
						
						<div class="row mb-3">
							<div class="col-12">
								<label for="address2" class="form-label">Job Status </label><br/>
								<label><input <?php if(@$formdata->status == 1){ ?>checked="checked"<?php } ?> type="checkbox" value="1" name="status"> Active</label>
							  </div>
						</div>
					  <div class="row mb-3">
					  <div class="col-12 text-center">
						<p>&nbsp;</p>
						<button type="submit" class="btn btn-info btn-lg"><?php if(@$id!==''){ echo 'Update'; }else{ echo 'Add';} ?> Job </button>
					 
					  </div>
					  </div>
					</form>
					
					
				</div>
			
				
			   
            </div>
		</div>
	</div>
</div>
 <script>
 function getSubCategory(id){
		$('#ajax_response').html('');
		$.ajax({
			url:"<?php echo URL::to('ajax/getSubCategory'); ?>",
			type:"POST",
			dataType:"JSON",
			data:{id:id},
			beforeSend:function(){
				var cont='<div class="loaderclass" id="loadingclass"><img src="<?php echo url('images/ajaxloader.gif'); ?>"></div>';
					$('#loade_ajax_unitreponse').html(cont);
			},
			success:function(res){
				$('#loade_ajax_unitreponse').html('');
				$('#sub_cat_id').html(res.html);
			}
		});
	}
	
	ClassicEditor
			.create( document.querySelector( '#description' ) )
			.then( editor => {
					console.log( editor );
			} )
			.catch( error => {
					console.error( error );
			} );

	function getSubCategory(){
		$.ajax({
			url:""
		});
	}
	$(document).ready(function() {
	   $("#add_jobsform").validate({
		  rules: {
			 title: 'required',
			 slug: 'required',
			 cat_id: 'required',
			 package_anum: {
				 required: true,
						number: true
			 },
			 job_type: 'required',
			 job_address: 'required',
			 city: 'required',
			 state: 'required',
			 postal_code: 'required',
			 job_skills: 'required',
			 short_description: 'required',
			 description: 'required',
			 gender:'required',
			 vacancy:{
						required: true,
						number: true
			 }        
		  },
		  messages: {
			     title: 'Job title required',
				 slug: 'Job slug required',
				 cat_id: 'Job category required',
				 package_anum: 'Job package required',
				 job_type: 'Job type required',
				 job_address: 'Job address required',
				 city: 'Job City required',
				 state: 'Job state required',
				 postal_code: 'Job postal code required',
				 job_skills: 'Job skill required',
				 short_description: 'Job short description',
				 description: 'Job description',
				 gender:'Gender required',
				 vacancy:{
							required: 'Job vacany required',
							number: 'Only number are allow '
				 }
			}
		  
	   });
	});
</script>
</x-navbar>