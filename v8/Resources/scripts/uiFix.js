function calcVH() 
{

  var PxToReduce = "";
  
  var wW = Math.max(document.documentElement.clientWidth, window.innerWidth || 0)
  

    if (wW >= 919) 
    {
      PxToReduce = 125;
    } 
    else if (wW >= 660) 
    {
      PxToReduce = 115;
    }
    else if (wW >= 450) 
    {
      PxToReduce = 100;
    }
    else if (wW >= 0) {
      PxToReduce = 95;
    }



  var vH = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);

  vH = vH - PxToReduce + "px;";

  document.getElementById("BottomPeek").setAttribute("style", "height:" + vH);
}
calcVH();
window.addEventListener('onorientationchange', calcVH, true);
window.addEventListener('resize', calcVH, true);

