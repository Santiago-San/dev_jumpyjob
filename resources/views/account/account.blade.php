<x-navbar>
    <link rel="stylesheet" href="<?php echo public_path('css/userdashboard.css'); ?>">
	<style>
	{{ include public_path('css/userdashboard.css') }}
	</style>
<div class="container">
    <div class="row profile">
		<div class="col-sm-3">
			@include('partial/leftnav') 
		</div>
		<div class="col-sm-9">
            <div class="profile-content">
			   <div class="row">
				 <div class="col">
					<div class="dbox">
						<div class="counter">
							  <i class="fa fa-coffee fa-2x"></i>
							  <h2 class="timer count-title count-number" data-to="100" data-speed="1500"></h2>
							   <p class="count-text ">Our Customer</p>
						</div>
					</div>
					
				 </div>
				 <div class="col">
					<div class="dbox">
						<div class="counter">
							  <i class="fa fa-coffee fa-2x"></i>
							  <h2 class="timer count-title count-number" data-to="100" data-speed="1500"></h2>
							   <p class="count-text ">Our Customer</p>
						</div>
					</div>
					
				 </div>
				 <div class="col">
					<div class="dbox">
						<div class="counter">
							  <i class="fa fa-coffee fa-2x"></i>
							  <h2 class="timer count-title count-number" data-to="100" data-speed="1500"></h2>
							   <p class="count-text ">Our Customer</p>
						</div>
					</div>
					
				 </div>
				
			
								 
			   </div>
            </div>
		</div>
	</div>
</div>
</x-navbar>