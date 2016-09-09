<?php
if(isset($_POST['iduzytkownika']) && isset($_POST['haslo'])) {
  include "connect.php";
  // jezeli uzytkownik wlasnie podjal próbe zalogowania
  $iduzytkownika = $_POST['iduzytkownika'];
  $haslo = $_POST['haslo'];
  $zapytanie = 'select * from admins '
  ."where login='$iduzytkownika' "
  ." and password=sha1('$haslo')";

  $wynik = $db -> query ($zapytanie);
  if($wynik->num_rows > 0)
  {
    // jeżeli dane sż w bazie zarejestrowanie identyfikatora użytkownika
    $_SESSION['prawid_uzyt'] = $iduzytkownika;
  }
  //$bd->close();
}
function loginInfo () {
  if(isset($_SESSION['prawid_uzyt']))
  {
    echo '<blockquote>Zalogowany jako: '.$_SESSION['prawid_uzyt'].'<br />';
    echo '<a href="index.php?p=wyloguj"><button type="button" class="btn btn-default btn-block btn-lg btn-primary">Wylogowanie</button></a></blockquote>';
  }
  else
  {
    if(isset($iduzytkownika))
    {
      // jeżeli próba logowania byla nieudana
      echo '<div class="col-md-12"><h2>Zalogowanie niemożliwe.</h2></div>';
    }
    else
    {
      // nie by³o próby logowania lub nast¹pi³o wylogowanie
      echo '<div class="col-md-12"><h2>Użytkownik niezalogowany</h2></div>';
    }

    // tworzenie formularza logowania
    echo $_SESSION['prawid_uzyt'];
    echo '<div class="col-md-12">
    <form class="form-horizontal" role="form" action="index.php" method="post">
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Login</label>
    <div class="col-lg-4">
    <input type="text" name="iduzytkownika" class="form-control" id="inputEmail1" value="" placeholder="login" required autofocus>
    </div>
    </div>
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Haslo</label>
    <div class="col-lg-4">
    <input type="password" name="haslo" value="" class="form-control" id="inputEmail1" placeholder="pass" required >
    </div>
    </div>
    <input type="submit" class="btn btn-default btn-block btn-lg btn-primary" value="Zaloguj" />
    </div>
    </form></div>';
  }
}


function logout () {
  if($_GET['p']=='wyloguj') {
    $stary_uzyt=$_SESSION['prawid_uzyt']; // przechowanie do sprawdzenie czy logowanie nast¹pi³o
    unset($_SESSION['prawid_uzyt']);
    session_destroy();
    if (!empty($stary_uzyt))
    {
      echo '<blockquote>Wylogowano.<br /></blockquote>';
      header("Location: index.php");
    }
    else
    {
      // je¿eli brak zalogowania, lecz w jakiœ sposób uzyskany dostêp do strony
      echo 'Użytkownik niezalogowany, tak więc brak wylogowania.<br />';
    }
  }
}
