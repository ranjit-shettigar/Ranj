<?php 

if(isset($_GET['prepping']) && isset($_GET['id']))
{
	$id = $_GET['id'];
	global $connection;
	$query = "UPDATE `orders` SET `order_status` = 'PREPARING' WHERE `order_id` = " . $id . " ";
	$res = mysqli_query($connection, $query);
	if($res == 1)
	{
		set_message("Order status of {$_GET['id']} changed.");
		redirect("index.php?orders");
	}
	else
	{
		set_message("Something went wrong. Order status of {$_GET['id']} could not be changed.");
		redirect("index.php?orders");
	}
}

if(isset($_GET['transit']) && isset($_GET['id']))
{
	global $connection;
	$query = "UPDATE `orders` SET `order_status` = 'TRANSIT' WHERE `orders`.`order_id` = " . $_GET['id'] . " ";
	$res = mysqli_query($connection, $query);
	// echo mysqli_error($connection);
	if($res == 1)
	{
		set_message("Order status of {$_GET['id']} changed.");
		redirect("index.php?orders");
	}
	else
	{
		set_message("Something went wrong. Order status of {$_GET['id']} could not be changed.");
		redirect("index.php?orders");
	}
}

if(isset($_GET['delivered']) && isset($_GET['id']))
{
	global $connection;
	$query = "UPDATE `orders` SET `order_status` = 'DELIVERED' WHERE `orders`.`order_id` = " . $_GET['id'] . " ";
	$res = mysqli_query($connection, $query);
	if($res == 1)
	{
		set_message("Order status of {$_GET['id']} changed.");
		redirect("index.php?orders");
	}
	else
	{
		set_message("Something went wrong. Order status of {$_GET['id']} could not be changed.");
		redirect("index.php?orders");
	}
}


?>