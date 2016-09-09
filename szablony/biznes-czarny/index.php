<!DOCTYPE html>    
<head>
        <title>Szybka Strona</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="szablony/<?php echo $szablon; ?>/css/style.css" />
<!--[if IE]>
<script src="html5.js" type="text/javascript"></script>
<![endif]-->
    </head>
    <body>
        <nav>
        <?php menu(); ?>
        </nav>
        <hr>
        <article>
        <?php pokaz(); ?>
        </article>
    </body>
</html>