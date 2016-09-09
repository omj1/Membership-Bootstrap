//show menu under chart canvas with years buttons
// var listOfyears2 = function () {
//     var divbutt = document.getElementById("years-buttons");
//     var fyear2 = new Date(2013, 1, 1, 0, 0, 0, 0);
//     fyear2 = fyear2.getFullYear();
//     var nyear2 = new Date();
//     nyear2 = nyear2.getFullYear();
//     nyear2 += 1;
//     var numberOfButtons = nyear2 - fyear2;
//
//     var list2 ="";
//     for (i = fyear2; i < nyear2; i++) {
//         // list += "<li>" + i + "</li>";
//            list2 += "<a href=\"index.php?details=charts&year=" + i + "\" class=\"btn btn-default\">" + i + "</a>";
//     }
//     divbutt.innerHTML = list2;
// }
// listOfyears2();
// var data = '.$data.'; //set in functions-charts.php
console.log(data2); //shows objects imported from mysql in console
var stats2 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
var chart2 = function () {

  var arraylenght2 = data2.length;

  for (i = 0; i < arraylenght2; i++) {
    var mon2 = data2[i].begin_date;
    //check if char at column 5 is 0
    var inx52 = mon2.charAt(5);
    var inx62 = mon2.charAt(6);
    if ((inx52 == 0) && (inx62 != 0)) {
      //console.log(stats[inx]);
      //console.log(i);
      stats2[inx62 - 1] += parseInt(data2[i].price);
    }
    else {
      inx32 = inx52 + inx62;
      //console.log(inx32);
      //console.log(i);
      stats2[inx32 - 1] += parseInt(data2[i].price);
    }
  }
  console.log(stats2);
  var myCanvas2 = document.getElementById("myCanvas");
  var ctx2 = myCanvas.getContext("2d");
  ctx2.lineWidth = 0.5;
  ctx2.strokeStyle="red";
  ctx2.width  = 900;
  ctx2.height = 300;
  ctx2.font = "12px Arial";
  var textx = 0;
  ctx2.textAlign = "center";
  ctx2.fillStyle = "red";
  //ctx2.moveTo(20, stats[0] / 50 * (-1) + 250);
  ctx2.beginPath();
  var ix = 0;
  for (j = 0; j < stats2.length; j++){
    //ctx2.fillText(stats2[j] , ix += 71 , stats2[j] / 50 * (-1) + 200);
    ctx2.fillText(stats2[j] , ix += 71 , 50);
    ctx2.lineTo(ix, stats2[j] / 50 * (-1) + 250);
    ctx2.stroke();
  }

}
//instert data to div
// function drawchart (y) {
//   var para = document.createElement("p");
//   var node = document.createTextNode("To jest rok " + y);
//   para.appendChild(node);
//   var chartsdiv = document.getElementById("charts");
//   chartsdiv.appendChild(node);
// }
//load function when window is load

window.onload = function () {

  chart2();
  chart();
  //drawchart(2015);
}
