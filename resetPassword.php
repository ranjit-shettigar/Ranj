<?php require_once("C:/xampp/htdocs/carou/resources/config.php"); ?>
<?php 

if(isset($_SESSION['name']))
{
	redirect("index");
}
if(!isset($_SESSION['resetkey']) || !isset($_SESSION['resetemail']))
{
  redirect("login");
}

?>
<!DOCTYPE html>
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
  <link rel="stylesheet" type="text/css" href="custom/signup.css">
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
  
  <!-- NAV -->
  <?php include(TEMPLATE_FRONT . "/topnav.php"); ?>   
  <!-- NAV -->

  <div class="container">
    <div class="row">

      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5 login-card">
          <div class="card-body">
            <h5 class="card-title text-center">Reset Password</h5>
            <?php display_message(); ?>

            <form class="form-signin" method="POST" enctype="multipart/form-data" action="resetPassword?email=<?php echo $_SESSION['resetemail']; ?>&key=<?php echo $_SESSION['resetkey']; ?>" novalidate>

              <?php reset_password(); ?>

              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <?php empty_pwd_error(); pwd_whitesp_error() ?>
                <label for="inputPassword">New Password</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="confirmpassword" id="inputConfirmPassword" class="form-control" placeholder="Password" required>
                <?php empty_pwd_error(); pwd_whitesp_error(); matchpwd(); ?>
                <label for="inputConfirmPassword">Confirm New password</label>
              </div>            

              <div style="padding-top: 30px;"><button class="btn btn-lg btn-facebook btn-block text-uppercase" name="submit" type="submit">Reset Password</button></div>

              <hr class="my-4">

           
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php include(TEMPLATE_FRONT . "/footer.php") ?>

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