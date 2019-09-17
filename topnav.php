<header>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark navbar-top" style="right: 0; max-width: 100%;">
    <a class="navbar-brand zoom-3 navbar-brand-top" href="index"><img src="images/top-logo.png" height="70" width="70" ></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item-top">
          <a class="nav-link active" href="index">Home</a>
        </li>
      
        <div class="dropdown">
            <div type="link" class="nav-item-top nav-link dropdown-toggle" id="dropdownMenuButtonItem" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</div>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonItem"><?php get_categories(); ?></div>
        </div>

        <li class="nav-item-top">
          <a class="nav-link" href="#map">Contact</a>
        </li>

        <li class="nav-item-top">
          <a class="nav-link" href="">About</a>
        </li>
        <li>
        
        </li>
        </ul>
        <span class="mt-2 mt-md-0">

          <div class="nav-item-top dropdown top-nav-icons">
            <img class="dropdown-toggle zoom" id="dropdownMenuButton" src="images/user.png" width="30" height=30" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <label style="color: #d5cece;" for="dropdownMenuButton">&nbsp;<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}else{echo "Guest User";} ?></label>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <?php checkif_user_loggedin(); ?>
            </div>
          </div>

        </span>
      <div class="nav-item-top top-nav-icons cart-icon" style="padding-right: 1rem;">
        <a href="cart_user"><img class="zoom" src="images/shopping-cart.png" width="30" height=30"></a>
      </div>
      
    </div>
  </nav>
</header>

  <!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="logout">Logout</a>
      </div>
    </div>
  </div>
</div>



<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

<div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Title</th>
            <th scope="col">Order Placed at</th>
            <th scope="col">Order Status</th>
            <th scope="col">Order Total</th>
          </tr>
        </thead>
        <?php my_orders(); ?>
      </table>
</div>
      <?php if(isset($_SESSION['mesage_to_display_no_orders'])) { echo "<div class='alert alert-danger' role='alert'>{$_SESSION['mesage_to_display_no_orders']}
</div>"; unset($_SESSION['mesage_to_display_no_orders']); } ?>
      </div>

      <div class="modal-footer">
      	<?php 

      	if(isset($_SESSION['receipt_access']))
      	{
      		echo "<button type='button' class='btn btn-danger' data-toggle='modal' data-dismiss='modal' data-target='#exampleModalCenter2'>View Receipt</button>";
      	}
      	unset($_SESSION['receipt_access']);
      	?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal modal fade" id="exampleModalOrderHistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-receipt modal-dialog-centered" role="document">
    <div class="modal-content modal-history">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Order History</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="table-responsive"> 
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Title ( x Quantity )</th>
            <th scope="col">Order Placed on</th>
            <th scope="col">Price</th>
            <th scope="col">Order Total</th>
            <th scope="col">Order Status</th>
          </tr>
        </thead>
        <?php order_history(); ?>
      </table>
</div>
      <?php if(isset($_SESSION['mesage_to_display_no_orders'])) { echo "<div class='alert alert-danger' role='alert'>{$_SESSION['mesage_to_display_no_orders']}
</div>"; unset($_SESSION['mesage_to_display_no_orders']); } ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-receipt modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><img src="images/top-logo.png" width="50" height="50"></h5>
        <span class="order-date"><?php if(isset($_SESSION['order_date'])) { echo $_SESSION['order_date']; } ?></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Order ID</th>
              <th scope="col"></th>
              <th scope="col">Title</th>
              <th scope="col">Price</th>
              <th scope="col">Sub-Total</th>
            </tr>
          </thead>
          <tbody>
          

            <?php view_receipt(); ?>

            <?php 

            if(isset($_SESSION['shipping']))
            {
            	echo "
            	<tr>
				<th scope='row'>Shipping & Handling:</th>
				<td></td>
				<td></td>
				<td></td>
            	<td>&#8377; {$_SESSION['shipping']}</td></tr>";
            }
            unset($_SESSION['shipping']);
            ?>

            <tr>
              <th scope="row">Total:</th>
              <td></td>
              <td></td>
              <td></td>
              <td><?php echo "&#8377; " . $_SESSION['receipt_order_total']; unset($_SESSION['receipt_order_total']); ?></td>
            </tr>

            
          </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
