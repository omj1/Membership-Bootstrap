
<?php
global $thisyear;
global $thisyear2;
function drawVisualization() {
  $thismonth = date("m");
  $nowyear = date("Y");
  if ($_GET[year] == ""){
      $thisyear = $nowyear;
  } else {
      $thisyear = $_GET[year];
  }
  //echo $thismonth;
  include "connect.php";
  $zapytanie = "SELECT * FROM payments WHERE YEAR(begin_date)=$thisyear;";

  $wynik = $db -> query ($zapytanie);

  //przerabiamy wiersze z bazy do json
  $rows = array();
  while($row = mysqli_fetch_array($wynik)){
  $rows[] = $row;
}
  $ile_znalezionych = mysqli_num_rows($wynik);

  echo '
  <div class="col-lg-6" id="years-buttons">  </div>
  <div class="col-lg-6"> </div>
  <div class="">&nbsp;</div>
  <div class="row text-center" id="charts">
  <canvas id="myCanvas" width=900 height=300 style="width:100%;height:300px"></canvas>
  </div><blockquote><br>
  <p>Sprzedane w '.$thisyear.' roku: '.$ile_znalezionych.' abonamentów';
  echo '</p></blockquote>';


  $data = json_encode($rows);
    echo '
    <script>
    var data = '.$data.';
    </script>
    <script src="js/charts.js">  </script>
      ';
}
?>

<?php
//nie zapomnij wywolac funkcji w kontrolery.php
function drawVisualization2() {
  $thismonth2 = date("m");
  $nowyear2 = date("Y");
  if ($_GET[year] == ""){
      $thisyear2 = $nowyear2 - 2; //rok poprzedni pobiera sie prawidlowo
  } else {
      // $thisyear2 = $_GET[year];
      $thisyear2 = $nowyear2 - 2;
  }
  echo $thisyear;
  if ($thisyear == 2014){
      $thisyear2 = 2013;
  }
   echo $thismonth2;
   echo $thisyear2;
  include "connect.php";
  $zapytanie2 = "SELECT * FROM payments WHERE YEAR(begin_date)=$thisyear2;";

  $wynik2 = $db -> query ($zapytanie2);

  //przerabiamy wiersze z bazy do json
  $rows2 = array();
  while($row2 = mysqli_fetch_array($wynik2)){
  $rows2[] = $row2;
}
  $ile_znalezionych2 = mysqli_num_rows($wynik2);

  echo '
  <blockquote><p style="color:red">Sprzedane w '.$thisyear2.' roku: '.$ile_znalezionych2.' abonamentów';
  echo '</p></blockquote>';


  $data2 = json_encode($rows2);
    echo '
    <script>
    var data2 = '.$data2.';
    </script>
    <script src="js/charts2.js">  </script>
      ';
}
?>
