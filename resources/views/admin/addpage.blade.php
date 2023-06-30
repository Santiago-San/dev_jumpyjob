<x-adminl>
	<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
	<div class="row page-title-header">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
			  <div class="card-body">
			  <div class="row">
					<div class="col-sm-6">
						<h4 class="card-title">Add/Update CMS </h4>
					</div>
					<div class="col-sm-6 pull-end">
						<a class="pull-end text-end btn btn-info" style="float:right;" href="/admin/pages">Back To List</a>
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
							<div class="col-md-6">
								<label for="name" class="form-label">Page Title</label>
								<input type="text" value="<?php echo @$formdata->page_title; ?>" placeholder="Page Title" name="page_title" class="form-control">
							</div>
							<div class="col-md-6">
								<label for="name" class="form-label">Page Slug</label>
								<input type="text" value="<?php echo @$formdata->slug; ?>" placeholder="Job Slug" name="slug" class="form-control">
							</div>
						  
						</div>
						<div class="row mb-12">
							<div class="col-md-12">
								<label for="name" class="form-label">Short Description</label>
								<textarea placeholder="Page Short description" name="short_description" class="form-control"><?php echo @$formdata->short_description; ?></textarea>
							</div>
						</div>
						
						<div class="row mb-3">
						  <div class="col-12">
							<label for="address2" class="form-label">Description </label>
							<textarea class="form-control" style="min-height:45px;" name="description" id="description"><?php echo @$formdata->description; ?></textarea>
						  </div>
						</div>
					
						
						
						<div class="row mb-3">
						  <div class="col-md-6">
								<label for="name" class="form-label">Browser Title</label>
								<input type="text" placeholder="Browser Title" name="browser_title" class="form-control" value="<?php echo @$formdata->browser_title; ?>">
							</div>
						  <div class="col-6">
							<?php 
							$imgdata = '';
							if(isset($formdata->page_image) && !empty($formdata->page_image)){ 
								$imgdata ='<div class="">
									<img src="'.imagePath($formdata->page_image).'" style="max-width:105px;float:right;padding:5px;">
								</div>';
								} ?>
							<div class="form-group">
							<label>Page Image</label>
							<input type="file" name="page_image" class="form-control" class="file-upload-default">
							
						  </div>
						  
							<?php echo @$imgdata; ?>
						  </div>
						</div>
						<div class="row mb-12">
							<div class="col-md-6">
								<label for="name" class="form-label">Meta Key</label>
								<textarea placeholder="Meta Keyword" name="meta_key" class="form-control"><?php echo @$formdata->meta_key; ?></textarea>
							</div>
							<div class="col-md-6">
								<label for="name" class="form-label">Meta description</label>
								<textarea placeholder="Meta description" name="meta_content" class="form-control"><?php echo @$formdata->meta_content; ?></textarea>
							</div>
						</div>
						
						
						
						<div class="row mb-3">
							<div class="col-4">
								<label for="address2" class="form-label">Job Status </label><br/>
								<label><input <?php if(@$formdata->status == 1){ ?>checked="checked"<?php } ?> type="checkbox" value="1" name="status"> Active</label>
							  </div>
							 <div class="col-4">
								<label for="address2" class="form-label">Is Header </label><br/>
								<label><input <?php if(@$formdata->is_header == 1){ ?>checked="checked"<?php } ?> type="checkbox" value="1" name="is_header"> Active</label>
							  </div>
							  <div class="col-4">
								<label for="address2" class="form-label">Is Footer </label><br/>
								<label><input <?php if(@$formdata->is_footer == 1){ ?>checked="checked"<?php } ?> type="checkbox" value="1" name="is_footer"> Active</label>
							  </div>
						</div>
					  <div class="row mb-3">
					  <div class="col-12 text-center">
						<p>&nbsp;</p>
						<button type="submit" class="btn btn-info btn-lg"><?php if(@$id!==''){ echo 'Update'; }else{ echo 'Add';} ?> Page </button>
					 
					  </div>
					  </div>
					</form>
					
			  </div>
			</div>
		  </div>	
	</div>
	
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
	
<script>
 
	ClassicEditor
			.create( document.querySelector( '#description' ) )
			.then( editor => {
					console.log( editor );
			} )
			.catch( error => {
					console.error( error );
			} );

	
	$(document).ready(function() {
	   $("#add_jobsform").validate({
		  rules: {
			 page_title: 'required',
			 slug: 'required',
			 description: 'required',
			 short_description: 'required',
			      
		  },
		  messages: {
				page_title: 'Fill page title',
				 slug: 'Slug required',
				 description: 'Page description required',
				 short_description: 'Short description required'
			}
		  
	   });
	});
</script>

</x-adminl>
