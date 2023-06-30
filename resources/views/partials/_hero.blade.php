
<div class="flex justify-center h-[calc(100vh-6.75rem)] bg-[#FFB800]">
	<div class="row text-center" style="float:left;width:100%;">
		<div class="col-sm-12">
			<h1 style="font-size:48px;margin-bottom:20px;" class="relative z-0 mt-12 text-8xl font-bold -ml-12 text-[#720942] "><span style="font-weight:normal;">Willkommen bei</span> <br/>
			JumpyJob<h1>
		</div>
		
		<div class="col-sm-12 text-center">
			 <img style="margin:0 auto;" src="{{asset('/images/biglogo.png')}}" alt="" class="">
		</div>
		<p>&nbsp;</p>
		<div class="col-sm-12">
			<div class="container">
				
				<form action="<?php echo URL::to('joblist'); ?>" method="get">
				<div class="row">
					<div class="col-sm-5">
						<input type="text" class="form-control" style="border-radius:30px;" id="address-input" placeholder="Enter an address">
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" style="border-radius:30px;"  placeholder="Search Keyword">
					</div>
					<div class="col-sm-2 text-start">
						<button type="submit" class="cbtn" style="border-radios:30px;">Search</button>
					</div>
					
				</div>
				</form>
			</div>
			
			

		</div>
	</div>
	
				
</div>

<script>
const input = document.getElementById('address-input'); // Replace 'address-input' with the ID of your input field
const autocomplete = new google.maps.places.Autocomplete(input);

autocomplete.addListener('place_changed', () => {
  const selectedPlace = autocomplete.getPlace();
  // Access the selected address components using selectedPlace.address_components
  // Perform any necessary actions with the address data
});


</script>