<x-adminl>
	<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
	<div class="row page-title-header">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
			  <div class="card-body">
				<div class="row">
					<div class="col-sm-6">
						<h4 class="card-title">Add/Update Category </h4>
					</div>
					<div class="col-sm-6 pull-end">
						<a class="pull-end text-end btn btn-info" style="float:right;" href="/admin/jobs/category">Back To List</a>
					</div>
				</div>
				<hr/>
				
					
					<?php if($error_msg!=''){ ?><p class="text text-danger">{{$error_msg}}</p><?php } ?>
					<?php if($success_msg!=''){ ?><p class="text text-success">{{$success_msg}}</p><?php } ?>
					<form class="/jobs/addcategory/" method="post" id="add_jobsform" enctype="multipart/form-data">
					   @csrf
						<div class="row mb-3">
							<div class="col-md-4">
								<label for="name" class="form-label">Category Name</label>
								<input type="text" value="<?php echo @$formdata->name; ?>" placeholder="Category Name" name="name" class="form-control">
							</div>
							<div class="col-md-4">
								<label for="name" class="form-label">Select Company</label>
								<select class="form-control" name="user_id">
									<option value="">Select Company</option>
									<?php if($allusers){
										foreach($allusers as $pk=>$pv){
											?>
											<option <?php if(@$formdata->user_id == $pv->id){ ?>selected="selected"<?php } ?> value="<?php echo $pv->id; ?>"><?php echo $pv->name; ?></option>
											<?php 
										}
									} ?>
								</select>
								
							</div>
							<div class="col-md-4">
								<label for="name" class="form-label">Category Slug</label>
								<input type="text" value="<?php echo @$formdata->slug; ?>" placeholder="Category Slug" name="slug" class="form-control">
							</div>
						  
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label for="name" class="form-label">Parent Category</label>
								<select class="form-control" name="parent_id">
									<option value="">Select Category</option>
									<?php if(sizeof($allcat)> 0 ){ 
										foreach($allcat as $ck=>$cv){
											?><option <?php if($cv->id == @$formdata->parent_id){ ?>selected="selected"<?php } ?> value="<?php echo $cv->id; ?>"><?php echo $cv->name; ?></option><?php 
										}
									} ?>
								</select>
								
							</div>
							<?php 
							$imgdata = '';
							if(isset($formdata->cat_icon) && !empty($formdata->cat_icon)){ 
								$imgdata ='<div class="col-sm-2">
									<img src="'.imagePath($formdata->cat_icon).'" style="max-width:105px;float:right;padding:5px;">
								</div>';
								} ?>
							<div class="<?php if(empty($imgdata)){ echo 'col-md-6';}else{ echo 'col-sm-4';}; ?>">
								<label for="name" class="form-label">Category Icon </label>
								<input type="file" placeholder="Job Slug" name="cat_icon" class="form-control">
								
							</div>
							<?php echo @$imgdata; ?>
						  
						</div>
						
						
						<div class="row mb-3">
							<div class="col-12">
								<label for="address2" class="form-label">Category Status </label><br/>
								<label><input type="checkbox" <?php if(@$formdata->status==1){ ?>checked="checked"<?php } ?> value="1" name="status"> Active</label>
							  </div>
						</div>
					  <div class="row mb-3">
					  <div class="col-12 text-center">
					  <p>&nbsp;</p>
						<button type="submit" class="btn btn-info btn-lg">Update Category</button>
					 
					  </div>
					  </div>
					</form>
					
			  </div>
			</div>
		  </div>	
	</div>
	
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	
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

</x-adminl>
