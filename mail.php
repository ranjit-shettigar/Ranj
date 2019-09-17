<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 


	ini_set("sendmail_from","kaushik.bantval98@gmail.com");
ini_set("force_sender","kaushik.bantval98@gmail.com");
	$header = "From: kaushik.bantval98@gmail.com";
	ini_set("SMTP","ssl://smtp.gmail.com");
	ini_set("smtp_port","465");
	ini_set("auth_username","kaushik.bantval98@gmail.com");
	ini_set("auth_password","");
	$test = mail("carryminati13@gmail.com", "Subject", "test", $header);
	echo $test . "from mail test ssl";


 
// ini_set("sendmail_path", "C:\\xampp\sendmail\sendmail.exe -t"); 



 ?>
</body>
</html>






