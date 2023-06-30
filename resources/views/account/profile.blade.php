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
				<div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
					<button class="nav-link <?php if($active_tab=='profile'){ echo 'active'; } ?>" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
					<button class="nav-link <?php if($active_tab!='profile'){ echo 'active'; } ?>" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Change Password </button>
				</div>
				<div class="tab-content p-3 border bg-light" id="nav-tabContent">
					<div class="tab-pane fade <?php if($active_tab=='profile'){ echo 'active show'; } ?> " id="nav-profile" role="tabpanel" aria-labelledby="nav-home-tab">
					<?php
						if(@$error_msg!=''){ echo '<p class="text text-danger">'.$error_msg.'</p>';}
						if(@$success_msg!=''){ echo '<p class="text text-success">'.$success_msg.'</p>';} ?>
						@include('account/partial/profile')
					</div>
					
					<div class="tab-pane fade <?php if($active_tab!='profile'){ echo 'active show'; } ?>" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
					<?php
						if(@$error_msg!=''){ echo '<p class="text text-danger">'.$error_msg.'</p>';}
						if(@$success_msg!=''){ echo '<p class="text text-success">'.$success_msg.'</p>';} ?>
						@include('account/partial/change-password')
					</div>
				</div>
			
				
			   
            </div>
		</div>
	</div>
</div>
</x-navbar>