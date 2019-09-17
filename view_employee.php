<h1>Employees</h1>
<!-- <hr> --><br>



<div class="row">
	<div class="col-lg-12">
		<p class="bg-success"><?php display_message(); ?></p>
		<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">Employee ID</th>
		      <th scope="col">First Name</th>
		      <th scope="col">Last Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Remove Employee</th>
		    </tr>
	  	</thead>
	  	<tbody>
			
		  	<?php get_employees(); ?>
		</tbody>
		</table>

	</div>
</div>