<?php
function numberofmonthmembers () {
$thismonth = date("m");
$thisyear = date("Y");
//echo $thismonth;
include "connect.php";
$zapytanie = "SELECT * FROM payments WHERE MONTH(begin_date)=$thismonth AND YEAR(begin_date)=$thisyear;";
$wynik = $db -> query ($zapytanie);
$ile_znalezionych = mysqli_num_rows($wynik);
echo '<blockquote>
  <p>Sprzedane: '.$ile_znalezionych.' abonamentów';
  numberofstudentpayments ();
echo '</p></blockquote>';
/* funkcja na wypisanie wszystkich kwot z danego miesiaca po kolei
echo "<br>";
 for($i=0; $i<$ile_znalezionych; $i++)
	{
	$wiersz = $wynik ->fetch_assoc();
	echo stripslashes($wiersz['begin_date']);
	echo "<br>";
	}
	*/
	}

function numberofstudentpayments () {
$thismonth = date("m");
$thisyear = date("Y");
//echo $thismonth;
include "connect.php";
$zapytanie = "SELECT * FROM payments WHERE MONTH(begin_date)=$thismonth AND YEAR(begin_date)=$thisyear AND price = 80;";
$wynik = $db -> query ($zapytanie);
$ile_znalezionych = mysqli_num_rows($wynik);
echo '<small>w tym: '.$ile_znalezionych.' ulgowe/ych</small>';
/* funkcja na wypisanie wszystkich kwot z danego miesiaca po kolei
echo "<br>";
 for($i=0; $i<$ile_znalezionych; $i++)
	{
	$wiersz = $wynik ->fetch_assoc();
	echo stripslashes($wiersz['begin_date']);
	echo "<br>";
	}
	*/
	}

function sumofthemonth () {
$thismonth = date("m");
	$thisyear = date("Y");
//echo $thismonth;
include "connect.php";
$zapytanie = "SELECT SUM(price) AS suma FROM payments WHERE MONTH(begin_date)=$thismonth AND YEAR(begin_date)=$thisyear;";
$wynik = $db -> query ($zapytanie);
$wiersz = $wynik ->fetch_assoc();
echo '<blockquote>
  <p><span>Sprzedaż: '.$wiersz['suma'].' zł</span></p></blockquote>';
	}

