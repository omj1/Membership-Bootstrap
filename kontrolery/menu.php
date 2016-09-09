<?php
function menu (){
    global $telefon;
    global $komorka;
    echo '
    <div id="panel-menu">
    <left>';
    if ($telefon != "") { echo '<telefon>Telefon:</telefon> '.$telefon;}
    echo '</left>
    <right>';
    if ($komorka != "") { echo '<telefon>Pomoc:</telefon> '.$komorka;}
    echo '</right>
    </div>
    <div id="nav">
    <ul>
    <li><a class="active" href="index.php">Aktywne karnety</a></li>
    <li><a href="index.php?details=dodaj">Dodaj klienta</a></li>
    </ul>
    </div>
    ';
}
function menutop (){
    if ($_SESSION['prawid_uzyt'] == 'admin') {
		echo '
    <li><a href="index.php?details=charts">Wykresy</a></li>
		<li><a href="index.php?details=monthlystats">Statystyki</a></li>';
	}
	echo '
	<li class="active"><a href="index.php">Aktywne karnety</a></li>
	<li><a href="index.php?details=dodaj">Dodaj klienta</a></li>';
  if(isset($_SESSION['prawid_uzyt']))
  {
    echo '<li><a href="index.php?p=wyloguj"> '.$_SESSION['prawid_uzyt'].'';
    echo ' Wyloguj</a></li>';
  }
}

?>
