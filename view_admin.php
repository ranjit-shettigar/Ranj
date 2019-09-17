<h1>Admins</h1>
<!-- <hr> --><br>

<div class="row">
	<div class="col-lg-12">
		<p class="bg-success"><?php display_message(); ?></p>
		<table class="table">
		  <thead>
		    <tr>
				<th scope="col">Admin ID</th>
				<th scope="col">First Name</th>
				<th scope="col">Last Name</th>
				<th scope="col">Email</th>

				<th scope="col">Remove Admin</th>
		    </tr>
	  	</thead>
	  	<tbody>
			
		  	<?php get_admins(); ?>
		</tbody>
		</table>

	</div>
</div>