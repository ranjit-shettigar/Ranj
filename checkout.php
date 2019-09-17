<?php require_once("C:/xampp/htdocs/carou/resources/config.php"); ?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/top-logo.png">
    <title>Drnklab Online</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- Bootstrap core CSS -->
    <!-- <link href="css/bootstrap2.css" rel="stylesheet"> -->

    <link href="custom/carousel.css" rel="stylesheet">
    <!-- CUSTOM CSS --> 
    <link rel="stylesheet" type="text/css" href="custom/custom.css">
    <style>
    </style>
  </head>
  <body>

     <!-- NAV -->
    <?php include(TEMPLATE_FRONT . "/topnav.php"); ?>   
    <!-- NAV -->
<?php 

if(!isset($_SESSION['name']))
{
    redirect("index");
}

?>
<br><br><br><br>
<!-- Page Content -->
<div class="container">

<?php 


?>
<!-- /.row --> 
<h1 style="text-align: center; font-family: Roboto;">Checkout</h1>

<br>

<div class="row">
<div class="col-lg-9">
  

<?php display_message(); ?>
<h4>Enter the Delivery Address :</h4><br>

<form method="POST" enctype="multipart/form-data" action="payment" class="needs-validation" novalidate>

	<?php 

	global $connection;
	$email = $_SESSION['email'];
	$query = "SELECT * FROM address WHERE address.email = '" . $email . "' ";
	$get_query = mysqli_query($connection , $query);

	if($row = mysqli_fetch_array($get_query))
	{

 	?>

	<div class="form-row">
	<div class="col-md-6 mb-3">
	  <label for="validationCustom01">Name</label>
	  <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="Name" value="<?php echo $_SESSION['name']; ?>" disabled required>
	  <div class="invalid-feedback">
	    Please provide your name.
	  </div>
	</div>

	<div class="col-md-6 mb-3">
	  <label for="validationCustom02">Address Line 1</label>
	  <input type="text" class="form-control" name="address1" id="validationCustom02" placeholder="Door no, Street .." value="<?php echo $row['address_1']; ?>" required>
	  <div class="invalid-feedback">
	    Please provide a valid address.
	  </div>
	</div>
	<div class="col-md-12 mb-3">
	  <label for="validationCustom02">Address Line 2</label>
	  <input type="text" class="form-control" name="address2" id="validationCustom02" placeholder="Block, City/Town .." value="<?php echo $row['address_2']; ?>" required>
	  <div class="invalid-feedback">
	    Please provide a valid address.
	  </div>
	</div>
	</div>
	<div class="form-row">

	  <input type="hidden" class="form-control" name="city" id="validationCustom03" value="Mangalore" placeholder="Mangalore" required>
	  


	  <input type="hidden" class="form-control" name="state" id="validationCustom04" value="Karnataka" placeholder="Karnataka" required>
	  


	<div class="col-md-4 mb-3">
	  <label for="validationCustom03">City</label>
	  <input type="text" class="form-control" id="validationCustom03" value="Mangalore" placeholder="Mangalore" disabled>
	  <div class="invalid-feedback">
	    Please provide a valid city.
	  </div>
	</div>
	<div class="col-md-4 mb-3">
	  <label for="validationCustom04">State</label>
	  <input type="text" class="form-control" id="validationCustom04" value="Karnataka" placeholder="Karnataka" disabled>
	  <div class="invalid-feedback">
	    Please provide a valid state.
	  </div>
	</div>

	<div class="col-md-4 mb-3">

    <div class="form-group">
      <label for="exampleFormControlSelect1">Zip</label>
      <select class="form-control" id="exampleFormControlSelect1" name="zip" required>
        <?php display_pincodes(); ?>
        <div class="invalid-feedback">
           Please provide a valid zip.
        </div>
      </select>
    </div>




<!-- 	  <label for="validationCustom05">Zip</label>
	  <input type="text" class="form-control" name="zip" id="validationCustom05" placeholder="Zip"  value="<?php echo $row['pin']; ?>" required>
	  <div class="invalid-feedback">
	    Please provide a valid zip.
	  </div> -->
	</div>
	</div>
	<div class="form-row">
  	<div class="col-lg-6 mb-3">
  	  <label for="validationCustom03">Phone Number</label>
      <div class="input-group-prepend">
        <div class="input-group-text">+91</div>
        <input type="number" class="form-control" name="contactnumber1" id="validationCustom03" placeholder="Contact Number" value="<?php echo $row['contact_number']; ?>" required>
      </div>
      
  	  <div class="invalid-feedback">
  	    Please provide a valid number.
  	  </div>
  	</div>

  	<div class="col-lg-6 mb-3">
  	  <label for="validationCustom03">Alternative Phone Number</label>
      <div class="input-group-prepend">
        <div class="input-group-text">+91</div>
        <input type="number" class="form-control" name="contactnumber2" id="validationCustom03" value="<?php echo $row['alternative_contact_number']; ?>" placeholder="Contact Number 2">
      </div>
  	  
  	  <div class="invalid-feedback">
  	    Please provide a valid number.
  	  </div>
  	</div>
	</div>
  
	<?php 

	}
	else
	{
		include("../resources/userend/front/address.php");
	}

	?>


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

</div>

<div class="col-lg-3" style="padding-top: 66px;">
  
  <table style="width: 300px;" class="table table-bordered" cellspacing="0">

<tbody><tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount">
<?php 
  if(isset($_SESSION['item_quantity']))
  {
    $quant = $_SESSION['item_quantity'];
    if($quant <= 20)
    {
      echo $quant;
      // unset($_SESSION['message']);
    }
    else
    {
      echo "<div class='alert alert-dark' role='alert'>Sorry, 20 is the order limit.</div>";
    }
    
  }
  else
  {
    echo "0";
  }

?>

</span></td>
</tr>
<?php 
if(isset($_SESSION['item_quantity']))
{
  if($_SESSION['item_quantity'] > 0)
  { ?>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>
<?php 

  if(isset($_SESSION['item_quantity']))
  {
    if($_SESSION['item_quantity'] > 1)
    {
      echo "Free shipping";
    }
    else
    {
      echo "&#8377; 40";
    }
  }

?>

</td>
</tr>
<?php
  }
} 
?>


<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">
<?php 
if(isset($_SESSION['item_total']))
{
  $order_total = $_SESSION['item_total'];
}


if(isset($_SESSION['item_total']))
{
  if($_SESSION['item_quantity'] < 2)
  {
    echo "&#8377; " . $order_total;
  }
  else
  {
    echo "&#8377; " . $_SESSION['item_total'];
  }
}
else
{
  echo "0";
}
?>

</span></strong> </td>
</tr>


</tbody>

</table>
<div style="text-align: center;">

<!-- <a href="cart_user"><button type="button" name="cancel" class="btn btn-dark">Cancel</button></a> -->
<?php
if(isset($_SESSION['item_quantity']))
{
  if($_SESSION['item_quantity'] > 0 && $_SESSION['item_quantity'] <= 20)
  {
    echo "<button type='submit' name='submit' class='btn btn-dark'>Continue</button>";
  }
}
check_if_order_processing();
?>
</form>



<!-- 
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="currency_code" value="USD">
  <input type="hidden" name="business" value="business2@aloysius.com">

<input type="image" name="upload"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online"> -->
    <!-- input type="submit" name="upload">paypal
    </form> -->







</div>


</div>
</div>

</div>
    <!-- /.container -->

<br><br><br><br><br><br>

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
    

</body>
</html>