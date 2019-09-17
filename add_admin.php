<h1>Add New Admin</h1>
<hr>



<div class="row">
	<div class="col-lg-12">	
		<p class="bg-success"><?php display_message(); ?></p>
		<form class="form-signin" method="POST" enctype="multipart/form-data" action="" novalidate>
              <?php //user_signup(); 
              admin_signup(); ?>

              <div class="form-label-group">
                <input type="text" name="firstname" value="<?php if(isset($firstname)){echo $firstname;} ?>" id="inputFirstname" class="form-control" placeholder="First Name" required autofocus>
                <?php empty_name_error(); invalid_name(); ?>
                <label for="inputFirstname">First Name</label>
              </div>

              <div class="form-label-group">
                <input type="text" name="lastname" value="<?php if(isset($lastname)){echo $lastname;} ?>" id="inputLastname" class="form-control" placeholder="Last Name" required autofocus>
                <?php empty_name_error(); invalid_name(); ?>
                <label for="inputLastname">Last Name</label>
              </div>

              <div class="form-label-group">
                <input type="email" name="email" value="<?php if(isset($email)){echo $email;} ?>" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <?php empty_email_error(); email_format_invalid(); ?>
                <label for="inputEmail">Email address</label>
              </div>
              <hr>

              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <?php empty_pwd_error(); pwd_whitesp_error() ?>
                <label for="inputPassword">Password</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="confirmpassword" id="inputConfirmPassword" class="form-control" placeholder="Password" required>
                <?php empty_pwd_error(); pwd_whitesp_error(); matchpwd(); ?>
                <label for="inputConfirmPassword">Confirm password</label>
              </div>

              <div style="padding-top: 30px;"><button class="btn btn-danger" name="submit" type="submit">ADD</button></div>

              <hr class="my-4">
              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
            </form>

	</div>
</div>