<?php
function insertclient (){
 /* session_start();
  // sprawdzenie zmiennej sesji
  if(isset($_SESSION['login']))
  {
  	echo '<div id="opisy" class="link">';
  echo '<h1>Panel administracyjny dodawania stron</h1>';
    echo '<p>Użytkownik zalogowany jako '.$_SESSION['login'].'</p>';
  */
  include "connect.php";

$tabela='members';
$name=$_POST['name'];
$lastname=$_POST['lastname'];
$login='login';
$pass='pass';
$email=$_POST['email'];
$phone=$_POST['phone'];
$dayofadd= date('Y-m-d');
$addedby = $_SESSION['prawid_uzyt'];
$query = "INSERT INTO members VALUES ('','$login','$pass','$name','$lastname','$email','$phone', '$addedby', '$dayofadd', '', '')";
mysqli_query($db, $query);


include "connect.php";
$zapytanie = "SELECT id FROM members WHERE name='$name' and lastname='$lastname'";
$begindate=$_POST['begindate'];
$finishdate=$_POST['finishdate'];
$price=$_POST['price'];
$wynik = $db->query($zapytanie);
$wiersz = $wynik->fetch_assoc();
$user_id=stripslashes($wiersz['id']);
echo $user_id;
//echo $user_id;
$tabela2 = 'payments';
$query2 = "INSERT INTO `$tabela2` VALUES ('','$user_id','$begindate','$finishdate','$price', '', '', '$addedby', '$dayofadd')";
mysqli_query($db, $query2);
echo '<h1>Dodano klienta '.$name.' '.$lastname.'</h1>';
echo '<a href="index.php?details=details&user_id='.$user_id.'" class="btn btn-default btn-block btn-lg btn-primary">Zobacz szczegóły płatności klienta</a>';
}
?>