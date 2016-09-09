
// var data = '.$data.'; //set in functions-charts.php
console.log(data); //shows objects imported from mysql in console
var stats = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var chart = function () {

  var arraylenght = data.length;

  for (i = 0; i < arraylenght; i++) {
    var mon = data[i].begin_date;
    //check if char at column 5 is 0
    var inx5 = mon.charAt(5);
    var inx6 = mon.charAt(6);
    if ((inx5 == 0) && (inx6 != 0)) {
      //tworzenie tablicy stats[] z suma wartosci price z kazdym mmiesiacem gdzie znak w dacie na piatym miejsu rowny jest 0 i znak na sostej pozycji rozny jest od zero
      //tablica stats[] jest jedna, inx... to index w tablicy
      stats[inx6 - 1] += parseInt(data[i].price);
    }
    else {
      inx3 = inx5 + inx6;
      //tworzenie tablicy stats[] z suma wartosci price z kazdym mmiesiacem gdzie znak w dacie na piatym miejsu jest rozny od zero
      stats[inx3 - 1] += parseInt(data[i].price);
    }
  }
  console.log(stats);
  var myCanvas = document.getElementById("myCanvas");
  var ctx = myCanvas.getContext("2d");
  ctx.lineWidth = 0.5;
  ctx.width  = 900;
  ctx.height = 300;
  ctx.font = "12px Arial";
  var textx = 0;
  ctx.textAlign = "center";
  ctx.fillStyle = "green";
  //ctx.moveTo(20, stats[0] / 50 * (-1) + 250);
  ctx.beginPath();
  var ix = 0;
  for (j = 0; j < stats.length; j++){
    ctx.fillText(stats[j] , ix += 71 , stats[j] / 50 * (-1) + 240);
    ctx.lineTo(ix, stats[j] / 50 * (-1) + 250);
    ctx.stroke();
  }
  var ix = 0;
  var ixx = 0;
  for (k = 1; k <= stats.length; k++){
    ctx.beginPath();
    ctx.strokeStyle="lightgray"; // Purple path
    ctx.moveTo(ix += 71, 0);
    ctx.lineTo(ixx += 71, 300);
    ctx.stroke();
  }
  ctx.font = "14px Arial";
  var textx = 0;
  ctx.textAlign = "center";
  for (l = 1; l <= stats.length; l++){
    var m = l;
    ctx.fillText(l + 0 , textx += 71 , 290);
  }
}
//instert data to div

function drawchart (y) {
  var para = document.createElement("p");
  var node = document.createTextNode("To jest rok " + y);
  para.appendChild(node);
  var chartsdiv = document.getElementById("charts");
  chartsdiv.appendChild(node);
}
//load function when window is load

window.onload = function () {
  chart();
  drawchart(2015);
}
