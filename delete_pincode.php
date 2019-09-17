<?php 
require_once("C:/xampp/htdocs/carou/resources/config.php");

if(isset($_GET['pin']))
{
	$pin = $_GET['pin'];
	global $connection;
	$query = "DELETE FROM pincodes WHERE available_pin_codes = '$pin' ";
	$res = mysqli_query($connection, $query);
	echo $res;
	if($res == 0)
	{
		set_message("Something went wrong! Pin code {$pin} could not be deleted.");
		redirect("../../../public/admin2/index.php?add_pincode");
	}
	else
	{
		set_message("Pin code {$pin} deleted.");
		redirect("../../../public/admin2/index.php?add_pincode");
	}
}

?>