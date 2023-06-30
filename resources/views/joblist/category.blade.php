<x-navbar>
<div class="container">
	<div class="card">
	  <div class="card-body">
		
		<p>&nbsp;</p>
		<div class="row">
			<div class="col-10 offset-1">
				<p class="h2 text-danger">Category List here </p>
				<hr/>
				<?php if($allcat){
					$totalcat = sizeof($allcat);
					$i=0;
					$tc=0;
					foreach($allcat as $ck=>$cv){ $tc++;
						if($i==0){
							echo '<div class="row">';
						}
						$i++;
						?>
						
							<div class="col">
								<a href="<?php echo URL::to('joblist/'.$cv->slug); ?>">
									<div class="catbox">
										<p class="texthead1" ><?php echo $cv->name; ?></p>
										<img src="<?php echo imagePath($cv->cat_icon); ?>">
										<p class="texthead2" style="display:none;"><?php echo $cv->name; ?></p>
									</div>
								</a>
								
							</div>
							
						  
						<?php 
						if($i%5==0 || $tc==$totalcat){
							echo '</div>';
						}
					}
			} ?>
			</div>
		</div>
		
		
	  </div>
	</div>
    
</div>
</x-navbar>