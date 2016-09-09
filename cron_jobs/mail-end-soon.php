<?php
include "../connect.php";
	$data= date('Y-m-d');
	$aftermonth = date( "Y-m-d", strtotime('+2 Day', strtotime($data)));
	echo 'day: '.$aftermonth;
$zapytanie = "SELECT members.id, members.name, members.email, members.lastname, payments.id, payments.user_id, payments.begin_date, payments.finish_date, payments.price FROM members, payments WHERE members.id=payments.user_id AND payments.finish_date='$aftermonth' ORDER BY payments.finish_date DESC limit 50";
	$wynik = $db -> query ($zapytanie);
	$ile_znalezionych = mysqli_num_rows($wynik);
	$miejsce = 1;
    for($i=0; $i<$ile_znalezionych; $i++)
	{
	$wiersz = $wynik ->fetch_assoc();
	
	echo stripslashes($wiersz['name']);
	echo stripslashes($wiersz['lastname']);
	echo stripslashes($wiersz['email']);
	echo stripslashes($wiersz['finish_date']);
	#seven days before
	$data = stripslashes($wiersz['finish_date']);
	$name = stripslashes($wiersz['name']);
	$lastname = stripslashes($wiersz['lastname']);
	$email = stripslashes($wiersz['email']);
	if ($email == '') {
	$email = 'biuro@body-center.pl';
	}
	$date = stripslashes($wiersz['finish_date']);
	// subject
	$subject = 'Body Center - Koniec abonametu: '.$name.' '.$lastname.'';
	// message
	$message = '
	<html>
<head>
  <title>Przypomnienie o kończącym się abonamencie.</title>
</head>
<body>
<table style="width:700px;margin: 0 auto;cell-padding:10px;">
<tr>
<td style="background:#7f7f7f;color:white;font-weight:500;font-size:22px;padding: 10px 10px;font-family:Verdana;">
  <p>Witam, Drogi Kliencie: '.$name.' '.$lastname.',</p>
</td></tr>
<tr><td style="font-size:14px;padding: 10px 10px;font-family:Verdana;">
  <p style="text-indent:50px;">Z dniem '.$date.' kończy Ci się abonament na korzystanie z siłowni Body Center.<br />Jeśli chciałbyś nadal korzystać z naszych usług, prosimy o dokonanie płatności na kolejny okres przed upływem podanej wyżej daty ważności.</p>
  <p>Aktualny cennik można znaleźć na naszej stronie: <a href="http://www.body-center.pl">www.body-center.pl</a></p>
<p>
Pozdrawiam serdecznie / Regards<br>
Tadeusz Wrocławski</p>
<hr style="border-bottom: 1px dotted #f5f5f5;width: 50%;" />
<p style="float:left;">
<img alt="Body Center Logo" src="data:image/jpeg;base64,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"><br>
Body Center<br>
ul. Czubińska 17<br>
05-822 Milanówek<br>
</p><p style="float:right;text-align:right;">
kom./mobile: +48 501 55 73 77<br>
tel./phone: +48 22 724 70 51<br>
<a href="http://body-center.pl"><font color="gray">www.body-center.pl</font></a><br>
<a href="mailto:biuro@body-center.pl"><font color="gray">biuro@body-center.pl</font></a><br>
</p>
</td></tr></table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
// More headers
 $headers .= 'From: Body Center <biuro@body-center.pl>' . "\r\n";
 //$headers .= 'Bcc: biuro@body-center.pl' . "\r\n";

// Mail it
$allertemail = "biuro@body-center.pl";
mail($allertemail, $subject, $message, $headers);
echo 'wysłano maile do: '.$email;
	}
?>