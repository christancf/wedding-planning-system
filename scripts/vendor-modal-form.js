var vencat = document.getElementById("vendor");


var btn = document.getElementById("myBtn");


var span = document.getElementsByClassName("close")[0];

 

btn.onclick = function(){
  vencat.style.display = "block";
}


span.onclick = function() {
  vencat.style.display = "none";
}


window.onclick = function(event) {
  if (event.target == vencat) {
    vencat.style.display = "none";
  }
}
