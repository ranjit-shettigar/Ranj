<?php //add_product(); ?>
<div class="col-md-12">

<div class="row">
	<h1 class="page-header">  
		Select the category of the product that has to be added
	</h1>

</div>
               
<hr>

<form action="" method="POST">
	<?php sel_cat(); ?>
	<div class="col-md-8">

		<div class="form-group">
		<label for="exampleFormControlSelect1">Product Category</label>
		<select class="form-control" id="exampleFormControlSelect1" name="cat">
			<?php show_categories_add_product_page(); ?>
		</select>
		</div>
		<input type="submit" name="submit" value="Next" class="btn btn-primary">
		<!-- <button class="btn btn-primary" type="submit" name="submit">Next</button> -->

	</div><!--Main Content-->
    
</form>

</div>