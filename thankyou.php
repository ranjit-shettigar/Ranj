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
if(!isset($_SESSION['item_total']))
{
	redirect("index");
}

?>
<br><br><br><br>
<!-- Page Content -->
<div class="container">

<!-- /.row --> 
<?php 

if(isset($_SESSION['existing_order']))
{
	echo "<h1 style='text-align: center; font-family: Roboto;''>Thank you!</h1>";
	unset($_SESSION['existing_order']);
}

if(isset($_SESSION['cash_order_placed']))
{
	echo "<b>Order  placed. </b>" . "<br/>";
	unset($_SESSION['cash_order_placed']);
}
display_message();

	
?>

<br>

<!-- <a href="index"><h3 style="text-align: center; color: #5a5a5a;">Go back</h3></a> -->

<?php 

if(isset($_SESSION['paytm']))
{
	include("paytm/pgResponse.php");
	// unset($_SESSION['paytm']);
}
// echo $_SESSION['paytm'];
// echo $_SESSION['err_msg'];
if(isset($_SESSION['order_placed']) && !isset($_SESSION['paytm']))
{
	echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  View Orders
</button>';
// unset($_SESSION['order_placed']);

}
if(isset($_SESSION['order_placed']) && isset($_SESSION['paytm']))
{
?>


<!-- <a href="index"><button type="button" class="btn btn-dark">Ok</button></a> -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenterPaytm">
  View My orders
</button>

<div class="modal modal fade" id="exampleModalCenterPaytm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-receipt modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">My Orders</h5>
    	<span class="order-date"><?php to_display_date(); if(isset($_SESSION['order_date_for_orders'])) { echo $_SESSION['order_date_for_orders']; unset($_SESSION['order_date_for_orders']); } ?></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Title</th>
              <th scope="col">Order Placed at</th>
              <th scope="col">Order Status</th>
            </tr>
          </thead>
          <?php my_orders(); ?>
        </table>


        <?php if(isset($_SESSION['mesage_to_display_no_orders'])) { echo "<div class='alert alert-danger' role='alert'>{$_SESSION['mesage_to_display_no_orders']}
</div>"; unset($_SESSION['mesage_to_display_no_orders']); } ?>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
  unset($_SESSION['order_placed']);
	unset($_SESSION['paytm']);
}



function unset_values()
{
	foreach ($_SESSION as $name => $value) 
	{
	    if($value > 0)
	    {
	        if(substr($name, 0, 8) == "product_")
	        { 
	          // echo "name".$name;
	            $length = strlen($name - 10);
	            // echo "<br>length".$length;
	            $id = substr($name, 8, $length);
	            // echo "<br>id".$id;
	            global $connection;    
	            $query = "SELECT * FROM products WHERE product_id = " . $id . " ";
	            $run_query = mysqli_query($connection , $query);

	            while($row = mysqli_fetch_array($run_query))
	            {   
	            	unset($_SESSION['product_' . $id]);             
	            } 
	        }   
	    }
	}
	unset($_SESSION['item_total']);
	unset($_SESSION['item_quantity']);
	unset($_SESSION['total_quantity']);
}

@unset_values();



?>


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


<!-- // echo "amount".$_POST['amount']."<br>"; 

		// echo "quantity".$_POST['quantity']."<br>"; 

		// echo "total_quantity".$_POST['total_quantity']."<br>"; -->