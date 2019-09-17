<?php require_once("C:/xampp/htdocs/carou/resources/config.php"); ?>

<?php 

if(!isset($_SESSION['name']))
{
    redirect("index");
}

if(!$_SESSION['item_quantity'] > 0)
{
  redirect("index");
}

?>
<?php insert_address(); ?>
<?php 

function for_order_confirm()
{
    $item_name = 1;
    $item_number = 1;
    $amount1 = 1;
    $quantity = 1;
    $item_quantity = 0;
    foreach ($_SESSION as $name => $value) 
    {
        if($value > 0)
        {
			if(substr($name, 0, 8) == "product_")
            { 
                $length = strlen($name - 10);
                $id = substr($name, 8, $length);
                global $connection;    
                $query = "SELECT * FROM products WHERE product_id = " . $id . " ";
                $run_query = mysqli_query($connection , $query);

                while($row = mysqli_fetch_array($run_query))
                {   
                    $item_quantity += $value;
                    // $_SESSION['product_title'] = $row['product_title'];
                    $sub_total = $row['product_price'] * $value;

					$total_sub_total = $total_sub_total + $sub_total;
					$_SESSION['confirm_order_total'] = $total_sub_total;
                    $try = <<<HERE
					<tbody>
		                <tr>
		                    <td class='td-img'><img class='cart-img' src="{$row['product_image']}" width='30' height='30'></td>
		                    <td>{$row['product_title']} ( x {$value} )</td>
		                    <td>&#8377; {$sub_total}</td>
		                </tr>
		           	</tbody>
HERE;
             	echo $try;
                } 
            }   
        }
    }           
}

function for_cod()
{
    $item_name = 1;
    $item_number = 1;
    $amount1 = 1;
    $quantity = 1;
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
                    // $sub = $row['product_price'] * $value;
                    
                    // $total += $sub;
                    // $_SESSION['item_total'] = $total; 
                    
                    
                    $item_quantity += $value;

                    // $_SESSION['item_quantity'] = $item_quantity;
                    // $qua = $_SESSION['item_quantity'];
                    // (int) $del = 0;
                    // if($_SESSION['item_quantity'] < 2)
                    // {
                    //     $del = 40;
                    // }
                    // else
                    // {
                    //     $del = 0;
                    // }
                    
                    // $converted_total = currency('INR','USD',$row['product_price'] + $del);
                    $_SESSION['product_quantity' . $item_number] = $value;
                    $_SESSION['total_quantity'] = $quantity;
                    $_SESSION['product_id' . $item_number] = $row['product_id'];
                    $try = <<<HERE

                    <input type='hidden' name='item_name{$item_name}' value='{$row['product_title']}'>
                    <input type='hidden' name='item_number{$item_number}' value='{$row['product_id']}'>
                    <input type='hidden' name='amount{$amount1}' value='{$row['product_price']}'>
                    <input type='hidden' name='quantity{$quantity}' value='{$value}'> 
                    <input type='hidden' name='total_quantity' value='{$quantity}'> 
                    <input type='hidden' name='item_quantity' value='{$item_quantity}'> 
HERE;
                    echo $try;

                    $item_name++;   
                    $item_number++;
                    $amount1++;   
                    $quantity++;                
                } 
            }   
        }
    }           
}

@for_cod();


?>
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
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <!-- Bootstrap core CSS -->
    <!-- <link href="css/bootstrap2.css" rel="stylesheet"> -->

    <link href="custom/carousel.css" rel="stylesheet">
    <!-- CUSTOM CSS --> 
    <link rel="stylesheet" type="text/css" href="custom/custom.css">
    <style>
    .plc-order
    {
      padding: 10px;
    }
    .plc-order-btn
    {
      padding-top: 39px;
    }
    .container
    {
      max-width: 1272px;
    }
    </style>
</head>
<body>

<!-- NAV -->
<?php include(TEMPLATE_FRONT . "/topnav.php"); ?>   
<!-- NAV -->


<br><br><br><br>
<!-- Page Content -->
<div class="container">

  <h1 style="text-align: center; font-family: Roboto;">Choose your payment method</h1>
  <br><br>

<?php //display_message(); ?>
<div class="row">
  <div class="col-lg-4">
    <div class="col-12">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Prepaid</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">COD</a>
      </div>
    </div>
    <div class="col-12">
      <div class="tab-content" id="v-pills-tabContent">
          <?php $order_total = $_SESSION['item_total']; 
          $order_total = sprintf('%0.2f', $order_total);?>
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">Pay Now (You will be redirected to PayTm Payment Gateway)<br> 


          <form method="post" action="paytm/pgRedirect.php">

              <input type="hidden" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
                name="ORDER_ID" autocomplete="off"
                value="<?php echo rand(200,99999999); ?>">
              <?php to_get_cust_id(); ?>
              <input type="hidden" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php echo $_SESSION['customerid']; unset($_SESSION['customerid']); ?>">

              <input type="hidden" id="EMAIL" tabindex="2" maxlength="20" size="20" name="EMAIL" autocomplete="off" value="<?php echo $_SESSION['email']; ?>">

              <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">

              <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12"
                size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
              
              <input type="hidden" title="TXN_AMOUNT" tabindex="10"
                type="text" name="TXN_AMOUNT"
                value="<?php echo $order_total ?>">        

            <?php 
			if(isset($_SESSION['item_quantity']))
			{
				if($_SESSION['item_quantity'] > 0 && $_SESSION['item_quantity'] <= 20)
				{
					echo '<div class="plc-order-btn"><input name="paytm" class="btn btn-dark plc-order" value="Place Order" type="submit" onclick=""></div>';
				}
			}
            ?>
              
          </form>

























          </div>
        

          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">Pay during delivery <br>


            <form action="place_order" method="post">

            <?php 
			if(isset($_SESSION['item_quantity']))
			{
				if($_SESSION['item_quantity'] > 0 && $_SESSION['item_quantity'] <= 20)
				{
					echo '<div class="plc-order-btn"><input type="submit" name="submit" value="Place Order" class="btn btn-dark plc-order"></div>';
				}
			}
            ?>

				<!-- Button trigger modal -->
				

				<!-- Modal -->
<!-- 				<div class="modal fade" id="exampleModalCenterforcod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalCenterTitle">Are you sure?</h5>
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
					        <?php //@for_order_confirm(); ?>
					        <?php //echo $_SESSION['confirm_order_total']; ?>
				      	</table>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        
				      </div>
				    </div>
				  </div>
				</div>
 -->



            </form>


          </div>


      </div>
      
    </div>
  </div>
  

  <div class="col-lg-4">
    <div class="card">
      <h5 class="card-header">Delivery Address:</h5>
      <?php show_address(); ?>

    </div>
  </div>

  <div class="col-lg-4">
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