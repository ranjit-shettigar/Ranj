<?php require_once("../../resources/config.php");

if(isset($_GET['id'])) 
{	
	global $connection;
	$query2 = mysqli_query($connection, "DELETE FROM products WHERE product_id = " . $_GET['id'] . " ");

	set_message("PRODUCT DELETED");
	redirect("../../public/admin2/index.php?products");

}
else
{
	redirect("404.html");
}

?>