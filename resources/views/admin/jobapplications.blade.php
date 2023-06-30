<x-adminl>
	<div class="row page-title-header">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
			  <div class="card-body">
				<div class="row card-title">
					<div class="col-sm-6">
						<h2 class="page-top-heading">Job Applications</h2>
					</div>
					<div class="col-sm-6 pull-end text-right backbtndiv">
						
					</div>
				</div>
				
				<div id="ajax_response"></div>
				
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

