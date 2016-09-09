<?php
function insertpayment () {
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
$id=$_POST['id'];
$begindate=$_POST['begindate'];
$finishdate=$_POST['finishdate'];
$price=$_POST['price'];
$query = "INSERT INTO payments VALUES ('','$id','$begindate','$finishdate','$price', '', '', '$addedby', '$dayofadd')";
mysqli_query($db, $query);
echo '<div class="col-md-8">';
echo "<h2>Klientowi dodano okres abonamentowy</h2>";
echo '<h2>od: '.$begindate.' do '.$finishdate.'</h3>';
echo '<h2>w cenie: '.$price.' zł</h3>';
echo '<a href="index.php?details=details&user_id='.$id.'" class="btn btn-default btn-block btn-lg btn-primary">Zobacz szczegóły płatności klienta</a>';
echo '</div>';
  
  //mysql_close();
}

?>