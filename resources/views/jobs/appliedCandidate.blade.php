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
				<div id="ajax_response"></div>
				<div class="row">
					<div class="col-sm-6">
						<h2 class="page-top-heading">Job List </h2>
					</div>
					<div class="col-sm-6 pull-right text-end backbtndiv" >
						<a class="btn btn-info" href="<?php echo URL::to('jobs/add'); ?>"> + Add</a>
					</div>
				</div>
				<div class="tab-content p-3 border bg-light table-responsive" id="nav-tabContent">
					<table id="categorylist_datatable" class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>Job Title</th>
								<th>Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Address</th>
								<th>Apply Date</th>
								<th>Resume</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if($allapplication){
							 foreach($allapplication as $ak=>$av){ ?>
							<tr id="rowid<?php echo $av->id; ?>">
								<td><?php echo $av->title; ?></td>
								<td><?php echo $av->name; ?></td>
								<td><?php echo $av->email; ?> </td>
								<td><?php echo $av->phone_number; ?> </td>
								<td><?php echo $av->address; ?> </td>
								<td><?php echo $av->apply_date; ?> </td>
								<td><?php echo $av->resume; ?> </td>
								
								<td id="change_status<?php echo @$av->id; ?>">
									
										<?php if($av->status==1){echo 'Confirm';}else{ echo'New Applicaion';} ?>
									
									</td>
								<td>
									&nbsp;
								</td>
							</tr>
						<?php }
							}	?>
							
							
						</tbody>
						
					</table>
				</div>
			
				
			   
            </div>
			
		</div>
	</div>
</div>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
 
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
<script>
	$(document).ready(function () {
		$('#categorylist_datatable').DataTable();
	});
	function removeCategory(id){
		$('#ajax_response').html('');
		$.ajax({
			url:"<?php echo URL::to('ajax/removeJobs'); ?>",
			type:"POST",
			dataType:"JSON",
			data:{id:id},
			beforeSend:function(){
				var cont='<div class="loaderclass" id="loadingclass"><img src="<?php echo url('images/ajaxloader.gif'); ?>"></div>';
					$('#loade_ajax_unitreponse').html(cont);
			},
			success:function(res){
				$('#loade_ajax_unitreponse').html('');
				if(res.status==1){
					$('#rowid'+id).remove();
					$('#ajax_response').html('<p class="alert alert-success">'+res.msg+'</p>');
				}else{
					$('#ajax_response').html('<p class="alert alert-danger">'+res.msg+'</p>');
				}
			}
		});
	}
	function changeStatus(id,st){
		$('#ajax_response').html('');
		$.ajax({
			url:"<?php echo URL::to('ajax/changeJobSt'); ?>",
			type:"POST",
			dataType:"JSON",
			data:{id:id,st:st},
			beforeSend:function(){
				var cont='<div class="loaderclass" id="loadingclass"><img src="<?php echo url('images/ajaxloader.gif'); ?>"></div>';
					$('#loade_ajax_unitreponse').html(cont);
			},
			success:function(res){
				$('#loade_ajax_unitreponse').html('');
				
				if(res.status==1){
					if(st==1){
						$('#change_status'+id+'1').addClass('showstatus').removeClass('hidestatus');
						$('#change_status'+id+'0').addClass('hidestatus').removeClass('showstatus');
					}else{
						$('#change_status'+id+'0').addClass('showstatus').removeClass('hidestatus');
						$('#change_status'+id+'1').addClass('hidestatus').removeClass('showstatus');
					}
					$('#ajax_response').html('<p class="alert alert-success">'+res.msg+'</p>');
				}else{
					$('#ajax_response').html('<p class="alert alert-danger">'+res.msg+'</p>');
				}
			}
		});
	}
</script>
</x-navbar>