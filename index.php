<?php
// /error_reporting(0);
error_reporting( error_reporting() & ~E_NOTICE );
session_set_cookie_params(3600,"/",$_SERVER['SERVER_NAME']); //calkowity czas trwania sesji 3600 s
session_start(); //sesje, do logowania
ob_start();  //emulacja headerow
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="GYMI system do rozliczania abonamentów">
  <meta name="author" content="Mariusz Ostrowski - katet.eu">
  <link rel="shortcut icon" href="docs-assets/ico/favicon.png">

  <title>Body Center - GYMI</title>
  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.css" rel="stylesheet">





  <!-- Load Fonts -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold" type="text/css" />
  <!-- Load jQuery library -->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

  <!-- Load custom js -->
  <script type="text/javascript" src="scripts/custom.js"></script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.6.2/html5shiv.js"></script>
  <script src="docs-assets/js/respond.min.js"></script>
  <![endif]-->
  <!-- Tablesorter: required for bootstrap -->
  <link rel="stylesheet" href="style/theme.bootstrap.css">
  <script src="js/jquery.tablesorter.js"></script>
  <script src="js/jquery.tablesorter.widgets.js"></script>

  <?php
  if ($_GET['details']=='') {
    echo'
    <!-- Tablesorter: optional
    <link rel="stylesheet" href="style/jquery.tablesorter.pager.css">
    <script src="js/jquery.tablesorter.pager.js"></script>
    <?php //include "js/funkcje-tablesorted.js"; ?>
    <script src="js/funkcje-tablesorted.js"></script>
    <script src="js/funkcje-tablesorted-2.js"></script> -->
    ';
  }
  ?>
  <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
  <!-- Load CSS -->
  <link href="style/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

  <!-- Wrap all page content here -->

  <?php

  require_once 'administrator/uwierz_glowny.php';
  require_once 'kontrolery/kontrolery.php';
  require_once 'kontrolery/menu.php';
  require_once 'kontrolery/insert-payment.php';
  require_once 'insert-client.php';
  require_once 'kontrolery/update-payment.php';
  require_once 'kontrolery/functions.php';
  require_once 'kontrolery/modify-client.php';
  require_once 'kontrolery/functions-charts.php';
  ?>
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><?php logo (); ?></a>
        <?php if(isset($_SESSION['prawid_uzyt']))
        {
          echo '
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>

          </div>
          <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">';
          menutop ();
        }
        echo '</ul>
        </div><!--/.nav-collapse -->';
        ?>
      </div>
    </div>

    <div class="container">
      <div class="row">

        <?php

        if(isset($_SESSION['prawid_uzyt']))
        {
          ?>



          <div class="col-md-2">
            <?php
            showmonth();
            logout ();
            ?>
          </div>
          <div class="col-md-6">
            <?php
            if ($_SESSION['prawid_uzyt'] == 'admin') {
              numberofmonthmembers();
              sumofthemonth ();
            }
            ?>
          </div>
          <div class="col-md-4">
            <?php	include "search.html"; ?>
          </div>
        </div>

        <?php pokaz(); ?>

        <?php
        ;
      }
      else {
        loginInfo ();
      }
      ?>

    </div><!-- /.container -->
  </div>
  <footer class="footer">
    <div class="container">
      <p class="text-muted credit" style="padding-top:15px;">&copy Body Center - Client Center - <a href="http://katet.eu">Mariusz Ostrowski</a> &copy <a href="http://katet.eu">katet.eu</a>.</p>
    </div>
  </footer><!-- /.footer -->

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="dist/js/bootstrap.min.js"></script>

  <!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script type="text/javascript">
  $(function(){
  var datepicker = $.fn.datepicker.noConflict();
  $.fn.bootstrapDP = datepicker;
});
</script>//-->
<!-- <script src="js/locales/bootstrap-datepicker.pl.js" charset="UTF-8"></script> -->
<script src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
$('#sandbox-container input').datepicker({
  todayHighlight: true,
  todayBtn: true,
  autoclose: true,
  language: "pl"
});
$(function(){
  var datepicker = $.fn.datepicker.noConflict();
  $.fn.bootstrapDP = datepicker;
});
</script>
</body>
</html>
