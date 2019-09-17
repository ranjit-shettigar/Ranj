<?php require_once("../../config.php");


if(isset($_GET['id'])) 
{
	$query0 = "SELECT * FROM login, admin WHERE admin.adminid = " . $_GET['id'] . " ";
	$res = mysqli_query($connection, $query0);
	while($row = mysqli_fetch_array($res))
	{
		$name = $row['first name'] . " " . $row['last name'];
		if($name == $_SESSION['adminname'])
		{
			set_message("You cannot remove your own account's access!");
			redirect("../../../public/admin2/index.php?view_admin");
		}
		else
		{
			$query = mysqli_query($connection, "DELETE login, admin FROM login INNER JOIN admin WHERE login.email = admin.email AND admin.adminid = " . $_GET['id'] . " ");
			set_message("ADMIN DELETED");
			redirect("../../../public/admin2/index.php?view_admin");
		}
	}



}

?>