function monthlystats () {

	if (($_POST[begindate] && $_POST[finishdate] !== NULL) || ($_GET[fday] && $_GET[lday] !== NULL))  {
	$bdate = $_POST[begindate];
	$fdate = $_POST[finishdate];
	if ($_GET[fday] && $_GET[lday] !== NULL) {
	$bdate = $_GET[fday];
	$fdate = $_GET[lday];
		}
	include "connect.php";
	$zapytanie = "SELECT * FROM payments WHERE begin_date BETWEEN '$bdate' AND '$fdate'";
	echo "<h1>Statystyki dla okresu od: ";
	echo $bdate;
	echo " do: ";
	echo $fdate;
	echo "</h1>";
	$wynik = $db -> query($zapytanie);
	$ile_znalezionych = mysqli_num_rows($wynik);
	echo '<div class="row"><div class="col-md-6"><blockquote><p>Sprzedane: '.$ile_znalezionych.' karnetów</p>';

	include "connect.php";
	$zapytanie = "SELECT * FROM payments WHERE begin_date BETWEEN '$bdate' AND '$fdate' AND price != 100;";
	$wynik = $db -> query ($zapytanie);
	$ile_znalezionych = mysqli_num_rows($wynik);
	echo '<small>w tym: '.$ile_znalezionych.' w cenie różnej od 100 zł</small>';
	echo '</blockquote>';

	include "connect.php";
	$zapytanie = "SELECT SUM(price) AS suma FROM payments WHERE begin_date BETWEEN '$bdate' AND '$fdate'";
	$wynik = $db -> query ($zapytanie);
	$wiersz = $wynik ->fetch_assoc();
	echo '<blockquote><p><span>Suma sprzedaży karnetów: <strong>'.$wiersz['suma'].'</strong> zł</span></p></blockquote></div>';

	include "connect.php";
	$zapytanie = "SELECT * FROM payments WHERE addedby = 'admin' AND (begin_date BETWEEN '$bdate' AND '$fdate');";
	$wynik = $db -> query ($zapytanie);
	$ile_znalezionych = mysqli_num_rows($wynik);
	echo '<div class="col-md-6"><blockquote><p>Karnety dodane przez admina: '.$ile_znalezionych.' szt</p>';
	echo '';

	include "connect.php";
	$zapytanie = "SELECT * FROM payments WHERE addedby = 'admin' AND (begin_date BETWEEN '$bdate' AND '$fdate')";
	$wynik = $db -> query ($zapytanie);
	$ile_znalezionych = mysqli_num_rows($wynik);
	$zapytanie2 = "SELECT * FROM payments WHERE begin_date BETWEEN '$bdate' AND '$fdate'";
	$wynik2 = $db -> query ($zapytanie2);
	$ile_znalezionych2 = mysqli_num_rows($wynik2);
	$addedbyservice = $ile_znalezionych2 - $ile_znalezionych;
	echo '<small>w tym dodane przez pracowników: '.$addedbyservice.' szt</small>';
	echo '</blockquote></div></div>';


}
	$thisyear = date("Y");
	//poprzedni miesiac
	$month_ini = date("Y-m-d", mktime(0, 0, 0, date("m", strtotime("-1 month")), 1, date("Y", strtotime("-1 month"))));
    $month_end = date("Y-m-d", mktime(0, 0, 0, date("m", strtotime("-1 month")), date("t", strtotime("-1 month")), date("Y", strtotime("-1 month"))));
	//caly poprzedni rok
	$year_ini = date("Y-m-d", mktime(0, 0, 0, 1, 1, ($thisyear-1)));
    $year_end = date("Y-m-d", mktime(0, 0, 0, 12, 31, ($thisyear-1)));
	//aktualny nowy rok
	$this_year_ini = date("Y-m-d", mktime(0, 0, 0, 1, 1, date("Y")));
    $this_year_end = date("Y-m-d", mktime(0, 0, 0, 2, 28, date("Y")));
	//poprzedni nowy rok
	$new_year_ini = date("Y-m-d", mktime(0, 0, 0, 1, 1, ($thisyear-1)));
    $new_year_end = date("Y-m-d", mktime(0, 0, 0, 2, 28, date("Y", strtotime("-1 Year"))));
	//wakacje
	$vacation_ini = date("Y-m-d", mktime(0, 0, 0, 7, 1, ($thisyear-1)));
    $vacation_end = date("Y-m-d", mktime(0, 0, 0, 8, 31, date("Y", strtotime("-1 Year"))));
	//poprzednie wakacje
	$today = date("m-d");
	$last_vac_end = date("m-d", mktime(0, 0, 0, 8, 31, date("Y", strtotime("-1 Year"))));
	if ($today > $last_vac_end) {
		$last_vac_ini = date("Y-m-d", mktime(0, 0, 0, 7, 1, ($thisyear-1)));
		$last_vac_end = date("Y-m-d", mktime(0, 0, 0, 8, 31, date("Y", strtotime("-1 Year"))));
	} else {
		$last_vac_ini = date("Y-m-d", mktime(0, 0, 0, 7, 1, ($thisyear-2)));
		$last_vac_end = date("Y-m-d", mktime(0, 0, 0, 8, 31, date("Y", strtotime("-2 Year"))));
	}

	//nowy rok szkolny
	$today = date("m-d");
	$last_school_end = date("m-d", mktime(0, 0, 0, 10, 30, date("Y", strtotime("-1 Year"))));
	if ($today > $last_vac_end) {
		$school_ini = date("Y-m-d", mktime(0, 0, 0, 9, 1, date("Y")));
		$school_end = date("Y-m-d", mktime(0, 0, 0, 10, 30, date("Y")));
	} else {
		$school_ini = date("Y-m-d", mktime(0, 0, 0, 9, 1, ($thisyear-1)));
		$school_end = date("Y-m-d", mktime(0, 0, 0, 10, 30, date("Y", strtotime("-1 Year"))));
	}

	//poprzedni nowy rok szkolny
	$today = date("m-d");
	$last_school_end = date("m-d", mktime(0, 0, 0, 10, 30, date("Y", strtotime("-1 Year"))));
	if ($today > $last_vac_end) {
		$last_school_ini = date("Y-m-d", mktime(0, 0, 0, 9, 1, ($thisyear-1)));
		$last_school_end = date("Y-m-d", mktime(0, 0, 0, 10, 30, date("Y", strtotime("-1 Year"))));
	} else {
		$last_school_ini = date("Y-m-d", mktime(0, 0, 0, 9, 1, ($thisyear-2)));
		$last_school_end = date("Y-m-d", mktime(0, 0, 0, 10, 30, date("Y", strtotime("-2 Year"))));
	}


echo '<div class="container"><h1>Wybierz okres</h1>

		<div class="row">
		<p><small>Statystyki dla <strong>Nowy Rok, Wakacje, Nowy Rok Szkolny</strong>, jeżeli nie przekroczono kolejno dat <strong>28 luty, 31 sierpnia i 30 października.</strong> pokazują dane z roku poprzedniego, a przyciski dla lat <i>Poprzednich</i> dwa lata wstecz</small>.</p>
		<div class="col-sm-6 col-md-3 col-lg-2">
		<a href="index.php?details=monthlystats&fday='.date('Y-m-01').'&lday='.date('Y-m-t').'" class="btn btn-block btn-default">Aktualny miesiąc<br><small>ten miesiąć od 1-go</small></a>
		<a href="index.php?details=monthlystats&fday='.$month_ini.'&lday='.$month_end.'" class="btn btn-block btn-default">Poprzedni<br>miesiąc</a>
		</div>
		<div class="col-sm-6 col-md-3 col-lg-2">
		<a href="index.php?details=monthlystats&fday='.date('Y-01-01').'&lday='.date('Y-12-t').'" class="btn btn-block btn-default">Aktualny rok<br><small>od 1 stycznia do dziś</small></a>
		<a href="index.php?details=monthlystats&fday='.$year_ini.'&lday='.$year_end.'" class="btn btn-block btn-default">Poprzedni<br>rok</a>
		</div>
		<div class="col-sm-6 col-md-2 col-lg-2">
		<a href="index.php?details=monthlystats&fday='.$this_year_ini.'&lday='.$this_year_end.'" class="btn btn-block btn-default" title="wyświetla dane ze stycznia i lutego">Nowy Rok<br><small>styczeń i luty</small></a>
		<a href="index.php?details=monthlystats&fday='.$new_year_ini.'&lday='.$new_year_end.'" class="btn  btn-block btn-default" title="wyświetla dane ze stycznia i lutego">Poprzedni <br>Nowy Rok</a>
		</div>
		<div class="col-sm-6 col-md-2 col-lg-2">
		<a href="index.php?details=monthlystats&fday='.$vacation_ini.'&lday='.$vacation_end.'" class="btn  btn-block btn-default" title="Wyświetla informacje na rok wstecz jeżeli nie przekroczono daty 31 sierpnia">Wakacje<br><small>lipiec i sierpień</small></a>
		<a href="index.php?details=monthlystats&fday='.$last_vac_ini.'&lday='.$last_vac_end.'" class="btn  btn-block btn-default" title="Wyświetla informacje na dwa lata wstecz jeżeli nie przekroczono daty 31 sierpnia">Poprzednie<br>wakacje</a>
		</div>
		<div class="col-sm-6 col-md-2 col-lg-2">
		<a href="index.php?details=monthlystats&fday='.$school_ini.'&lday='.$school_end.'" class="btn   btn-block btn-default" title="wyświetla dane z września i pażdziernka">Nowy rok szkolny<br><small>wrzesień i październik</small></a>
		<a href="index.php?details=monthlystats&fday='.$last_school_ini.'&lday='.$last_school_end.'" class="btn  btn-block btn-default" data-toggle="tooltip" data-placement="left" title="Wyświetla informacje na dwa lata wstecz jeżeli nie przekroczono daty 30 października">Poprzedni<br>rok szkolny</a>
		</div>
		</div>
		';
echo '
	<h1>lub wybierz daty</h1>
	<form class="form-horizontal" role="form" action="index.php?details=monthlystats" method="post">
	<div class="form-group margin-top-20">
    	<label for="inputEmail1" class="col-lg-2 control-label">Data od</label>
    	<div class="col-lg-4" id="sandbox-container">
      		<input type="text" name="begindate" class="form-control" id="datepicker" placeholder="" value="" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Data do</label>
    	<div class="col-lg-4" id="sandbox-container">
      		<input type="text" name="finishdate" class="form-control" id="datepicker" placeholder="" value="" required >
    	</div>
  	</div>

	<input type="submit" class="btn btn-default btn-block btn-lg btn-primary" value="Wyświetl statystyki" />
</div>
</form></div>';
}
?>
