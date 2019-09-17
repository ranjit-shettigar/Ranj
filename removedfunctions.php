function user_signup()
// {
// 	if(isset($_POST['submit']))
// 	{
// 		global $wrong, $firstname, $lastname, $emptyemailerror, $emptypassworderror, $emailformaterror;
// 		global $email, $emptynameerror, $pwdwhitesperror, $matchpwd, $nameErr;		

// 		if(empty($_POST['firstname']))
// 		{
// 			$emptynameerror = "Name field cannot be empty!";
// 		}
// 		else
// 		{
// 			$firstnametest = clear_input($_POST['firstname']);
// 			if (!preg_match("/^[a-zA-Z]*$/",$firstnametest)) 
// 			{
// 			  	$nameErr = "Invalid name format!";
// 			}
// 			else
// 			{
// 				$firstname = clear_input($_POST['firstname']);
// 			}
// 		}

// 		if(empty($_POST['lastname']))
// 		{
// 			$emptynameerror = "Name field cannot be empty!";
// 		}
// 		else
// 		{
// 			$lastnametest = clear_input($_POST['lastname']);
// 			if (!preg_match("/^[a-zA-Z]*$/",$lastnametest)) 
// 			{
// 			  	$nameErr = "Invalid name format!";
// 			}
// 			else
// 			{
// 				$lastname = clear_input($_POST['lastname']);
// 			}
// 		}

// 		if(empty($_POST['email']))
// 		{
// 			$emptyemailerror = "E-mail field cannot be empty!";
// 		}
// 		else
// 		{
// 			$emailtest = clear_input($_POST['email']);
// 			if (!filter_var($emailtest, FILTER_VALIDATE_EMAIL)) 
// 			{
// 		  		$emailformaterror = "Invalid E-mail format";
// 			}
// 			else
// 			{
// 				$email = clear_input($_POST['email']);
// 			}
// 		}
		
// 		if(empty($_POST['password']))
// 		{
// 			$emptypassworderror = "Password field cannot be empty!";
// 		}
// 		else
// 		{
// 			$passwordtest = $_POST['password'];
// 			if($passwordtest == trim($passwordtest))
// 			{
// 				$password = $_POST['password'];
// 			}
// 			else
// 			{
// 				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
// 			}
// 		}
// 		if(empty($_POST['confirmpassword']))
// 		{
// 			$emptypassworderror = "Password field cannot be empty!";
// 		}
// 		else
// 		{
// 			$passwordtest2 = $_POST['confirmpassword'];
// 			if($passwordtest2 == trim($passwordtest2))
// 			{
// 				$confirmpassword = $_POST['confirmpassword'];
// 			}
// 			else
// 			{
// 				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
// 			}
// 		}

// 		if(isset($email) && isset($password) && isset($firstname) && isset($lastname) && isset($confirmpassword)) 
// 		{
// 			if($password == $confirmpassword)
// 			{
// 				global $connection;
// 				$query = "INSERT INTO `customers` (`first name`, `last name`, `email`, `password`) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$password}');";
// 				$send_query = mysqli_query($connection, $query);
				
// 				if($send_query)
// 				{
// 					global $connection;
// 					$query2 = "SELECT * FROM `	customers` WHERE email = '{$email}' AND password = '{$password}' ";
// 					$receive2 = mysqli_query($connection , $query2);
					
// 					while ($row = mysqli_fetch_array($receive2))	
// 					{
// 						$_SESSION['name'] = trim($row['first name']) . " " . trim($row['last name']);
// 					}
// 					if(isset($_SESSION['item_quantity']))
// 					{	
// 						redirect("cart_user");
// 					}
// 					else
// 					{
// 						redirect("index");
// 					}
// 				}
// 				else
// 				{
// 					set_message("This E-mail is already registered!");
// 					redirect("signup");
// 				}
// 			}	
// 			else
// 			{
// 				$matchpwd = "Password fields don't match!";
// 			}
// 		}
// 	}	
// }


function user_login()
{
	if(isset($_POST['submit']))
	{
		global $wrong;
		global $emptyemailerror;
		global $emptypassworderror;
		global $emailformaterror;
		global $email;

		if(empty($_POST['email']))
		{
			$emptyemailerror = "E-mail field cannot be empty!";
		}
		else
		{
			$emailtest = clear_input($_POST['email']);
			if (!filter_var($emailtest, FILTER_VALIDATE_EMAIL)) 
			{
		  		$emailformaterror = "Invalid E-mail format";
			}
			else
			{
				$email = clear_input($_POST['email']);
			}
		}

		if(empty($_POST['password']))
		{
			$emptypassworderror = "Password field cannot be empty!";
		}
		else
		{
			$password = $_POST['password'];
		}

		if(isset($email) && isset($password)) 
		{
			global $connection;
			$query = "SELECT * FROM customers WHERE email = '{$email}' AND password = '{$password}' ";
			$send_query = mysqli_query($connection, $query);
			if(mysqli_num_rows($send_query) == 0)
			{
				$wrong = "Your E-mail ID or password is wrong!";
			}
			else
			{
				while ($row = mysqli_fetch_array($send_query))
				{
					$_SESSION['name'] = trim($row['first name']) . " " . trim($row['last name']);
				}
				if(isset($_SESSION['item_quantity']))
				{
					redirect("cart_user");
				}
				else
				{
					redirect("index");
				}
			}
		}
	}
}
