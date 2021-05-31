
function displayShippingForm() {
  var checkbox = document.getElementById('differentAdr');
  var div = document.getElementById('display');

if(checkbox.checked) {
div.style.display = "block";
  }
  else{
  div.style.display = "none";
  }
}
