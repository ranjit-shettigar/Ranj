<?php require_once("../../config.php");


if(isset($_GET['catid'])) 
{
	$query = mysqli_query($connection, "DELETE products, categories FROM categories INNER JOIN products WHERE categories.cat_id = products.cat_id AND products.cat_id = " . $_GET['catid'] . " ");
	if($query == 1) 
	{
		$query2 = mysqli_query($connection, "DELETE FROM categories WHERE categories.cat_id = " . $_GET['catid'] . " ");
	}

		set_message("SUB-CATEGORY DELETED");

	redirect("../../../public/admin2/index.php?categories");
	// echo $query . "SQL error" . mysqli_error($connection);
}

if(isset($_GET['id'])) 
{
	$query = mysqli_query($connection, "DELETE products, categories FROM categories INNER JOIN products WHERE categories.cat_id = products.cat_id AND products.parent_id = " . $_GET['id'] . " ");	
	if($query == 1) 
	{
		$query2 = mysqli_query($connection, "DELETE FROM categories WHERE categories.cat_id = " . $_GET['id'] . " ");
		$query2 = mysqli_query($connection, "DELETE FROM categories WHERE categories.parent_id = " . $_GET['id'] . " ");
	}

		set_message("CATEGORY DELETED");

	redirect("../../../public/admin2/index.php?categories");
	// echo $query . "SQL error" . mysqli_error($connection);
}




 ?>