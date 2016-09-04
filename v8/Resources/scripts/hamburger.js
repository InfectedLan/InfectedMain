function LinksOnMobile(navigation_pane) {
  var x = document.getElementById(navigation_pane);

  if (x.style.display == "") {
    document.getElementById(navigation_pane).style.display="block";
    document.getElementById("hamburger").style.backgroundColor="#009900";
  } else {
    document.getElementById(navigation_pane).style.display=null;
    document.getElementById("hamburger").style.backgroundColor="transparent";
  }
}
