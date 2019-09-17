<?php 

echo '<h1>Order details of '.$_GET['id'].'</h1>';
?>

<br>

<?php display_message(); ?>

<div class="row">
	<div class="col-lg-5">
		<div class="card">
			<h5 class="card-header">Delivery Address:</h5>
			<?php show_address_in_admin(); ?>
		</div>
	</div>

	<div class="col-lg-7">
		<div class="table-responsive">
			<?php show_payment_details(); ?>
			
		</div>
	</div>
</div>