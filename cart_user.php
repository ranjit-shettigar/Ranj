<?php require_once("C:/xampp/htdocs/carou/resources/config.php"); ?>
<?php //set_error_handler("customError"); ?>
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
    <link rel="stylesheet" type="text/css" href="custom/cart_user.css">
  </head>
  <body>

     <!-- NAV -->
    <?php include(TEMPLATE_FRONT . "/topnav.php"); ?>   
    <!-- NAV -->



<br><br><br><br>
<!-- Page Content -->
<div class="container">


<!-- /.row --> 
<h1 style="text-align: center; font-family: Roboto;">Your Cart</h1>

<?php 
if(isset($_SESSION['message']))
{
  display_message();
}
else
{
  echo "<br><br>";
} 

?>



<div class="row">


<div class="col-lg-8">

    <div class="table-responsive">
    <table class="table table-hover">
        <thead>
          <tr>
           <!-- <th scope="col">#</th>  -->
           <th scope="col"></th> 
           <th scope="col">Product</th>
           
           <th scope="col">Price</th>
           <th scope="col">Quantity</th>
           <th scope="col">Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
          
          <?php @cart_user(); ?>
        
        </tbody>
    </table>  
    </div>

</div> 
<br>

<!--  ***********CART TOTALS*************-->
<div class="col-lg-1"></div>
<div style="float: right;" class="col-lg-3">
<!-- <h2>Cart Totals</h2> -->

<table class="table table-bordered" cellspacing="0">

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
// if(isset($_SESSION['item_total']))
// {
//   $order_total = $_SESSION['item_total'] + 40;
// }


if(isset($_SESSION['item_total']))
{
  if($_SESSION['item_quantity'] < 2)
  {
    $_SESSION['item_total'] = $_SESSION['item_total'] + 40;
    echo "&#8377; " . $_SESSION['item_total'];
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

<?php 
if(isset($_SESSION['item_quantity']))
{
  if($_SESSION['item_quantity'] > 0)
  {
    if(isset($_SESSION['name']))
    {
      if($quant <= 20)
      {
       ?><a href="checkout"><button class="btn btn-danger" type="button">Checkout</button></a><?php 
      }
      
    }
    else
    {
?>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
        Checkout
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Please login or signup before placing an order</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- <div class="modal-body">
              
            </div> -->
            <div class="modal-footer">
              <a href="login"><button type="button" class="btn btn-primary">Login</button></a>
              <a href="register"><button type="button" class="btn btn-danger">Signup</button></a>
            </div>
          </div>
        </div>
      </div>


<?php }
  }
} 
?>

</div> <!-- CART TOTALS -->


 </div><!--Main Content-->


    </div>
    <!-- /.container -->
  
<br><br><br><br><br>

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