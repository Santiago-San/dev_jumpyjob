<x-navbar>
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
				<div class="row">
					<div class="col-sm-6">
						<h2 class="page-top-heading">Add/Update Category</h2>
					</div>
					<div class="col-sm-6 pull-right text-end backbtndiv" >
						<a class="btn btn-info" href="<?php echo URL::to('jobs/categories/'); ?>">Back</a>
					</div>
				</div>
				<div class="tab-content p-3 border bg-light" id="nav-tabContent">
				<?php if($error_msg!=''){ ?><p class="text text-danger">{{$error_msg}}</p><?php } ?>
					<?php if($success_msg!=''){ ?><p class="text text-success">{{$success_msg}}</p><?php } ?>
					<form class="/jobs/addcategory/" method="post" id="add_jobsform" enctype="multipart/form-data">
					   @csrf
						<div class="row mb-3">
							<div class="col-md-6">
								<label for="name" class="form-label">Category Name</label>
								<input type="text" value="<?php echo @$formdata->name; ?>" placeholder="Category Name" name="name" class="form-control">
							</div>
							<div class="col-md-6">
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
</div>
</x-navbar>