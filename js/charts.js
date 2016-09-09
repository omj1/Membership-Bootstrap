//show menu under chart canvas with years buttons

var listOfYears = function () {
    var divbutt = document.getElementById("years-buttons");
    var fyear = new Date(2013, 1, 1, 0, 0, 0, 0);
    fyear = fyear.getFullYear();
    var nyear = new Date();
    nyear = nyear.getFullYear();
    nyear += 1;
    var numberOfButtons = nyear - fyear;

    var list ="";
    for (i = fyear; i < nyear; i++) {
        // list += "<li>" + i + "</li>";
           list += "<a href=\"index.php?details=charts&year=" + i + "\" class=\"btn btn-default\">" + i + "</a>";
    }
    divbutt.innerHTML = list;
}
listOfYears();
// var data = '.$data.'; //set in functions-charts.php
console.log(data); //shows objects imported from mysql in console
var stats = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var chart = function () {
//data przekazana z pliku function-charts.php przez skrypt php
  var arraylenght = data.length;

  for (i = 0; i < arraylenght; i++) {
    var mon = data[i].begin_date;
    //check if char at column 5 is 0
    var inx5 = mon.charAt(5);
    var inx6 = mon.charAt(6);
    if ((inx5 == 0) && (inx6 != 0)) {
      //console.log(stats[inx]);
      //console.log(i);
      stats[inx6 - 1] += parseInt(data[i].price);
    }
    else {
      inx3 = inx5 + inx6;
      //console.log(inx3);
      //console.log(i);
      stats[inx3 - 1] += parseInt(data[i].price);
    }

  }
  console.log(stats);
  var myCanvas = document.getElementById("myCanvas");
  var ctx = myCanvas.getContext("2d");
  ctx.lineWidth = 0.5;
  ctx.width  = 900;
  ctx.height = 300;
  ctx.strokeStyle="#7d7d7d";
  ctx.font = "12px Arial";
  var textx = 0;
  ctx.textAlign = "center";
  ctx.fillStyle = "#7d7d7d";
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
  //chart();
  //drawchart(2015);
}
