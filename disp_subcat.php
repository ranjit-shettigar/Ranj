<?php 

global $connection;
$query = mysqli_query($connection, "SELECT * FROM categories WHERE cat_id = " . $_GET['cat'] . " ");

while($row = mysqli_fetch_array($query))
{
	$cat_title = $row['cat_title'];
}
?>

<h1>Enter Sub Category for <?php echo $cat_title; ?></h1>
<hr>

<p class="bg-success"><?php display_message(); ?></p>
<form action="" method="post">

	<div class="form-group">
		<label for="exampleFormControlSelect2">Enter the sub-category</label>
		<input name="subcat_title" id="exampleFormControlSelect2" type="text" class="form-control">
	</div>

	<div class="form-group"> 
		<input name="add_category" type="submit" class="btn btn-primary" value="Add Category">
	</div> 

</form>


<?php add_subcat(); ?>