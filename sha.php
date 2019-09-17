<?php 
$str = "yoo";
$salt = "";
if (CRYPT_SHA256 == 1)
{
	echo "SHA-256: ".crypt($str)."<br>"; 
}
else
{
	echo "SHA-256 not supported.<br>";
}

?>
