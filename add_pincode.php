<h1>Pincodes</h1>
<hr>
<?php display_message(); ?>
<div class="row">
	<div class="col-lg-6">
		<h3>Add New Pin Code: </h3><br>
			<form action="index.php?add_pincode" method="POST">
				<?php add_pincode(); ?>
			  <div class="form-group">
			    <input type="text" name="pin" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter PinCode" required>
			  </div>
			  
			  <input type="submit" class="btn btn-primary" name="submit" value="Add"> 

			</form>
	</div>

	<div class="col-lg-6">	
		<h3>Available Pin Codes: </h3><br>
		<table class="table">
		  <thead>
		    <tr>
				<th scope="col">#</th>
				<th scope="col">Pin Codes</th>
				<th scope="col">Remove</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php view_pincodes_in_admin(); ?>
		  </tbody>
		</table>
	</div>
</div>
