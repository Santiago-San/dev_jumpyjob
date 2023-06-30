<x-navbar>
<div class="container">
	<div class="card">
	  <div class="card-body">
		<div class="row">
			<div class="col-sm-12">
				<form action="<?php echo URL::to('joblist'); ?>" method="get">
					<div class="row">
						<div class="col-sm-4">
							<input type="text" class="form-control" style="border-radius:30px;" id="address-input" placeholder="Enter an address">
						</div>
						<div class="col-sm-4">
							<input type="text" class="form-control" style="border-radius:30px;"  placeholder="Search Keyword">
						</div>
						<div class="col-sm-2">
							<select class="form-control" style="border-radius:30px;">
								<option value="">Select radios</option>
								<?php for($i=1;$i<10;$i++){ ?>
								<option value="<?php echo ($i*5); ?>"><?php echo ($i*5); ?></option>
								<?php } ?>
							</select>
							
						</div>
						<div class="col-sm-2 text-start">
							<button type="submit" class="cbtn" style="border-radios:30px;">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<p>&nbsp;</p>
		<div class="row">
		
			
		
			<div class="col-sm-12">
				<div class="row">
			<div class="[ col-xs-12 ]">
				<!-- job details data -->
				<article class="card car-details label-info sponsored">
                <div class="card-body">
                    <div class="d-flex flex-md-row align-items-md-start align-items-center flex-column">
                        <div class="thumbnail position-relative mb-md-0 mb-3">
                            <img src="<?php echo imagePath($jobdata->image); ?>" data-zoom="<?php echo imagePath($jobdata->image); ?>" />
                        </div>
                        <div class="w-100">
                            <div class="d-flex flex-md-row flex-column">
                                <h3 class="mr-3"><?php echo @$jobdata->title; ?></h3>
                                <div class="ml-auto text-right">
                                    <h3><?php echo pCurrency().' '.$jobdata->package_anum; ?>/Anum</h3>
                                   
                                </div>
                            </div>
                            <hr>
                            <div class="container-fluid">
								<div class="row">
									<div class="col-md-12 col-12">
										<p>&nbsp; </p>
										<strong>Short Info About Job: </strong><?php echo @$jobdata->short_description; ?>
									</div>
								</div>
                                <div class="row">
									
                                    <div class="col-md-6 col-12">
                                        <ul>
                                            <li><i class="fas fa-money-bill-alt"></i> <strong>Package :</strong> <?php echo pCurrency().' '.$jobdata->package_anum; ?>/Anum </li>
                                            <li><i class="fas fa-calendar-week"></i> <strong>Job Category:</strong> <?php echo @$catdata->name;
											if(@$sub_catdata->name!=''){ echo '/'.$sub_catdata->name;} ?></li>
                                            <li><i class="fas fa-user-md"></i> <strong>Number Of Vacancy:</strong> <?php echo @$jobdata->vacancy; ?></li>
											
											
                                            <li><i class="fas fa-user"></i> <strong>Gendar:</strong> 
											<?php echo @$jobdata->gender; ?></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <ul>
                                            <li><i class="fas fa-x-ray"></i> <strong>Job Type:</strong> <?php echo getJobType(@$jobdata->job_type); ?> </li>
                                            <li><i class="fas fa-x-ray"></i> <strong>Job Skills:</strong> <?php echo @$jobdata->job_skills; ?></li>
                                            <li> <i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> <?php echo @$jobdata->job_address.' '.@$jobdata->city.' '.@$jobdata->state.' - '.@$jobdata->postal_code; ?></li>
                                        </ul>
                                    </div>
									<div class="col-md-12 col-12">
										<p>&nbsp;</p>
										<strong>description: </strong><?php echo @$jobdata->description; ?>
									</div>
                                    <div class="col-12 ">
                                        <div class="d-flex flex-md-row flex-column align-items-center justify-content-end">
                                            <button data-bs-toggle="modal" data-bs-target="#applyjobportal" class="btn btn-success w-50 mb-md-0 mb-3 mr-md-3 mr-0"> Apply Job</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
				<!-- job details data -->
				
			</div>
		</div>
			</div>
			<div class="col-sm-1"></div>
		</div>
	  </div>
	</div>
    
</div>
<!-- Modal -->
<div class="modal fade" id="applyjobportal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apply For Job "<?php echo @$jobdata->title; ?>"</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  @if (Session::has('success_msg'))
	   <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
	@endif
	@if (Session::has('error_msg'))
	   <div class="alert alert-danger">{{ Session::get('error_msg') }}</div>
	@endif
	  <form id="applyjobform" method="post" action="/applyjobs"  enctype="multipart/form-data">
	  @csrf
      <div class="modal-body">
        <input type="hidden" value="<?php echo @$jobdata->id; ?>" name="job_id">
        <input type="hidden" value="<?php echo @$jobdata->slug; ?>" name="job_slug">
		  <div class="mb-3">
			<label for="name" class="form-label">Name</label>
			<input type="text" name="name" placeholder="Name" class="form-control" id="name">
		  </div>
		  <div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="text" name="email" placeholder="Email" class="form-control" id="email">
		  </div>
		  <div class="mb-3">
			<label for="phone_number" class="form-label">Phone Number</label>
			<input type="text" name="phone_number" placeholder="Phone Number" class="form-control" id="phone_number">
		  </div>
		  <div class="mb-3">
			<label for="phone_number" class="form-label">Address</label>
			<textarea class="form-control" placeholder="Address" name="address"></textarea>
		  </div>
		  <div class="mb-3">
			<label for="phone_number" class="form-label">Attach Resume (pdf,Doc)</label>
			<input type="file" name="resume" class="form-control" id="resume">
		  </div>
		  
		  <div class="mb-3 form-check">
			<input type="checkbox" name="term_condition" value="1" class="form-check-input" id="term_condition_checkbox">
			<label class="form-check-label" for="term_condition_checkbox">Term & Conditions </label>
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="cbtn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="cbtn btn-primary">Apply </button>
      </div>
	  </form>
    </div>
  </div>
</div>

<script>
	
	$(document).ready(function() {
	   $("#applyjobform").validate({
		   submitHandler: function(form) {
			form.submit();
		  },
		  rules: {
			 name: 'required',
			 email: 'required',
			 phone_number: {
				 required: true,
						number: true
			 },
			 address: 'required',
			 resume: {
				 required: true,
				 extension: "docx|rtf|doc|pdf"
			 },
			 term_condition:'required'       
		  },
		  messages: {
			     name: 'Name required',
			     email: 'Email required',
			     phone_number: {
					 required: 'Phone required',
					 number: 'Only number are allow '
				 },
				address:'Address required',
				resume:{
							required: 'Please attached your resume ',
							number: 'Only pdf, docx, rtf adn doc file are allow '
				 },
				term_condition:'Please accept our term and conditions'
			}
		  
	   });
	});
</script>
</x-navbar>