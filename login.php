<?php require_once("C:/xampp/htdocs/carou/resources/config.php") ?>

<?php 

if(isset($_SESSION['name']))
{
	redirect("index");
}


?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="images/top-logo.png">
<title>Drnklab Online</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="custom/custom.css">
<link rel="stylesheet" type="text/css" href="custom/login.css">
<style type="text/css">
  .login-msg
  {
    padding-left: 26px;
    padding-right: 23px;
    color: #e96666;
  } 
  .wrong-msg
  {
    padding-left: 25px;
    color: #e96666;
    padding-top: 13px;
  }
</style>
</head>
<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<body>
<?php include(TEMPLATE_FRONT . "/topnav.php"); ?>

<?php include(TEMPLATE_FRONT . "/login.php"); ?>

  <!-- FOOTER -->
  <?php include(TEMPLATE_FRONT . "/footer.php"); ?>
  <!-- FOOTER -->

  <!-- BOOTSTRAP JS START-->
  <!-- JQUERY -->
  <script type="text/javascript" src="js/bootstrap.jquery.js"></script>
  <!-- POPPER -->
  <script type="text/javascript" src="js/bootstrap.popper.js"></script>
  <!-- JS -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- BOOSTRAP JS END -->



</body>

</html>