<?php require_once("C:/xampp/htdocs/carou/resources/config.php"); ?>
<?php set_error_handler("customError"); ?>
<?php 

if(isset($_SESSION['name']))
{
	redirect("index");
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
            <h5 class="card-title text-center">Register</h5>
            <?php display_message(); ?>

            <form class="form-signin" method="POST" enctype="multipart/form-data" action="register" novalidate>

              <?php send_otp(); ?>

              <div class="form-label-group">
                <input type="email" name="email" value="<?php if(isset($email)){echo $email;} ?>" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <?php empty_email_error(); email_format_invalid(); ?>
                <label for="inputEmail">Email address</label>
              </div>              

              <div style="padding-top: 30px;"><button class="btn btn-lg btn-facebook btn-block text-uppercase" name="submit" type="submit">Send OTP</button></div>


              
            <?php 

            if(isset($_SESSION['otpsent']))
            { ?>
            	<div style="padding-top: 30px;"><button type="button" class="btn btn-google btn-block text-uppercase" data-toggle="modal" data-target="#exampleModal">Enter OTP</button></div>

				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Enter the OTP received</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form action="register" method="POST">
				      <div class="modal-body">
				        
				        	<?php otp_check(); ?>
				          <div class="form-group">
				            <input type="text" class="form-control" name="otptext" id="recipient-name" placeholder="00000" maxlength="5" required>
				          </div>
				        
				      </div>
				      <div class="modal-footer">
				        <input type="submit" name="otpsubmit" class="btn btn-google btn-block text-uppercase" value="Submit">
				        <!-- <button type="button" class="btn btn-primary">Submit</button> -->
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
<?php		}

            ?>




              <div class="new-acc" style="padding-top: 13px; padding-bottom: 8px;"><span>Already have an account? <a href="login">Click here</a></span></div>

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