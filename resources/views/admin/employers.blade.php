<x-adminl>
	<div class="row page-title-header">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
			  <div class="card-body">
				<div class="row card-title">
					<div class="col-sm-6">
						<h2 class="page-top-heading">Company List </h2>
					</div>
					<div class="col-sm-6 pull-end text-right backbtndiv">
						<a class="btn btn-info pull-end" href="<?php echo URL::to('admin/addemployer'); ?>"> + Add</a>
					</div>
				</div>
				
				<div id="ajax_response"></div>
				<?php if(@$error_msg!=''){ ?>
					<p class="alert alert-danger"><?php echo $error_msg; ?></p>
				<?php } ?>
				<?php if(@$success_msg!=''){ ?>
					<p class="alert alert-success"><?php echo $success_msg; ?></p>
				<?php } ?>
				
				<div class="tab-content p-3 border bg-light table-responsive" id="nav-tabContent">
					<table id="categorylist_datatable" class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Address</th>
								<th>City</th>
								<th>State</th>
								<th>Postal Code </th>
								<th>Country</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							if($allemployers){
							 foreach($allemployers as $ak=>$av){ ?>
							<tr id="rowid<?php echo $av->id; ?>">
								
								<td><?php echo $av->name; ?></td>
								<td><?php echo $av->email; ?></td>
								<td><?php echo $av->address1.' '.$av->address2; ?> </td>
								<td><?php echo $av->city;?> </td>
								<td><?php echo $av->state;?> </td>
								<td><?php echo $av->postal_code;?> </td>
								<td><?php echo $av->country;?> </td>
								
								<td id="change_status<?php echo @$av->id; ?>">
									
										<a id="change_status<?php echo @$av->id; ?>1"  class="<?php if($av->status==1){ echo 'showstatus'; }else{ echo 'hidestatus';} ?> btn text text-success" href="javascript:void(0);" onclick="changeStatus(<?php echo @$av->id; ?>,0)"> Active</a>
										<a id="change_status<?php echo @$av->id; ?>0" class="<?php if($av->status!=1){ echo 'showstatus'; }else{ echo 'hidestatus';} ?> btn text text-danger" href="javascript:void(0);" onclick="changeStatus(<?php echo @$av->id; ?>,1)"> InActive</a>
									
									</td>
								<td>
									<a class="btn text text-info fa-2x" class="" href="<?php echo URL::to('admin/addemployer/'.$av->id); ?>">Edit</a>
									<a class="btn text text-danger fa-2x" onclick="if(confirm('Do you want to remove ')){ removeCategory('{{$av->id}}'); }" href="javascript:void(0);">X</a>
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
			url:"<?php echo URL::to('ajax/admin/removeemployer'); ?>",
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
			url:"<?php echo URL::to('ajax/admin/changeemployerstatus'); ?>",
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
<style>
.showstatus{
	display:block;
}
.hidestatus{
	display:none;
}

</style>		
			
</x-adminl>

