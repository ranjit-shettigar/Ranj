<?php
ob_start();
session_start(); 
// session_destroy();
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . "/userend/front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . "/userend/back");

defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", __DIR__ . "/uploads");

defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER", "root");

defined("DB_PASS") ? null : define("DB_PASS", "");

defined("DB_NAME") ? null : define("DB_NAME", "carou");


$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require_once("functions.php"); 
require_once("cart.php"); 

if(isset($_SESSION['name']) && !isset($_SESSION['email']))
{
	redirect("../public/logout");
}
// set_error_handler("customError");
?>