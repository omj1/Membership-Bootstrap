<?php
//error_reporting(1);
require_once 'konfiguracja.php';
require_once "teksty/kontakt.php";

function head() {
        global $szablon;
        global $title;
        global $description;
        global $keywords;
        echo '
        <title>'.$title.'</title>
        <meta name="description" content="'.$description.'" />
        <meta name="keywords" content="'.$keywords.'" />
        <meta name="author" content="Szybka Strona" />
        <meta charset="utf-8">
        <link rel="stylesheet" href="szablony/'.$szablon.'/css/reset-style.css" />
        <link rel="stylesheet" href="szablony/'.$szablon.'/css/style.css" />';
}

function tloBody() { //funcja wyswietla tlo strony ustawiane w konfiguracja.php poprzez admina
    global $backgroundimage;
    global $szablon;
    if($backgroundimage=='tak') {
    echo ('style="background-image:url(szablony/'.$szablon.'/images/tlo.jpg)"');
    }
}
function pokaz() { //funkcja wyswietla tresc strony
if ($_GET['details']=='') { //jezeli nie przekazano zmiennej - funkcja wyswietla tresc podstron
    listing ();
    }
elseif ($_GET['details']=='details') {
    details ();
    }
elseif ($_GET['details']=='doladuj') {
    doladuj ();
    }
elseif ($_GET['details']=='dodaj') {
    dodaj ();
    }
elseif ($_GET['details']=='insert-payment') {
    insertpayment ();
    }
elseif ($_GET['details']=='delete-payment') {
    deletepayment ();
    }
elseif ($_GET['details']=='insert-client') {
    insertclient ();
    }
elseif ($_GET['details']=='updatepayment') {
    updatepayment ();
    }
elseif ($_GET['details']=='insertupdatepayment') {
    insertupdatepayment ();
    }
elseif ($_GET['details']=='charts') {
    drawVisualization();
    drawVisualization2();
    }
elseif ($_GET['details']=='monthlystats') {
    monthlystats();
    }
elseif ($_GET['details']=='modify-client') {
    modifyclient();
    }
elseif ($_GET['details']=='delete-client') {
    deleteclient();
    }
else {
    details();
}
}
function listing() {
	echo '<div class="col-md-12"><div class="table-responsive">';
	echo '<table class="table table-hover tablesorter">';
	echo '<thead>';
	echo '<tr>';
	echo '<th class="hidden-xs">';
	echo 'Lp.';
	echo '</th>';
	echo '<th>';
	echo 'Imię';
	echo '</th>';
	echo '<th>';
	echo 'Nazwisko';
	echo '</th>';
	echo '<th class="hidden-xs">';
	echo 'Ważny od dnia';
	echo '</th>';
	echo '<th>';
	echo 'Ważny do dnia';
	echo '</th>';
	echo '<th class="hidden-xs text-right">';
	echo 'Kwota';
	echo '</th>';
	echo '<th class="text-center">';
	echo '';
	echo '</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	include "connect.php";
	$finish_date = stripslashes($wiersz['finish_date']);
	$today2 = date('Y-m-d');
	$enddate = date( "Y-m-d", strtotime('-14 Day', strtotime($today2)));
    /*$j=0;
	$ile_znalezionych=0;
    $sql="select id,name,lastname from members;";

	$wynik_klienci =  $db -> query ($sql);




	for($i=0;$i< mysqli_num_rows($wynik_klienci);$i++)
	{
		$r= $wynik_klienci->fetch_row() ;

		$sql="select begin_date,finish_date,price from payments where id=(SELECT max(id) FROM `payments` WHERE user_id=".$r[0]." order by finish_date asc )";
		# print $sql;
	    $wynik_platnosci = $db -> query ($sql);
        if(mysqli_num_rows($wynik_platnosci)>0)
		{


		  $r1=$wynik_platnosci->fetch_row() ;
		  $row_zad[$j]['name']=$r[1];
		  $row_zad[$j]['lastname']=$r[2];
		  $row_zad[$j]['begin_date']=$r1[0];
		  $row_zad[$j]['finish_date']=$r1[1];
  		  $row_zad[$j]['price']=$r1[2];
		  $ile_znalezionych++;
		  $j++;
		}
	}*/

	//$zapytanie = "SELECT members.id, members.name, members.lastname, payments.id, payments.user_id, payments.begin_date, payments.finish_date, payments.price FROM members, payments WHERE members.id=payments.user_id AND payments.finish_date>=CURDATE()  ORDER BY payments.finish_date ASC, payments.id ASC";*/
	$zapytanie = "SELECT members.id, members.name, members.lastname, begin_date, finish_date, user_id, price, payments.id FROM members JOIN (SELECT payments.id, payments.user_id,  payments.begin_date, MAX(payments.finish_date) AS finish_date, payments.price FROM payments GROUP BY payments.user_id) AS payments WHERE members.id=payments.user_id AND payments.finish_date>='$enddate' ORDER BY payments.finish_date ASC, payments.id ASC";
	$wynik = $db -> query ($zapytanie);
//	mysql_query("SET NAMES utf8");
    $db -> query ("SET NAMES utf8");
	$ile_znalezionych = mysqli_num_rows($wynik);

	$miejsce = 1;
    for($i=0; $i<$ile_znalezionych; $i++)
	{
	$wiersz = $wynik ->fetch_assoc();
	//$wiersz = $row_zad[$i];
	//print_r($wiersz);
	$finish_date = stripslashes($wiersz['finish_date']);
	$today = date('Y-m-d');
	$warning = date( "Y-m-d", strtotime('+1 Day', strtotime($today)));
	echo '<tr';
	if ($finish_date < $warning AND  $finish_date >= $today) {
	echo ' style="color:#e47600;cursor: pointer;" ';
	}
	if ($finish_date >= $enddate AND $finish_date < $today) {
	echo ' style="color:#ff0000;cursor: pointer;" ';
	}
	echo ' onClick="location.href=\'index.php?details=details&user_id='.$wiersz['user_id'].'\'" title="Zobacz historię płatności" style="cursor: pointer";>';
	//echo '<a href="index.php?details='.$wiersz['user_id'].'">';
	echo '<td class="hidden-xs">';
	echo $miejsce++;
	echo '</td>';
	echo '<td>';
	echo stripslashes($wiersz['name']);
	echo '</td>';
	echo '<td>';
	echo stripslashes($wiersz['lastname']);
	echo '</td>';
	echo '<td class="hidden-xs">';
	echo stripslashes($wiersz['begin_date']);
	echo '</td>';
	echo '<td>';
	echo stripslashes($wiersz['finish_date']);
	echo '</td>';
	echo '<td class="hidden-xs text-right">';
	echo stripslashes($wiersz['price']);
	echo '</td>';
	echo '<td class="text-center">';
	echo '<a href="index.php?details=doladuj&id='.stripslashes($wiersz['user_id']).'" title="Dodaj okres abonamentu"><i class="glyphicon glyphicon-plus" ></i></a>';
    if ($_SESSION['prawid_uzyt'] == 'admin') {
		echo '
	<a href="index.php?details=updatepayment&id='.stripslashes($wiersz['user_id']).'&payid='.stripslashes($wiersz['id']).'" title="Edytuj okres abonamentu"><i class="glyphicon glyphicon-edit"></i></a>
	';
    }
	echo '</td>';
	echo '</a>';
	echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';
	echo '</div></div>';
}

function details() {
	leftcolumndetail();
	include "connect.php";
	if ($_GET['details']=='details') { //jezeli nie przekazano zmiennej - funkcja wyswietla tresc podstron
    $userid = $_GET['user_id'];
    }
	if ($_GET['details']=='') {
    $userid = $_GET['id'];
    }
	$zapytanie = "SELECT members.id, members.name, members.lastname, members.email, members.phone, payments.id, payments.user_id, payments.begin_date, payments.finish_date, payments.price FROM members, payments WHERE payments.user_id=members.id AND payments.user_id = $userid";
	echo '<div class="col-md-8">';
	echo '<div class="table-responsive">';
	echo '<table class="table table-hover">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>';
	echo 'Ważny od';
	echo '</th>';
	echo '<th>';
	echo 'Ważny do';
	echo '</th>';
	echo '<th class="text-right">';
	echo 'Cena';
	echo '</th>';
	echo '<th class="text-right">Usuń</th>';
	echo '</tr>';
	echo '</thead>';
	$wynik = $db -> query ($zapytanie);
	$ile_znalezionych = mysqli_num_rows($wynik);
    for($i=0; $i<$ile_znalezionych; $i++)
	{
	$wiersz = $wynik ->fetch_assoc();
	echo '<tbody>';
	echo '<tr>';
	echo '<td>';
	echo stripslashes($wiersz['begin_date']);
	echo '</td>';
	echo '<td>';
	echo stripslashes($wiersz['finish_date']);
	echo '</td>';
	echo '<td class="text-right">';
	echo stripslashes($wiersz['price']);
	echo '</td>';
	echo '<td class="text-right">';
	echo '<a href="index.php?details=delete-payment&id='.stripslashes($wiersz['id']).'&user_id='.stripslashes($wiersz['user_id']).'" title=""Edytuj okres abonamentu"><i class="glyphicon glyphicon-minus"></i></a>
	';
	echo '</td>';
	echo '</tr>';
	echo '</tbody>';
	}
	echo '</table>';
	echo '<a href="index.php?details=doladuj&id='.$userid.'">';
	echo '<button type="button" class="btn btn-default btn-block btn-lg btn-primary" style="margin-bottom:100px;">Dodaj okres abonamentu</button>';
	echo '</a>';
	echo '</div>';
	echo '</div>';
}
function listing_date() {
	$today = date("d.m.y");
	echo $today;
}
function showmonth() {
	echo '<h1 class="month">';
	$miesiac = date("m");
	if ($miesiac == "01") $miesiac = "Styczeń";
	if ($miesiac == "02") $miesiac = "Luty";
	if ($miesiac == "03") $miesiac = "Marzec";
	if ($miesiac == "04") $miesiac = "Kwiecień";
	if ($miesiac == "05") $miesiac = "Maj";
	if ($miesiac == "06") $miesiac = "Czerwiec";
	if ($miesiac == "07") $miesiac = "Lipiec";
	if ($miesiac == "08") $miesiac = "Sierpień";
	if ($miesiac == "09") $miesiac = "Wrzesień";
	if ($miesiac == '10') $miesiac = "Październik";
	if ($miesiac == '11') $miesiac = "Listopad";
	if ($miesiac == '12') $miesiac = "Grudzień";
	echo ($miesiac);
	echo "</h1>";
}

function logo () {
    global $szablon;
    if(file_exists("szablony/".$szablon."/images/logo.png")) {
    echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/logo.png" height="50px"></a>'; }
    elseif(file_exists("szablony/".$szablon."/images/logo.jpg")) {
    echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/logo.jpg"></a>'; }
    elseif(file_exists("szablony/".$szablon."/images/logo.jpeg")) {
    echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/logo.jpeg"></a>'; }
    elseif(file_exists("szablony/".$szablon."/images/logo.gif")) {
    echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/logo.gif"></a>'; }
    else {echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/szybka-strona.png"></a>'; }

}

function dodaj() {
	$date= date('Y-m-d');
	$aftermonth = date( "Y-m-d", strtotime( '+1 Month', strtotime( $date ) ) );
	echo "<h2>Dodaj klienta</h2>";
	echo '
	<form class="form-horizontal" role="form" action="index.php?details=insert-client" method="post">

	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2  control-label">Imię</label>
    	<div class="col-lg-4">
      		<input type="text" name="name" class="form-control" id="inputEmail1" placeholder="Wpisz imię" required autofocus >
    	</div>
  	</div>
  	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Nazwisko</label>
    	<div class="col-lg-4">
      		<input type="text" name="lastname" class="form-control" id="inputEmail1"  placeholder="Wpisz nazwisko" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2  control-label">Email</label>
    	<div class="col-lg-4">
      		<input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Email">
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Telefon</label>
    	<div class="col-lg-4">
      		<input type="tel" class="form-control" name="phone" id="inputEmail1" placeholder="Wpisz telefon">
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Data od</label>
    	<div class="col-lg-4" id="sandbox-container">
      		<input type="text" name="begindate" class="form-control" id="datepicker" placeholder="'.$date.'" value="'.$date.'" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Data do</label>
    	<div class="col-lg-4" id="sandbox-container">
      		<input type="text" name="finishdate" class="form-control" id="datepicker" placeholder="'.$aftermonth.'" value="'.$aftermonth.'" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Kwota</label>
    	<div class="col-lg-4">
      		<input type="text" name="price" class="form-control" id="inputEmail1" placeholder="Wpisz kwotę" required >
    	</div>
  	</div>
	<input type="submit" class="btn btn-default btn-block btn-lg btn-primary" value="Dodaj klienta" />
</div>
</form>';
}

function leftcolumndetail() {
	include "connect.php";
	$id = $_GET['id'];
	if ($_GET['id']=='') {
	$id = $_GET['user_id'];
	}
	$zapytanie = "SELECT * FROM members WHERE id='$id'";
	$wynik = $db->query($zapytanie);
	$wiersz = $wynik->fetch_assoc();
	echo '<div class="col-md-4">';
	echo '<div>';
	echo '<table class="table">';
	echo '<tr>';
	echo '<td  colspan=2"><h1>';
	echo stripslashes($wiersz['name']);
	echo ' ';
	echo stripslashes($wiersz['lastname']);
	echo '</h1></td>';
	echo '</tr>';
	echo '<td>';
	echo stripslashes($wiersz['email']);
	echo '</td>';
	echo '<td>';
	echo stripslashes($wiersz['phone']);
	echo '</td>';
	echo '</tr>';
	echo '<tr><td colspan=2"><a href="index.php?details=delete-client&id='.stripslashes($wiersz['id']).'" title="Usuń klienta" ><i class="glyphicon glyphicon-minus"></i></a><a href="index.php?details=modify-client&id='.stripslashes($wiersz['id']).'" title="Edytuj dane klienta" style="float:right"><i class="glyphicon glyphicon-edit"></i></a></td></tr>';
	echo '</table>';
	echo '</div>';
	echo '</div>';
}
function doladuj() {
	leftcolumndetail();
	include "connect.php";
	$id = $_GET['id'];
	$user_id = $_GET['id'];
	$zapytanie2 = "SELECT * FROM payments WHERE user_id='$user_id'";
	$wynik2 = $db->query($zapytanie2);
	$wiersz2 = $wynik2->fetch_assoc();
	$finishdate = stripslashes($wiersz2['finish_date']);
	if  ($finishdate == '') {
	$date= date('Y-m-d');
	echo $date;
	}
	else {$date = $finishdate;}

	$data = stripslashes($wiersz2['finish_date']);
	$aftermonth = date( "Y-m-d", strtotime( '+1 Month', strtotime( $data ) ) );

	echo '<div class="col-md-8">';
	echo '<h2>Data wygaśnięcia ostatniej opłaty: '. stripslashes($wiersz2['finish_date']).'</h2>';
	echo '
	<form class="form-horizontal sandbox-form" id="sandbox" role="form" action="index.php?details=insert-payment&id='.$id.'" method="post">
	<input type="hidden" name="id" class="form-control" id="inputEmail1" value="'.$id.'">
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Data od</label>
    	<div class="col-lg-4" id="sandbox-container">
      		<input type="text" name="begindate" class="form-control" id="datepicker" value="'.$date.'" placeholder="'. stripslashes($wiersz2['finish_date']).'" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Data do</label>
    	<div class="col-lg-4 " id="sandbox-container">
      		<input type="text" name="finishdate" class="form-control " id="datepicker" value="'.$aftermonth.'" placeholder="Wybierz datę" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Kwota</label>
    	<div class="col-lg-4">
      		<input type="text" name="price" class="form-control" id="inputEmail1" value="'. stripslashes($wiersz2['price']).'" placeholder="Wpisz kwotę" required >
    	</div>
  	</div>
	<input type="submit" class="btn btn-default btn-block btn-lg btn-primary" value="Dodaj" />
</div>
</form>';
	echo '</div>';
	}
function deletepayment () {
	include "connect.php";
	$id = $_GET[id];
	$zapytanie = "SELECT * FROM payments WHERE id=$id";
	$wynik = $db -> query ($zapytanie);
	$wiersz = $wynik ->fetch_assoc();
	if ($_GET[ok] != '1') {
	echo '<div class="btn btn-danger btn-block btn-lg btn-primary">Usunąć płatność<br> od '.$wiersz['begin_date'].' do '.$wiersz['finish_date'].'?</div>';
	echo '<a class="btn btn-default btn-block btn-lg btn-primary" href="index.php?details=delete-payment&id='.stripslashes($wiersz['id']).'&user_id='.stripslashes($wiersz['user_id']).'&ok=1">Tak - usuń</a>';
	echo '<a class="btn btn-success btn-block btn-lg btn-primary" onClick="history.go(-1);">Nie - wróć</a>';
	}
	else {
	$id = $_GET[id];
	$zapytanie = "DELETE FROM payments WHERE id=$id";
	$wynik = $db -> query ($zapytanie);
	echo '<a class="btn btn-default btn-block btn-lg btn-primary" href="index.php?details=details&user_id='.stripslashes($wiersz['user_id']).'">płatność została usunięta<br>wróć do użytkownika</a>';
	}
}
function deleteclient () {
	include "connect.php";
	$id = $_GET[id];
	$zapytanie = "SELECT * FROM members WHERE id=$id";
	$wynik = $db -> query ($zapytanie);
	$wiersz = $wynik ->fetch_assoc();
	if ($_GET[ok] != '1') {
	echo '<div class="btn btn-danger btn-block btn-lg btn-primary">Usunąć klienta<br> '.$wiersz['name'].' '.$wiersz['lastname'].'?</div>';
	echo '<a class="btn btn-default btn-block btn-lg btn-primary" href="index.php?details=delete-client&id='.stripslashes($wiersz['id']).'&user_id='.stripslashes($wiersz['user_id']).'&ok=1">Tak - usuń</a>';
	echo '<a class="btn btn-success btn-block btn-lg btn-primary" onClick="history.go(-1);">Nie - wróć</a>';
	}
	else {
	$id = $_GET[id];
	$zapytanie = "DELETE FROM members WHERE id=$id";
	$wynik = $db -> query ($zapytanie);
	echo '<a class="btn btn-default btn-block btn-lg btn-primary" href="index.php">Klient został<br>usunięty</a>';
	}
}
?>
