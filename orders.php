<h1>Orders</h1><br>
<?php display_message(); ?>



<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Title ( x Quantity )</th>
				<!-- <th scope="col">Quantity</th> -->
				<th scope="col">Time/Date</th>
				<th scope="col">Order Total</th>
				<th scope="col">Transaction</th>
				<th scope="col">Status</th>
			</tr>
		</thead>

			<?php view_orders(); ?>
	</table>
	
</div>