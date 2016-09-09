<!DOCTYPE html>  
<?php
error_reporting(0);
//session_start(); //sesje, do logowania
//ob_start();  //emulacja headerow
?>
<meta name="viewport" content="width=device-width">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<!-- Load CSS -->
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<!-- Load Fonts -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold" type="text/css" />
	<!-- Load jQuery library -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!-- Load custom js -->
	<script type="text/javascript" src="scripts/custom.js"></script>
<head>
        <?php head(); ?>
<script src="ajax.js" type="text/javascript"></script>   
<!--[if IE]>
<script src="html5.js" type="text/javascript"></script>
<![endif]-->
    </head>
    <body <?php tloBody(); ?>>
        
            <header>
                <div id="header-inner">
                    <div id="logo">
                       <?php logo (); ?>
                    </div>
                    
                        <?php menu(); ?>
                 
                </div>
            </header>

            <article>
                <div id="article-inner">
                
				<?php
				
				include "search.html";
				
				pokaz();
				
				 ?>
                
                </div>
            </article>
            <footer>
                <div id="footer-inner">
               <?php //stopka(); ?>
               stopka index.php w folderze szablon
                </div>
            </footer>
        
    </body>
</html>