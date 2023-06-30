 


function handleRadioClick(trigger, target) {
  if (document.getElementById(trigger).checked) {
    target.style.display = 'block';
  } else {
    target.style.display = 'none';
  }
}



const radioButton34 = document.querySelectorAll('input[name="34a"]');
radioButton34.forEach(radio => {
  radio.addEventListener('click', function() {
    handleRadioClick('no34a', document.getElementById('readyforclass'));
  });

});

function validateFormData(){
	
}