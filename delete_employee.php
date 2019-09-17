<?php require_once("../../config.php");


if(isset($_GET['id'])) 
{
	$query = mysqli_query($connection, "DELETE login, employees FROM login INNER JOIN employees WHERE login.email = employees.email AND employees.employeeid = " . $_GET['id'] . " ");

	set_message("EMPLOYEE DELETED");
	redirect("../../../public/admin2/index.php?view_employee");

}

?>