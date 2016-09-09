<?php
function updatepayment() {
	
	leftcolumndetail();
	include "connect.php";
	$payid = $_GET['payid'];
	$userid = $_GET['id'];
	$zapytanie2 = "SELECT * FROM payments WHERE id=$payid";
	$wynik = $db -> query ($zapytanie2);
	$wiersz = $wynik ->fetch_assoc();
	
	echo '<div class="col-md-8">';
	echo '<h2>Edytujesz opłatę abonamentową.</h2>';
	echo '
	<form class="form-horizontal" role="form" action="index.php?details=insertupdatepayment&payid='.$payid.'&id='.$userid.'" method="post">
	<input type="hidden" name="id" class="form-control" id="inputEmail1" value="'.$payid.'">
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Data od</label>
    	<div class="col-lg-4" id="sandbox-container">
      		<input type="text" name="begindate" class="form-control" id="datepicker" value="'.stripslashes($wiersz['begin_date']).'" placeholder="'. stripslashes($wiersz['finish_date']).'" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Data do</label>
    	<div class="col-lg-4" id="sandbox-container">
      		<input type="text" name="finishdate" value="'.stripslashes($wiersz['finish_date']).'" class="form-control" id="datepicker" placeholder="Wybierz datę" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Kwota</label>
    	<div class="col-lg-4">
      		<input type="text" name="price" value="'.stripslashes($wiersz['price']).'" class="form-control text-right" id="inputEmail1" placeholder="Wpisz kwotę" required >
    	</div>
  	</div>
	<input type="submit" class="btn btn-default btn-block btn-lg btn-primary" value="Zapisz" />
</div>
</form>';
	echo '</div>';
	
}

function insertupdatepayment () {
 /* session_start();
  // sprawdzenie zmiennej sesji
  if(isset($_SESSION['login']))
  {
  	echo '<div id="opisy" class="link">';
  echo '<h1>Panel administracyjny dodawania stron</h1>';
    echo '<p>Użytkownik zalogowany jako '.$_SESSION['login'].'</p>';
  */
  leftcolumndetail();
  include "connect.php";
//$tabela=$_POST['zmienna_przeslana'];
$tabela='payments';
$id=$_GET['id'];
$user_id = $_GET['id'];
$begindate=$_POST['begindate'];
$finishdate=$_POST['finishdate'];
$payid = $_GET['payid'];
$price=$_POST['price'];
$modifydate= date('Y-m-d');
$moderator = $_SESSION['prawid_uzyt'];
$query = "UPDATE `$tabela` SET begin_date='$begindate', finish_date='$finishdate', price='$price', moderator='$moderator', modifydate='$modifydate' WHERE id='$payid'";
mysqli_query($db, $query);
echo '<div class="col-md-8">';
echo "<h2>Zmiana dat dla abonamentu</h2>";
echo '<h2>od: '.$begindate.' do '.$finishdate.'</h3>';
echo '<h2>w cenie: '.$price.' zł</h3>';
echo '<a href="index.php?details=details&user_id='.$user_id.'" class="btn btn-default btn-block btn-lg btn-primary">Zobacz szczegóły płatności klienta</a>';
echo '</div>';
  
  //mysql_close();
}

?>