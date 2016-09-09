<?php
function modifyclient() {
	include "connect.php";
	$id = $_GET['id'];
	$save = $_GET['save'];
	
if ($save == NULL) {
	$zapytanie = "SELECT * FROM members WHERE id='$id'";
	$wynik = $db->query($zapytanie);
	$wiersz = $wynik->fetch_assoc();
	echo '<h1>Edytujesz dane użytkownika '.stripslashes($wiersz['name']).' '.stripslashes($wiersz['lastname']).'</h1>';
	echo '
	<form class="form-horizontal" role="form" action="index.php?details=modify-client&save=ok&id='.stripslashes($wiersz['id']).'" method="post">
	<input type="hidden" name="id" class="form-control" id="inputEmail1" value="'.$id.'">
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Imię</label>
    	<div class="col-lg-4">
      		<input type="text" name="name" class="form-control" id="" value="'.stripslashes($wiersz['name']).'" placeholder="'. stripslashes($wiersz['name']).'" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Nazwisko</label>
    	<div class="col-lg-4">
      		<input type="text" name="lastname" class="form-control" id="" value="'.stripslashes($wiersz['lastname']).'" placeholder="'. stripslashes($wiersz['lastname']).'" required >
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Telefon</label>
    	<div class="col-lg-4">
      		<input type="text" name="phone" class="form-control" id="" value="'.stripslashes($wiersz['phone']).'" placeholder="'. stripslashes($wiersz['phone']).'">
    	</div>
  	</div>
	<div class="form-group">
    	<label for="inputEmail1" class="col-lg-2 control-label">Email</label>
    	<div class="col-lg-4">
      		<input type="email" name="email" class="form-control" id="" value="'.stripslashes($wiersz['email']).'" placeholder="'. stripslashes($wiersz['email']).'">
    	</div>
  	</div>
	<input type="submit" class="btn btn-default btn-block btn-lg btn-primary" value="Zapisz" />
</div>
</form>';
	}
else {
	include "connect.php";
	$tabela='members';
	$id=$_GET['id'];
	$user_id=$_GET['id'];
	$name=$_POST['name'];
	$lastname=$_POST['lastname'];
	$login='login';
	$pass='pass';
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$modifydate = date('Y-m-d');
	$moderator = $_SESSION['prawid_uzyt'];
	$query = "UPDATE `$tabela` SET name='$name', lastname='$lastname', email='$email', phone='$phone', modifyby='$moderator', modifydate='$modifydate' WHERE id='$id'";
mysqli_query($db, $query);
	echo '<h1>Dane zostały zaktualizowane</h1>';
	leftcolumndetail();
	echo '<div class="col-md-8"><a href="index.php?details=details&user_id='.$user_id.'" class="btn btn-default btn-block btn-lg btn-primary">Zobacz szczegóły płatności klienta</a></div>';
	}
}
?>