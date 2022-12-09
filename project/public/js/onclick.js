function myOnclickCancel(){

    var x = document.getElementById('cancel');
    var y = document.getElementById('accept');
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
    if(y.style.display === "block") {
        x.style.display = "none";
    }
}
function myOnclickAccept(){

  var x = document.getElementById('accept');
  var y = document.getElementById('cancel');
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  if(y.style.display === "block") {
      x.style.display = "none";
  }
}