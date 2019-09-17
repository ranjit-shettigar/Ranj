<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5 login-card">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            

            <form class="form-signin" action="login" method="POST" enctype="multipart/form-data" novalidate>
              <?php //user_login(); 
                customer_login(); ?>
              <div class="form-label-group">
                <input type="email" name="email" value=" <?php if(isset($email)){echo $email;} ?> " id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                
                <?php empty_email_error(); email_format_invalid(); ?>
                
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <?php empty_pwd_error(); ?>
                <label for="inputPassword">Password</label>
              </div>

              <!-- <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              <br> -->

              <div style="padding-top: 9px;"><button class="btn btn-lg btn-google btn-block text-uppercase" name="submit" type="submit">Sign in</button></div>
              
              <?php global $wrong;
                    if (isset($wrong))
                    {
                      echo "<div class='wrong-msg'>{$wrong}</div>";
                    } ?>

              <div class="new-acc" style="padding-top: 13px; padding-bottom: 8px;"><span>Don't have an account? <a href="signup">Click here</a></span></div>
              <hr class="my-4">

              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button> -->
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>