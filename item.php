<?php require_once("C:/xampp/htdocs/carou/resources/config.php") ?>


<!DOCTYPE html>
<html lang="en">
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

<!-- CUSTOM CSS --> 
<link rel="stylesheet" type="text/css" href="custom/custom.css">
<link rel="stylesheet" type="text/css" href="custom/item.css">
<style>
    

</style>

</head>
  <body>

    <!-- NAV -->
    <?php include(TEMPLATE_FRONT . "/topnav.php"); ?>   
    <!-- NAV -->

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- NAV -->
        <?php include(TEMPLATE_FRONT . "/sidenav.php"); ?>   
        <!-- NAV -->

        <?php item(); ?>

        <!-- /.col-lg-9 -->
        <div class="col-lg-3 border-left">
          <h2 class="my-4 cat-title rel-item-head">Related Items</h2>
          
          <?php related_items(); ?>

        </div>
        <!-- /.col-lg-3 -->
      </div>

    </div>
    <!-- /.container -->

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
