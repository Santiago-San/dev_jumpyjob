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
		
			<div class="col-sm-3 leftnavsearch">
				<article class="filter-group">
				<div class="card-body">
					<h2><?php if($is_category==1){  } ?> Job Categories</h2>
					<hr/>
					<form action="" id="leftFilterForm">
						<input type="hidden" name="cat" value="" id="left_filter_cat">
					<ul class="leftClass">
						<?php 
						if($allcat){
							$allcheckbox = [];
							if(@$_GET['cat']!=''){
								$allcheckbox = explode(',',$_GET['cat']);
							}
							foreach($allcat as $ck=>$cv){
								?>
								<li>
									<label class="custom-control custom-checkbox">
									  <input onchange="onclickOnCheckboxForm();" <?php  if (in_array($cv->id, $allcheckbox)){ ?> checked <?php } ?> type="checkbox"  value="<?php echo $cv->id; ?>" class="custom-control-input leftcatcheck">
										<?php echo $cv->name; ?>
									</label>
								</li>
								<?php 
							}
						}
						?>
						
						
					</ul>
					</form>
					<script>
					function onclickOnCheckboxForm(){
						var left_filter_cat=[];
						$(".leftcatcheck:checkbox:checked").each(function(){
							left_filter_cat.push($(this).val());
						});
						
						$('#left_filter_cat').val(left_filter_cat.toString())
						$('#leftFilterForm').submit();
					}
					</script>		
							
				</div>
				</article>
	
			</div>
		
			<div class="col-sm-8">
				<div class="row">
			<div class="[ col-xs-12 ]">
				<div class="row">
					<div class="col-sm-12">
					<?php $ptitle = 'Job List Page'; ?>
						<nav aria-label="breadcrumb">
						  <ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo URL::to('/'); ?>">Home</a></li>
							<li class="breadcrumb-item"><a href="<?php echo URL::to('joblist'); ?>">Job List</a></li>
							<?php if($is_category==1){
								$ptitle = @$catdata->name.' Job List Page';								?>
								<li class="breadcrumb-item active" aria-current="page"><?php echo @$catdata->name; ?></li>	
							<?php } ?>
						  </ol>
						</nav>

						<h2 class="h2"><?php echo $ptitle; ?></h2>
						<p>&nbsp;</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="event-list">
							<?php if($alljobs){
								foreach($alljobs as $jk=>$jv){ ?>
							<li class="">
								<img alt="<?php echo $jv->title; ?>" src="<?php echo imagePath($jv->image); ?>"/>
								<div class="info" style="padding-left:20px;">
									<h2 class="title listtitle"><?php echo $jv->title; ?></h2>
									<div class="row">
										<div class="col-sm-3">
											<a href="/joblist/detail/<?php echo $jv->slug; ?>" class="joblist-btn1 cbtnl">Top Job win</a>
										</div>
										<div class="col-sm-3">
											<a href="/joblist/detail/<?php echo $jv->slug; ?>" class="joblist-btn2 cbtnl">Top Job win</a>
										</div>
										<div class="col-sm-3">
											<a href="/joblist/detail/<?php echo $jv->slug; ?>" class="joblist-btn3 cbtnl">Top Job win</a>
										</div>
										<div class="col-sm-3">
											<a href="/joblist/detail/<?php echo $jv->slug; ?>" class="joblist-btn4 cbtnl">Top Job win</a>
										</div>
									</div>
									<p class="desc"><?php echo $jv->short_description; ?></p>
									
								</div>
								<div class="social">
									<ul>
										<li class="facebook" style="width:33%;"><a href="#facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
										<li class="twitter" style="width:34%;"><a href="#twitter"><i class="fa-brands fa-twitter"></i></a></li>
										<li class="google-plus" style="width:33%;"><a href="#google-plus"><i class="fa-brands fa-instagram"></i></a></li>
									</ul>
								</div>
								
							</li>
								<?php }
							}else{ ?>
							<li><p class="alert alert-danger">No jobs found</p></li>
							<?php } ?>
				
						</ul>
					</div>
				</div>
			</div>
		</div>
			</div>
			<div class="col-sm-1"></div>
		</div>
	  </div>
	</div>
    
</div>
</x-navbar>