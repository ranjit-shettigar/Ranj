<?php 
	
require_once("C:/xampp/htdocs/carou/resources/config.php");

// unset($_SESSION['name']);

session_destroy();

redirect("index");

?>