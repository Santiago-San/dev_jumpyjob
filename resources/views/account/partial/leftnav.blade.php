
<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="<?php echo URL::to('/'); ?>/images/profileicon.png" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{auth()->user()->name}}
					</div>
					<div class="profile-usertitle-job">
						Company
					</div>
				</div>
				
				<div class="profile-usermenu">
					<ul class="navbar navbarsite">
						<li class="<?php if(getCurrentRoot()=='dashboard'){ echo 'active'; } ?>">
							<a href="<?php echo URL::to('account'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard </a>
						</li>
						<li class="<?php if(getCurrentRoot()=='profile'){ echo 'active'; } ?>">
							<a href="<?php echo URL::to('profile'); ?>"><i class="fa fa-user" aria-hidden="true"></i> Profile </a>
						</li>
						
						<li class="<?php if(getCurrentRoot()=='jobs'){ echo 'active'; } ?>">
							<a href="<?php echo URL::to('jobs'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Jobs </a>
						</li>
						<li class="<?php if(getCurrentRoot()=='jobs_categories'){ echo 'active'; } ?>">
							<a href="<?php echo URL::to('jobs/categories'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Jobs Category </a>
						</li>
						<li class="<?php if(getCurrentRoot()=='application'){ echo 'active'; } ?>">
							<a href="<?php echo URL::to('application'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Applications </a>
						</li>
						<li class="<?php if(getCurrentRoot()=='logout'){ echo 'active'; } ?>">
							<a href="<?php echo URL::to('logout'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> Logout </a>
						</li>
						
					</ul>
				</div>
				<!-- END MENU -->
			</div>