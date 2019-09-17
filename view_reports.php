<h1>Report of <?php echo $_POST['fromdate']." to ".$_POST['todate']; ?></h1>
<hr>

<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Product Title ( x Quantity )</th>
				<th scope="col">Order Total</th>
				<th scope="col">Order Date/Time</th>
				<th scope="col">Transaction Type</th>
				<th scope="col">Email</th>
			</tr>
		</thead>

			<?php view_reports(); ?>
	</table>
	
</div>