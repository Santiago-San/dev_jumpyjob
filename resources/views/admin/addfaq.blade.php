<x-adminl>
	<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
	<div class="row page-title-header">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
			  <div class="card-body">
			  <div class="row">
					<div class="col-sm-6">
						<h4 class="card-title">Add/Update Faq </h4>
					</div>
					<div class="col-sm-6 pull-end">
						<a class="pull-end text-end btn btn-info" style="float:right;" href="/admin/faqs">Back To List</a>
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
							<div class="col-md-12">
								<label for="name" class="form-label">Faq Question</label>
								<textarea placeholder="Page Title" name="faq_title" class="form-control"><?php echo @$formdata->faq_title; ?></textarea>
							</div>
							
						  
						</div>
						
						
						<div class="row mb-3">
						  <div class="col-12">
							<label for="address2" class="form-label">Faq Answer </label>
							<textarea class="form-control" placeholder="Faq Answer" style="min-height:45px;" name="faq_answer" id="description"><?php echo @$formdata->faq_answer; ?></textarea>
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
						<button type="submit" class="btn btn-info btn-lg"><?php if(@$id!==''){ echo 'Update'; }else{ echo 'Add';} ?> Faq </button>
					 
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
