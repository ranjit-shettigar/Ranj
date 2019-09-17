<?php 
// session_destroy();
//HELPER FUNCTIONS

function escape_string($string){

global $connection;

return mysqli_real_escape_string($connection, $string);


}

function confirm($result){

global $connection;

if(!$result) {

die("QUERY FAILED " . mysqli_error($connection));


	}


}


function fetch_array($result){

return mysqli_fetch_array($result);


}

function query($sql) {

global $connection;

return mysqli_query($connection, $sql);


}


function last_id(){

global $connection;

return mysqli_insert_id($connection);


}


// ***REQUIRED FOR THE URL ENCRYPTION ***//
function decode($num)
{
	foreach($_GET as $locnum => $num)
	{
		$_GET[$locnum] = base64_decode(urldecode($num));
	}
}

// ***REQUIRED FOR THE URL ENCRYPTION ***//

function get_subcat()	//TO DISPLAY SUB-CATEGORIES IN SIDE-NAV
{
	global $connection;
	global $locnum;
	if(isset($_GET['num']))
	{
		$query = "SELECT * FROM categories WHERE parent_id = " . $_GET['num'] . " ";	
		$send_query = mysqli_query($connection, $query);

		if(!$send_query == 0)
		{
			while ($row = mysqli_fetch_array($send_query)) 
			{
				echo "<a href='category?id=" . $row['cat_id'] . "&num=" . $_GET['num'] . "' class='list-group-item'>{$row['cat_title']}</a>";  //SUBCATEGORIES
			}
		}
		else
		{
			include("error.php");
		}
	}
}

function get_categories()	//TO DISPLAY PARENT CATEGORIES IN DROPDOWN OF MENU BUTTON
{
	global $connection;
	$query = "SELECT * FROM categories WHERE parent_id = 0 ";
	$send_query = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_array($send_query)) 
	{
		echo "<a href='category?num=" . $row['cat_id'] . "' class='dropdown-item'>{$row['cat_title']}</a>";
	}
}

function get_subcat_heading()		//displays heading(parent category) of the sub-categories in the side-nav
{
	global $connection;
	global $locnum;

	if(isset($_GET['num']))
	{
		$query = "SELECT * FROM categories WHERE cat_id = " . $_GET['num'] . " ";
		$receive_item = mysqli_query($connection , $query);
		if(!$receive_item == 0)
		{
		    while ($row = mysqli_fetch_array($receive_item))
		    {
		    	echo " <a href='category?num=" . $row['cat_id'] . "' class='cat-title'><h2 class='cat-title' style='padding-top: 27px; padding-bottom: 30px;'> " . $row['cat_title'] . " </h2></a> ";
		    } 
		}
		else
		{
			include("error.php");
		}
	}
	else
	{
		include("error.php");
	}
}

function get_product()		//displays all items of parent category
{
	// set_error_handler("customError");
	global $connection;
	global $locnum;
	if(isset($_GET['num']))
	{
		global $connection;
		$query = "SELECT * FROM `products` WHERE parent_id =". $_GET['num'] ." ";
		$receive_products = mysqli_query($connection , $query);
		 // = '';
		 // = '';
		while ($row = mysqli_fetch_array($receive_products))	
		{
			$product = <<<DELIMETER
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card h-100">
				<div class="card-footer">
					<h5 class="card-title">
				    	<a class="card-item-title" href="item?id={$row['product_id']}&cat={$row['cat_id']}&num={$_GET['num']}">{$row['product_title']}</a>
				  	</h5>
				  	<h6 class="card-item-price">&#8377; {$row['product_price']}</h6>
				</div>
				
				<a href="item?id={$row['product_id']}&cat={$row['cat_id']}&num={$_GET['num']}">

					<img class="card-img-top" src="{$row['product_image']}" alt="">

				</a>
				

				<div class="card-body">
			  
				</div>

				<!--<div class="card-footer">
				  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
				</div>-->
				<div class="card-footer cart-btn-container"><a target="_blank" href="../resources/cart.php?add={$row['product_id']}&par={$row['parent_id']}&cat={$row['cat_id']}"><button class="btn btn-dark cart-btn">Add to Cart</button></a></div>
				</div>
	        </div>
DELIMETER;
			echo $product;
		}
	}
	else
	{
		echo "PAGE DOESN'T EXIST";
	}
	
}

function get_product_for_cat()		//displays all items of sub category
{
	global $connection;
	$query = "SELECT * FROM products WHERE cat_id = " . $_GET['id'] . " ";
	$receive_products = mysqli_query($connection , $query);
	
	$rowcount = mysqli_num_rows($receive_products);
	 // = '';
	 // = '';
	while ($row = mysqli_fetch_array($receive_products))	
	{
		$product= <<<DELIMETER
		<div class="col-lg-4 col-md-6 mb-4">
			<div class="card h-100">
			<div class="card-footer">
				<h5 class="card-title">
			    <a class="card-item-title" href="item?id={$row['product_id']}&cat={$row['cat_id']}&num={$_GET['num']}">{$row['product_title']}</a>
			  	</h5>
			  	<h6 class="card-item-price">&#8377; {$row['product_price']}</h6>
			</div>
			<a href="item?id={$row['product_id']}&cat={$row['cat_id']}&num={$_GET['num']}">
				<img class="card-img-top" src="{$row['product_image']}" alt="">
			</a>
			<div class="card-body">
			  
			  <!-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p> -->
			 
			</div>

			<!--<div class="card-footer">
				  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
				</div>-->
			<div class="card-footer cart-btn-container"><a target="_blank" href="../resources/cart.php?add={$row['product_id']}"><button class="btn btn-dark cart-btn">Add to Cart</button></a></div>
			</div>
        </div>
DELIMETER;
echo $product;				//DISPLAYS THE PRODUCTS IN THUMBNAILS
	}
}

function get_subcat_title()		//heading(of clicked sub-category) for the column that displays all items from sub-category
{
	global $connection;
	global $rowcount;
	$query = "SELECT * FROM categories WHERE cat_id = " . $_GET['id'] . " ";
	$send_query = mysqli_query($connection, $query);

	$query2 = "SELECT * FROM products WHERE cat_id = " . $_GET['id'] . " ";
	$receive_products = mysqli_query($connection , $query2);
	
	$rowcount = mysqli_num_rows($receive_products);

	while ($row = mysqli_fetch_array($send_query)) 
	{
		echo "<div id='fries'><h3 class='sub-cat-title cat-title'>{$row['cat_title']}</h3>";
		echo "<h6 class='cat-title' style='text-align: center;'>" . $rowcount . " items</h6></div>";  //SUBCATEGORIES
	}

	
}

function get_cat_title()		//heading for the column that displays all items from parent category
{	
	global $connection;
	$query = "SELECT * FROM categories WHERE cat_id = " . $_GET['num'] . " ";
	$send_query = mysqli_query($connection, $query);

	$query2 = "SELECT * FROM products WHERE parent_id = " . $_GET['num'] . " ";
	$receive_products = mysqli_query($connection , $query2);
	
	$rowcount = mysqli_num_rows($receive_products);

	while ($row = mysqli_fetch_array($send_query)) 
	{
		echo "<div><h3 class='sub-cat-title cat-title'>Showing all items from {$row['cat_title']}</h3> ";
		echo "<h6 class='cat-title' style='text-align: center;'>" . $rowcount . " items</h6></div>";  //SUBCATEGORIES
	}
}

function item()			//displays item details and reviews in item.php
{
	global $connection;
    $query = "SELECT * FROM products WHERE product_id = " . $_GET['id'] . " ";
    $receive_item = mysqli_query($connection , $query);
     // = '';
     // = '';
    while ($row = mysqli_fetch_array($receive_item))
    {
    	if(!empty($row['product_desc']))
    	{
    		$desc = $row['product_desc'];
    	}	
    	else
    	{
    		$desc = "No Description for this product.";
    	}

    	$item = <<<DELIMETER
		<div class="col-lg-6 disp-item item-padding">

			<div class="card mt-4">
			<div class="card-footer">
			  <h3 class="card-title">{$row['product_title']}</h3>
			  <h4>&#8377; {$row['product_price']}</h4>
			</div>
			<img class="card-img-top img-fluid" src="{$row['product_image']}" alt="{$row['product_title']}">
			<div class="card-body">
			  
			  <p class="card-text">{$row['product_desc']}</p>
			  <!-- <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span> -->
			  <!-- 4.0 stars<br> -->
			  <div class="add-cart-btn">
			    <a target="_blank" href="../resources/cart.php?add={$row['product_id']}"><button class="btn btn-dark prod-cart-btn">Add to Cart</button></a>
			  </div>
			</div>

			</div>
			<!-- /.card -->

			<div class="card card-outline-secondary my-4">
			 <div class="card-header">
			  Product Description
			</div>
			<div class="card-body">
			  <p>{$desc}</p>

			</div> 
			</div>
			<!-- /.card -->
		</div>
DELIMETER;
		echo $item;
    }        
}




function related_items()		//displays related items column in item.php
{
	global $connection;
	$send_query = NULL;

	$query2 = "SELECT * FROM products WHERE parent_id = ". $_GET['num'] ." AND product_id <> ". $_GET['id'] ." LIMIT 5  ";
	$send_query = mysqli_query($connection, $query2);

	$query1 = "SELECT * FROM products WHERE cat_id = ". $_GET['cat'] ." AND product_id <> ". $_GET['id'] ." LIMIT 5 ";
	$send_query1 = mysqli_query($connection, $query1);
	$num_rows = mysqli_num_rows($send_query1);

	if($num_rows >= 3)
	{
		$send_query = $send_query1;
	}
	 // = '';
	 // = '';
	while ($row = mysqli_fetch_array($send_query)) 
	{
		$related = <<<DELIMETER
		<div class="list-group"> <!-- RELATED ITEMS -->
            		
            <div class="rel-card">
              <div class="card h-100">
              	<div class="card-footer">
					<h5 class="card-title">
				    	<a class="card-item-title" href="item?id={$row['product_id']}&cat={$row['cat_id']}&num={$_GET['num']}">{$row['product_title']}</a>
				  	</h5>
				  	<h6 class="card-item-price">&#8377; {$row['product_price']}</h6>
				</div>
                <a href="item?id={$row['product_id']}&cat={$row['cat_id']}&num={$_GET['num']}">
                	<img class="card-img-top" src="{$row['product_image']}" alt="">
            	</a>
                <div class="card-body">
                  
                </div>
                <!--<div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>-->
                <div class="card-footer card-footer-cartbtn" style="text-align: center;">
                	<a target="_blank" href="../resources/cart.php?add={$row['product_id']}"><button class="btn btn-dark cart-btn">Add to Cart</button></a>
                </div>
              </div>
            </div>
            
          </div>  <!-- RELATED ITEMS -->
DELIMETER;
          echo $related;
	}
}

function redirect($location)	//Simplifying the HEADER(location: $loc) function
{
	return header("Location: $location");
}

function clear_input($input) 	//htmlspclchars, removes empty spaces
{
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}

function customer_login()
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
			$password = md5($password);
		}

		if(isset($email) && isset($password)) 
		{
			global $connection;
			$query = "SELECT * FROM login WHERE email = '{$email}' AND password = '{$password}' ";
			$send_query = mysqli_query($connection, $query);

			if(mysqli_num_rows($send_query) == 0)
			{
				$wrong = "Your E-mail ID or password is wrong!";
			}
			else
			{
				while ($row = mysqli_fetch_array($send_query))
				{
					$_SESSION['email'] = $row['email'];
					if($row['priority'] == "3")
					{
						$query2_customer = "SELECT * FROM customers WHERE email = '{$email}' ";
						$send_customer_query2 = mysqli_query($connection, $query2_customer);
						while ($row_cust = mysqli_fetch_array($send_customer_query2))
						{
							$_SESSION['name'] = trim($row_cust['first name']) . " " . trim($row_cust['last name']);
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
					else if($row['priority'] == "1")
					{
						$query2_admin = "SELECT * FROM admin WHERE email = '{$email}' ";
						$send_admin_query2 = mysqli_query($connection, $query2_admin);
						while ($row_admin = mysqli_fetch_array($send_admin_query2))
						{
							$_SESSION['adminname'] = trim($row_admin['first name']) . " " . trim($row_admin['last name']);
						}
						if(isset($_SESSION['adminname']))
						{
							redirect("admin2");
						}
						else
						{
							redirect("index");
						}
					}
					else if($row['priority'] == "2")
					{
						$querye = "SELECT * FROM employees WHERE email = '{$email}' ";
						$sende = mysqli_query($connection, $querye);
						while ($rowe = mysqli_fetch_array($sende))
						{
							$_SESSION['empname'] = trim($rowe['first name']) . " " . trim($rowe['last name']);
						}
						if(isset($_SESSION['empname']))
						{
							redirect("employee");
						}
						else
						{
							redirect("index");
						}
					}
				}
			}
		}
	}
}

function checkif_user_loggedin()
{
	if(isset($_SESSION['name'])) 
	{
		echo "<a class='dropdown-item my-orders' data-toggle='modal' data-target='#exampleModalCenter'>My Orders</a>";
		echo "<a class='dropdown-item my-orders' data-toggle='modal' data-target='#exampleModalOrderHistory'>View my Order History</a>";
		echo "<a class='dropdown-item' href='' data-toggle='modal' data-target='#logoutModal'>Logout</a>"; 
	}
	else
	{
		echo "<a class='dropdown-item' href='login'>Login</a>";
		echo "<a class='dropdown-item' href='register'>Signup</a>";
	}
}

function send_otp()
{
	if(isset($_POST['submit']))
	{
		global $wrong, $firstname, $lastname, $emptyemailerror, $emptypassworderror, $emailformaterror;
		global $email, $emptynameerror, $pwdwhitesperror, $matchpwd, $nameErr;
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

			if(isset($email))
			{
				$header = "From: kaushik.bantval98@gmail.com";
				$subject = "Drnklab Email verification";
				$otp = rand(10000,99999);
				$msg = "Here's your OTP: " . $otp . ". Use this to complete the sign up process.";
				ini_set("SMTP","ssl://smtp.gmail.com");
				ini_set("smtp_port","25");
				$test = mail($email, $subject, $msg, $header);
				if($test == 1)
				{
					$_SESSION['otpsent'] = $otp;
					$_SESSION['tempemail'] = $email;
					set_message("OTP sent to {$email}.");
					redirect("register");
				}
				else
				{
					set_message("Something went wrong! OTP could not be sent. Please try again later.");
					redirect("register");
				}
			}
		}
	}
}

function customError($errno, $errstr) {
	$s = " ";
include("error.php");
  // die();
} 

function send_reset_password_link()
{
	if(isset($_POST['submit']))
	{
		global $wrong, $firstname, $lastname, $emptyemailerror, $emptypassworderror, $emailformaterror;
		global $email, $emptynameerror, $pwdwhitesperror, $matchpwd, $nameErr;
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

			if(isset($email))
			{	
				global $connection;
				$query = "SELECT * FROM customers WHERE email = '{$email}' ";
				$res = mysqli_query($connection, $query);

				while($row = mysqli_fetch_array($res))
				{
					$emailfromdb = $row['email'];
				}
				if(isset($emailfromdb))
				{
					if($emailfromdb == $email)
					{
						$emailencoded = base64_encode($email);
						$header = "From: kaushik.bantval98@gmail.com";
						$subject = "Drnklab account password reset";
						$key = rand(10000,99999);
						$key = base64_encode($key);
						$otp = "http://localhost/carou/public/resetPassword?email={$emailencoded}&key={$key}";
						$msg = "Here's your reset link: " . $otp . ". Use this to reset your password.";
						ini_set("SMTP","ssl://smtp.gmail.com");
						ini_set("smtp_port","465");
						$test = mail($email, $subject, $msg, $header);
 
						if($test == 1)
						{
							try 
							{
								set_error_handler("customError");
								$_SESSION['resetkey'] = $key;
								$_SESSION['resetemail'] = $emailencoded;
								set_message("Check your email for password reset link.");
								redirect("forgotPassword");
							} 
							catch (Exception $e) 
							{
								set_message("Error: {$e}");
								redirect("forgotPassword");
							}
						}
						else
						{
							set_message("Something went wrong! Reset link could not be sent. Please try again later.");
							redirect("forgotPassword");
						}
					}
					else
					{
						set_message("Email isn't registered.");
						redirect("forgotPassword");
					}
				}
				else
				{
					set_message("Email isn't registered.");
					redirect("forgotPassword");
				}
			}
		}
	}
}

function reset_password()
{
	if(isset($_GET['email']) && isset($_GET['key']))
	{
		if($_SESSION['resetkey'] == $_GET['key'] && $_SESSION['resetemail'] == $_GET['email'])
		{
			if(isset($_POST['submit']))
			{
				global $wrong, $firstname, $lastname, $emptyemailerror, $emptypassworderror, $emailformaterror;
				global $email, $emptynameerror, $pwdwhitesperror, $matchpwd, $nameErr;
				
				if(empty($_POST['password']))
				{
					$emptypassworderror = "Password field cannot be empty!";
				}
				else if(strlen($_POST['password']) < 6)
				{
					$emptypassworderror = "Password cannot be lesser than 6 characters!";
				}
				else
				{
					$passwordtest = $_POST['password'];
					if($passwordtest == trim($passwordtest))
					{
						$password = md5($_POST['password']);
					}
					else
					{
						$pwdwhitesperror = "Password cannot begin or end with an empty space!";
					}
				}
				if(empty($_POST['confirmpassword']))
				{
					$emptypassworderror = "Password field cannot be empty!";
				}
				else
				{
					$passwordtest2 = $_POST['confirmpassword'];
					if($passwordtest2 == trim($passwordtest2))
					{
						$confirmpassword = md5($_POST['confirmpassword']);
					}
					else
					{
						$pwdwhitesperror = "Password cannot begin or end with an empty space!";
					}
				}


				if(isset($password) && isset($confirmpassword))
				{
					if($password == $confirmpassword)
					{
						global $connection;
						$resetemail = base64_decode($_SESSION['resetemail']);
						$query = "UPDATE login, customers SET login.password = '$password' WHERE login.email = customers.email AND login.email = '$resetemail' ";
						$send_query = mysqli_query($connection, $query);

						if($send_query == 1)
						{
							set_message("Password updated. Login with your new password.");
							unset($_SESSION['resetemail']);
							unset($_SESSION['key']);
							redirect("login");
						}
						else
						{
							set_message("Something went wrong. Password couldn't be updated. Please try after some time. ");
							unset($_SESSION['resetemail']);
							unset($_SESSION['key']);
							redirect("login");
						}
					}
					else
					{
						$matchpwd = "Password fields don't match!";
					}
				}
			}
		}
		else
		{
			set_message("Invalid link.");
			// unset($_SESSION['resetemail']);
			// unset($_SESSION['key']);
			redirect("forgotPassword");
		}
	}
	else
	{
		set_message("Invalid link.");
		// unset($_SESSION['resetemail']);
		// unset($_SESSION['key']);
		redirect("forgotPassword");
	}
}


function otp_check()
{
	if(isset($_POST['otpsubmit']))
	{
		if($_SESSION['otpsent'] == $_POST['otptext'])
		{
			set_message("Email verified");
			$_SESSION['otpverified'] = "SET"; 
			// $_SESSION['email'] = $_SESSION['tempemail'];
			redirect("signup");
		}
		else
		{
			set_message("OTP entered is wrong!");
			redirect("register");
		}
	}
}

function customer_signup()
{

	if(isset($_POST['submit']))
	{
		global $wrong, $firstname, $lastname, $emptyemailerror, $emptypassworderror, $emailformaterror;
		global $email, $emptynameerror, $pwdwhitesperror, $matchpwd, $nameErr;		

		if(empty($_POST['firstname']))
		{
			$emptynameerror = "Name field cannot be empty!";
		}
		else
		{
			$firstnametest = clear_input($_POST['firstname']);
			if (!preg_match("/^[a-zA-Z]*$/",$firstnametest)) 
			{
			  	$nameErr = "Invalid name format!";
			}
			else
			{
				$firstname = clear_input($_POST['firstname']);
			}
		}

		if(empty($_POST['lastname']))
		{
			$emptynameerror = "Name field cannot be empty!";
		}
		else
		{
			$lastnametest = clear_input($_POST['lastname']);
			if (!preg_match("/^[a-zA-Z]*$/",$lastnametest)) 
			{
			  	$nameErr = "Invalid name format!";
			}
			else
			{
				$lastname = clear_input($_POST['lastname']);
			}
		}

		$email = $_SESSION['tempemail'];

		if(empty($_POST['password']))
		{
			$emptypassworderror = "Password field cannot be empty!";
		}
		else if(strlen($_POST['password']) < 6)
		{
			$emptypassworderror = "Password cannot be lesser than 6 characters!";
		}
		else
		{
			$passwordtest = $_POST['password'];
			if($passwordtest == trim($passwordtest))
			{
				$password = md5($_POST['password']);
			}
			else
			{
				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
			}
		}
		if(empty($_POST['confirmpassword']))
		{
			$emptypassworderror = "Password field cannot be empty!";
		}
		else
		{
			$passwordtest2 = $_POST['confirmpassword'];
			if($passwordtest2 == trim($passwordtest2))
			{
				$confirmpassword = md5($_POST['confirmpassword']);
			}
			else
			{
				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
			}
		}

		if(isset($email) && isset($password) && isset($firstname) && isset($lastname) && isset($confirmpassword)) 
		{
			if($password == $confirmpassword)
			{
				if(strlen($password) >= 6 && strlen($confirmpassword) >= 6)
				{
					global $connection;
					$query0 = "INSERT INTO `login` (`email`, `password`, `priority`) VALUES ('{$email}', '{$password}', '3');";
					$send_query = mysqli_query($connection, $query0);
					
					$query1 = "INSERT INTO `customers` (`first name`, `last name`, `email`) VALUES ('{$firstname}', '{$lastname}', '{$email}');";
					$send_query1 = mysqli_query($connection, $query1);

					if($send_query == 1)
					{
						global $connection;
						$query2 = "SELECT * FROM `customers` WHERE email = '{$email}' ";
						$receive2 = mysqli_query($connection , $query2);
						
						while ($row = mysqli_fetch_array($receive2))	
						{
							$_SESSION['name'] = trim($row['first name']) . " " . trim($row['last name']);
							$_SESSION['email'] = $row['email'];
						}
						if(isset($_SESSION['item_quantity']))
						{	
							unset($_SESSION['tempemail']);
							unset($_SESSION['otpsent']);
							redirect("cart_user");
						}
						else
						{
							unset($_SESSION['tempemail']);
							unset($_SESSION['otpsent']);
							redirect("index");
						}
					}
					else
					{
						unset($_SESSION['tempemail']);
						unset($_SESSION['otpsent']);
						set_message("This E-mail is already registered!");
						redirect("register");
					}
				}
				else
				{
					$pwdsizeerror = "Passowrd length should be greater than 6!";
				}

			}	
			else
			{
				$matchpwd = "Password fields don't match!";
			}
		}
	}	
}


function customer_signup_old()
{
	if(isset($_POST['submit']))
	{
		global $wrong, $firstname, $lastname, $emptyemailerror, $emptypassworderror, $emailformaterror;
		global $email, $emptynameerror, $pwdwhitesperror, $matchpwd, $nameErr;		

		if(empty($_POST['firstname']))
		{
			$emptynameerror = "Name field cannot be empty!";
		}
		else
		{
			$firstnametest = clear_input($_POST['firstname']);
			if (!preg_match("/^[a-zA-Z]*$/",$firstnametest)) 
			{
			  	$nameErr = "Invalid name format!";
			}
			else
			{
				$firstname = clear_input($_POST['firstname']);
			}
		}

		if(empty($_POST['lastname']))
		{
			$emptynameerror = "Name field cannot be empty!";
		}
		else
		{
			$lastnametest = clear_input($_POST['lastname']);
			if (!preg_match("/^[a-zA-Z]*$/",$lastnametest)) 
			{
			  	$nameErr = "Invalid name format!";
			}
			else
			{
				$lastname = clear_input($_POST['lastname']);
			}
		}

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
		else if(strlen($_POST['password']) < 6)
		{
			$emptypassworderror = "Password cannot be lesser than 6 characters!";
		}
		else
		{
			$passwordtest = $_POST['password'];
			if($passwordtest == trim($passwordtest))
			{
				$password = md5($_POST['password']);
			}
			else
			{
				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
			}
		}
		if(empty($_POST['confirmpassword']))
		{
			$emptypassworderror = "Password field cannot be empty!";
		}
		else
		{
			$passwordtest2 = $_POST['confirmpassword'];
			if($passwordtest2 == trim($passwordtest2))
			{
				$confirmpassword = md5($_POST['confirmpassword']);
			}
			else
			{
				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
			}
		}

		if(isset($email) && isset($password) && isset($firstname) && isset($lastname) && isset($confirmpassword)) 
		{
			if($password == $confirmpassword)
			{
				if(strlen($password) >= 6 && strlen($confirmpassword) >= 6)
				{
					global $connection;
					$query0 = "INSERT INTO `login` (`email`, `password`, `priority`) VALUES ('{$email}', '{$password}', '3');";
					$send_query = mysqli_query($connection, $query0);
					
					$query1 = "INSERT INTO `customers` (`first name`, `last name`, `email`) VALUES ('{$firstname}', '{$lastname}', '{$email}');";
					$send_query1 = mysqli_query($connection, $query1);

					if($send_query)
					{
						global $connection;
						$query2 = "SELECT * FROM `customers` WHERE email = '{$email}' ";
						$receive2 = mysqli_query($connection , $query2);
						
						while ($row = mysqli_fetch_array($receive2))	
						{
							$_SESSION['name'] = trim($row['first name']) . " " . trim($row['last name']);
							$_SESSION['email'] = $row['email'];
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
					else
					{
						set_message("This E-mail is already registered!");
						redirect("signup");
					}
				}
				else
				{
					$pwdsizeerror = "Passowrd length should be greater than 6!";
				}

			}	
			else
			{
				$matchpwd = "Password fields don't match!";
			}
		}
	}	
}

function pwd_whitesp_error()	//displays pwd cannot have space in beg & end
{
	global $pwdwhitesperror;
	if(isset($pwdwhitesperror))
	{
		echo "<small id='inputEmail' class='form-text login-msg'>{$pwdwhitesperror}</small>";
	}
}
function pwd_size_error()	//displays pwd cannot have space in beg & end
{
	global $pwdsizeerror;
	if(isset($pwdsizeerror))
	{
		echo "<small id='inputEmail' class='form-text login-msg'>{$pwd_size_error}</small>";
	}
}

function invalid_name()	//displays pwd cannot have space in beg & end
{
	global $nameErr;
	if(isset($nameErr))
	{
		echo "<small id='inputEmail' class='form-text login-msg'>{$nameErr}</small>";
	}
}

function matchpwd()		//displays pwd & confirm pwd fields don't match 
{
	global $matchpwd;
	if(isset($matchpwd))
	{
		echo "<small id='inputEmail' class='form-text login-msg'>{$matchpwd}</small>";
	}
}

function empty_email_error()	//E-mail field cannot be empty!
{
	global $emptyemailerror;
	if(isset($emptyemailerror))
	{
		echo "<small id='inputEmail' class='form-text login-msg'>{$emptyemailerror}</small>";
	} 
}

function empty_name_error()	//Name field cannot be empty!
{
	global $emptynameerror;
	if(isset($emptynameerror))
	{
		echo "<small id='inputName' class='form-text login-msg'>{$emptynameerror}</small>";
	} 
}

function empty_pwd_error()		//Password field cannot be empty!
{
	global $emptypassworderror;
	if(isset($emptypassworderror))
	{
		echo "<small id='inputEmail' class='form-text login-msg'>{$emptypassworderror}</small>";
	}
}

function email_format_invalid()		//Invalid E-mail format
{
	global $emailformaterror;
	if(isset($emailformaterror))
	{
		echo "<small id='inputEmail' class='form-text login-msg'>{$emailformaterror}</small>";
	}
}
function number_format_invalid()
{
	global $numberformaterror;
	if(isset($numberformaterror))
	{
		echo '<small>yoo{$numberformaterror}</small>';
	}
}

function set_message($msg)					//SET MSG FOR WRONG PASSWORD OR USER anD CART
{
	if(!empty($msg))
	{
		$_SESSION['message'] = $msg;
	}
	else
	{
		$msg = "";
	}
}

function display_message()
{
	if(isset($_SESSION['message']))
	{
		$product = <<<DELIMETER
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  {$_SESSION['message']}
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
DELIMETER;
		echo $product;
		unset($_SESSION['message']);
	}
}

function check_if_order_processing()
{
	global $connection;
	$email = $_SESSION['email'];
	$query0 = "SELECT * FROM orders WHERE email = '{$email}' AND order_status <> 'DELIVERED' ";
	$get_query = mysqli_query($connection, $query0); 

	if(!mysqli_num_rows($get_query) == 0)
	{
		set_message("Sorry! A new order cannot be placed when an existing order is processing.");
		redirect("place_order");
	}
	else
	{
		$_SESSION['existing_order'] = "null";
	}
}

function insert_cash_orders()
{
	global $connection;
	$order_total = $_SESSION['item_total'];
	date_default_timezone_set("Asia/Kolkata");
	$order_date = date("Y/m/d H:i:s");
	$email = $_SESSION['email'];
	$address_id = $_SESSION['last_id'];

	$query0 = "SELECT * FROM orders WHERE email = '{$email}' AND order_status <> 'DELIVERED' ";
	$get_query = mysqli_query($connection, $query0); 

	if(mysqli_num_rows($get_query) == 0)
	{
		$query = "INSERT INTO `orders` (`order_total`, `order_status`, `order_date`, `transaction_type`, `email`, `address_id`) VALUES ('{$order_total}', 'AWAITING APPROVAL', '{$order_date}', 'COD', '{$email}', '{$address_id}');";
		$insert_orders = mysqli_query($connection , $query);

		$last_id_order = mysqli_insert_id($connection);

		$total_quantity=$_SESSION['total_quantity'];


		$i = $j = 1;
		while($i <= $total_quantity)
		{
			$product_id = $_SESSION['product_id' . $i];
			$product_quantity = $_SESSION['product_quantity' . $i];
			$query2 = "INSERT INTO `order_products` (`order_id`, `product_id`, `quantity`) VALUES ('{$last_id_order}', '{$product_id}', '{$product_quantity}');";
			$insert_order_product = mysqli_query($connection, $query2);
			if($insert_orders && $insert_order_product)
			{
				set_message("Your order ID: {$last_id_order}");
				
			}
			
			$i++;
		}
		while($j <= $total_quantity)
		{
			unset($_SESSION['product_id' . $j]);
			$j++;
		}
		$_SESSION['order_placed'] = "true";
		$_SESSION['cash_order_placed'] = "true";
	}
	else
	{
		set_message("Sorry! A new order cannot be placed when an existing order is processing.");
		redirect("place_order");
	}
}


function insert_prepaid_orders()
{
	// if(isset($_POST['PAYMENTMODE']) && isset($_POST['GATEWAYNAME']) && isset($_POST['BANKNAME']))
	// {
		$orderid = $_POST['ORDERID'];
		$taxnid = $_POST['TXNID'];
		$paymentmode = $_POST['PAYMENTMODE'];
		$currency = $_POST['CURRENCY'];
		$status = $_POST['STATUS'];
		$responsecode = $_POST['RESPCODE'];
		$responsemsg = $_POST['RESPMSG'];
		$gatewayname = $_POST['GATEWAYNAME'];
		$banktxnid = $_POST['BANKTXNID'];
		$bankname = $_POST['BANKNAME'];
		$checksumhash = $_POST['CHECKSUMHASH'];
		global $connection;
		$order_total = $_SESSION['item_total'];
		date_default_timezone_set("Asia/Kolkata");
		$order_date = date("Y/m/d H:i:s");
		$email = $_SESSION['email'];
		$address_id = $_SESSION['last_id'];

		$query0 = "SELECT * FROM orders WHERE email = '{$email}' AND order_status <> 'DELIVERED' ";
		$get_query = mysqli_query($connection, $query0); 

		if(mysqli_num_rows($get_query) == 0)
		{
			$query = "INSERT INTO `orders` (`order_id`, `order_total`, `order_status`, `order_date`, `transaction_type`, `email`, `address_id`) VALUES ('{$orderid}', '{$order_total}', 'AWAITING APPROVAL', '{$order_date}', 'PREPAID', '{$email}', '{$address_id}');";
			$insert_orders = mysqli_query($connection , $query);

			$last_id_order = mysqli_insert_id($connection);

			$total_quantity=$_SESSION['total_quantity'];

			$query_pay = "INSERT INTO `order_payment` (`order_id`, `txnid`, `paymentmode`, `currency`, `txnstatus`, `respcode`, `responsemsg`, `gatewayname`, `banktxnid`, `bankname`, `checksumhash`) VALUES ('{$orderid}', '{$taxnid}', '{$paymentmode}', '{$currency}', '{$status}', '{$responsecode}', '{$responsemsg}', '{$gatewayname}', '{$banktxnid}', '{$bankname}', '{$checksumhash}');";
			$insert_pay = mysqli_query($connection , $query_pay);

			$i = $j = 1;
			while($i <= $total_quantity)
			{
				$product_id = $_SESSION['product_id' . $i];
				$product_quantity = $_SESSION['product_quantity' . $i];
				$query2 = "INSERT INTO `order_products` (`order_id`, `product_id`, `quantity`) VALUES ('{$orderid}', '{$product_id}', '{$product_quantity}');";
				$insert_order_product = mysqli_query($connection, $query2);
				if($insert_orders && $insert_order_product)
				{
					set_message("Your order ID: {$last_id_order}");
				}
				
				$i++;
			}
			while($j <= $total_quantity)
			{
				unset($_SESSION['product_id' . $j]);
				$j++;
			}

			if($insert_orders && $insert_pay && $insert_order_product)
			{
				$_SESSION['order_placed'] = "true";
				// $_SESSION['paytm'] = "null";
			}
		}
		else
		{
			set_message("Sorry! A new order cannot be placed when an existing order is processing.");
			redirect("place_order");
		}
	// }
	// else
	// {
	// 	echo $responsemsg;
	// 	set_message("Order not placed.");
	// }
	
}

// function to_get_order_id($add_value)
// {
// 	global $connection;
// 	$query = "SELECT order_id FROM orders ORDER BY order_id DESC";
// 	$get_query = mysqli_query($connection, $query);

// 	if($row = mysqli_fetch_array($get_query))
// 	{
// 		echo $row[0] + $add_value;
// 	}
// }

function to_get_cust_id()
{
	$email = $_SESSION['email'];
	global $connection;
	$query = "SELECT `customerid` FROM login, customers WHERE login.email = '{$email}' AND login.email = customers.email";
	$get_query = mysqli_query($connection, $query);

	while($row = mysqli_fetch_array($get_query))
	{
		$_SESSION['customerid'] = $row['customerid'];
	}
}

function to_display_date()
{
	global $connection;
	$email = $_SESSION['email'];
	$order_status = "DELIVERED";

	$query = "SELECT * FROM orders, order_products, products WHERE orders.order_id = order_products.order_id AND order_products.product_id = products.product_id AND orders.order_status <> '" . $order_status . "' AND orders.email = '" . $email . "' ";

	$get_query = mysqli_query($connection , $query);

	while($row = mysqli_fetch_array($get_query)) 
	{
		$_SESSION['order_date_for_orders'] = $row['order_date'];
	}
}

function my_orders()
{
	global $connection;
	$email = $_SESSION['email'];
	$order_status = "DELIVERED";

	$query = "SELECT *, TIME(order_date) as order_time FROM orders, order_products, products WHERE orders.order_id = order_products.order_id AND order_products.product_id = products.product_id AND orders.order_status <> '$order_status' AND orders.email = '$email'";

	$get_query = mysqli_query($connection , $query);

	while($row = mysqli_fetch_array($get_query)) 
	{
		$_SESSION['receipt_access'] = "null";
		if($row['order_status'] == "PREPARING")
		{
			$order_status = "Tasty food is being prepared!";
		}
		else if($row['order_status'] == "TRANSIT")
		{
			$order_status = "Your food is on the way!";
		}
		else if($row['order_status'] == "AWAITING APPROVAL")
		{
			$order_status = $row['order_status'];
		}
		$price = $row['product_price'] * $row['quantity'];
		$disp = <<<DELIMETER

			<tbody>
                <tr>
                    <td class='td-img'><img class='cart-img' src="{$row['product_image']}" width='30' height='30'></td>
                    <td>{$row['product_title']}(x{$row['quantity']})</td>
                    <td>{$row['order_time']}</td>
                    <td>{$order_status}</td>
                    <td>&#8377; {$row['order_total']}</td>
                </tr>
           	</tbody>

DELIMETER;
	    echo $disp;
	}
	if(mysqli_num_rows($get_query) == 0)
	{
		$_SESSION['mesage_to_display_no_orders'] = "No orders to display!";
	}
}
// <td class='td-img'><img class='cart-img' src="{$row['grouped_product_image']}" width='30' height='30'></td>
function order_history()
{
	global $connection;
	$email = $_SESSION['email'];
	$order_status = "DELIVERED";
	// $order_status1 = "DECLINED";

	$query = "SELECT *, GROUP_CONCAT(products.product_title, ' ( x',order_products.quantity, ' ) <br>' SEPARATOR '') AS `grouped_product_title`, GROUP_CONCAT('&#8377; ',products.product_price SEPARATOR '<br>') AS `grouped_product_price` FROM orders, order_products, products WHERE orders.order_id = order_products.order_id AND order_products.product_id = products.product_id AND orders.order_status = '{$order_status}' AND orders.email = '{$email}' GROUP BY orders.order_date DESC";

	$get_query = mysqli_query($connection , $query);

	while($row = mysqli_fetch_array($get_query)) 
	{
		$price = $row['product_price'] * $row['quantity'];
		$disp = <<<DELIMETER

			<tbody>
                <tr>
                	<td>{$row['order_id']}</td>
                    <td>{$row['grouped_product_title']}</td>
                    <td>{$row['order_date']}</td>
                    <td style="width: 73px;">{$row['grouped_product_price']}</td>
                    <td>&#8377; {$row['order_total']}</td>
                    <td>{$row['order_status']}</td>
                </tr>
           	</tbody>

DELIMETER;
	    echo $disp;

	}
	if(mysqli_num_rows($get_query) == 0)
	{
		$_SESSION['mesage_to_display_no_orders'] = "No orders to display!";
	}
}


function view_receipt()
{
	global $connection;
	$total_sub_total = 0;
	$email = $_SESSION['email'];
	$order_status = "DELIVERED";

	$query2 = "SELECT * FROM orders, order_products, products WHERE orders.order_id = order_products.order_id AND order_products.product_id = products.product_id AND orders.order_status <> '" . $order_status . "' AND orders.email = '" . $email . "' ";

	$get_query2 = mysqli_query($connection , $query2);

	while($row = mysqli_fetch_array($get_query2)) 
	{
		$sub_total = $row['product_price'] * $row['quantity'];
		$total_sub_total = $total_sub_total + $sub_total;
		$order_total = $row['order_total'];
		// $shipping = $row['order_total'] - $sub_total; 
		// echo $shipping;

		$_SESSION['order_date'] = $row['order_date'];
		$_SESSION['receipt_order_total'] = $row['order_total'];
		$disp = <<<DELIMETER
      	<tr>
            <td>{$row['order_id']}</td>
            <td class='td-img'><img class='cart-img' src="{$row['product_image']}" width='30' height='30'></td>
            <td>{$row['product_title']}(x{$row['quantity']})</td>
            <td>&#8377; {$row['product_price']}</td>
            <td>&#8377; $sub_total</td>
      	</tr>
DELIMETER;
	    echo $disp;
	}
	$shipping = $order_total - $total_sub_total;
	if($shipping > 0)
	{
		$_SESSION['shipping'] = $shipping;
	}
}

function for_insert_address()
{
	global $connection;
	global $emailformaterror;
	global $numberformaterror;
	$email = $_SESSION['email'];

	if(isset($_POST['address1']) && isset($_POST['address2']) && isset($_POST['zip']) && isset($_POST['contactnumber1']))
	{
		$address_1 = $_POST['address1'];
		$address_2 = $_POST['address2'];
		// echo $address_1.$address_2;
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		
		$contactnumber1 = $_POST['contactnumber1'];

		$contactnumber2 = $_POST['contactnumber2'];
	}
	else
	{
		redirect("index");
	}

	$query = "SELECT * FROM address WHERE address.email = '" . $email . "' ";
	$get_query = mysqli_query($connection , $query);

	if(mysqli_num_rows($get_query) == 0)
	{
		$query2 = "INSERT INTO `address` (`email`, `address_1`, `address_2`, `pin`, `contact_number`, `alternative_contact_number`, `city`, `state`) VALUES ('{$email}', '{$address_1}', '{$address_2}', '{$zip}', '{$contactnumber1}', '{$contactnumber2}', '{$city}', '{$state}');";
		$res1 = mysqli_query($connection , $query2);
		if($res1 == 0)
		{
			set_message("Phone number already used!");
			redirect("checkout");
		}
		$last_id = mysqli_insert_id($connection);
		$_SESSION['last_id'] = $last_id;
	}
	else
	{
		while($row = mysqli_fetch_array($get_query)) 
		{
			$_SESSION['last_id'] = $row['address_id'];
		}
		$query3 = "UPDATE `address` SET `address_1` = '{$address_1}', `address_2` = '{$address_2}', `city` = '{$city}', `state` = '{$state}', `pin` = '{$zip}', `contact_number` = '{$contactnumber1}', `alternative_contact_number` = '{$contactnumber2}' WHERE `address`.`email` = '{$email}';";
		$res2 = mysqli_query($connection, $query3);
		if($res2 == 0)
		{
			set_message("Phone number already used!");
			redirect("checkout");
		}
	}
}

function insert_address()
{
	global $connection;
	global $emailformaterror;
	global $numberformaterror;
	$email = $_SESSION['email'];

	if(isset($_POST['address1']) && isset($_POST['address2']) && isset($_POST['zip']) && isset($_POST['contactnumber1']))
	{
		$address_1 = $_POST['address1'];
		$address_2 = $_POST['address2'];
		// echo $address_1.$address_2;
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip'];
		
		$contactnumber1 = $_POST['contactnumber1'];

		$contactnumber2 = $_POST['contactnumber2'];
	}
	else
	{
		redirect("index");
	}
	
	if(strlen($contactnumber1) == 10)
	{
		if(strlen($address_1) > 6 && strlen($address_2) > 6 && strlen(trim($address_1)) != 0 && strlen(trim($address_2)) != 0)
		{
			if($contactnumber2 != 0)
			{
				if(strlen($contactnumber2) == 10)
				{
					for_insert_address();
				}
				else
				{
					set_message("Alternative Phone number invalid!");
					redirect("checkout");
				}
			}
			else
			{
				for_insert_address();
			}
		}
		else
		{
			set_message("Please enter the correct address!");
			redirect("checkout");
		}
	}
	else
	{
		set_message("Phone number invalid!");
		redirect("checkout");
	}
}


function show_address()
{
	global $connection;
	$email = $_SESSION['email'];

	$query = "SELECT * FROM address WHERE address.email = '" . $email . "' ";
	$get_query = mysqli_query($connection , $query);

	while($row = mysqli_fetch_array($get_query)) 
	{
		if($row['alternative_contact_number'] != "0")
		{
			$alt_number = $row['alternative_contact_number'];
		}
		else
		{
			$alt_number = "";
		}
		$address = <<<ADDRESS
		<div class="card-body">
	        <h5 class="card-title">{$_SESSION['name']}</h5>
	        <p class="card-text">{$row['address_1']}<br>{$row['address_2']}<br>{$row['city']}, {$row['state']}, {$row['pin']}<br>{$row['contact_number']}<br>{$alt_number}</p>
	        <a href="checkout" class="btn btn-primary">Change</a>
      	</div>
ADDRESS;
      	echo $address;
	}	
}

function display_pincodes()
{
	global $connection;
	$query = "SELECT * FROM pincodes";
	$res = mysqli_query($connection, $query);

	while($row = mysqli_fetch_array($res))
	{
		echo '<option value="'.$row['available_pin_codes'].'">'.$row['available_pin_codes'].'</option>';
	}
}


//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN
//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN
//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN
//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN
//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN
//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN//ADMIN
function view_pincodes_in_admin()
{
	global $connection;
	$query = "SELECT * FROM pincodes";
	$res = mysqli_query($connection, $query);
	$i = 1;
	while($row = mysqli_fetch_array($res))
	{
		$address = <<<ADDRESS
		    <tr> 
				<td>{$i}</td>
				<td>{$row['available_pin_codes']}</td>
				<td><a class="btn" href="../../resources/userend/back2/delete_pincode.php?pin={$row['available_pin_codes']}"><i class="fas fa-fw fa-trash"></i></a></td>
			</tr>
ADDRESS;
	    echo $address;
	    $i++;
	}
}
function add_pincode()
{
	if(isset($_POST['submit']) && isset($_POST['pin']))
	{
		if(strlen($_POST['pin']) == 6)
		{
			$pin = $_POST['pin'];
			global $connection;
			$query = "INSERT INTO pincodes (`available_pin_codes`) VALUES('$pin')";
			$res = mysqli_query($connection, $query);
			if($res == 0)
			{
				set_message("Pin code already exists!");
				redirect("index.php?add_pincode");
			}
			else if($res == 1)
			{
				set_message("Pin code added! Users can now place orders to {$pin}.");
				redirect("index.php?add_pincode");
			}
		}
		else
		{
			set_message("Invalid  pincode!");
			redirect("index.php?add_pincode");
		}
	}
}

function add_category() 
{
	if(isset($_POST['add_category'])) 
	{
		$cat_title = escape_string($_POST['cat_title']);

		if(empty($cat_title) || $cat_title == " ") 
		{
			echo "<p class='alert alert-danger'>CATEGORY CANNOT BE EMPTY</p>";
		} 
		else 
		{
			$insert_cat = query("INSERT INTO categories(parent_id, cat_title) VALUES('0','{$cat_title}') ");
			// confirm($insert_cat);
			set_message("Category Created");
	    }
	}
}

function show_categories_in_admin() 
{
	global $connection;
	$category_query = mysqli_query($connection , "SELECT * FROM categories WHERE parent_id = '0';");

	while($row = mysqli_fetch_array($category_query)) 
	{
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];


		$category = <<<DELIMETER
		<tr>
		    <td>{$cat_id}</td>
		    <td><a href="index.php?view_subcat&cat={$cat_id}">{$cat_title}</a></td>
		    <td><a style="color: black;" class="btn" data-toggle="modal" data-target="#exampleModalDeleteCategory{$row['cat_id']}"><i class="fas fa-fw fa-trash"></i></a></td>
		</tr>

		<div class="modal fade" id="exampleModalDeleteCategory{$row['cat_id']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalCenterTitle">Warning!</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        Deleting this category will make all the products that come under it unseeable in the website. Do you want to proceed?
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		        <a class="btn" href="../../resources/userend/back2/delete_category.php?id={$row['cat_id']}"><button type="button" class="btn btn-primary">Yes</button></a>
		      </div>
		    </div>
		  </div>
		</div>
DELIMETER;

		echo $category;
    }
}

function view_subcat()
{
	global $connection;
	$query = mysqli_query($connection, "SELECT * FROM categories WHERE parent_id = " . $_GET['cat'] . " ");

	while($row = mysqli_fetch_array($query))
	{
		$disp = <<<DELIMETER
		<tr>
            <td>{$row['cat_id']}</td>
            <td>{$row['cat_title']}</td>
            <td><a class="btn" style="color: black;" data-toggle="modal" data-target="#exampleModalCenter{$row['cat_id']}"><i class="fas fa-trash"></i></a></td>
        </tr>

		<div class="modal fade" id="exampleModalCenter{$row['cat_id']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalCenterTitle">Warning!</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        Deleting this sub-category will delete all the products that come under it. Do you want to proceed?
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		        <a class="btn" href="../../resources/userend/back2/delete_category.php?catid={$row['cat_id']}"><button type="button" class="btn btn-primary">Yes</button></a>
		      </div>
		    </div>
		  </div>
		</div>
DELIMETER;

        echo $disp;
	}
}

function display_cat_in_addsubcat()
{
	global $connection;
	$category_query = mysqli_query($connection , "SELECT * FROM categories WHERE parent_id = '0';");

	while($row = mysqli_fetch_array($category_query)) 
	{
		$category = <<<DELIMETER
		<a href="index.php?disp_subcat&cat={$row['cat_id']}">{$row['cat_title']}</a><br>
DELIMETER;

		echo $category;
    }
}

function add_subcat()
{
	global $connection;
	if(isset($_POST['add_category'])) 
	{
		$cat_title = escape_string($_POST['subcat_title']);

		if(empty($cat_title)) 
		{
			echo "<p class='alert alert-danger'>SUB CATEGORY CANNOT BE EMPTY</p>";
		} 
		else 
		{
			$cat = $_GET['cat'];
			mysqli_query($connection, "INSERT INTO `categories` (`parent_id`, `cat_title`) VALUES ('$cat', '$cat_title')");
			set_message("SUB CATEGORY CREATED");
			redirect("index.php?add_subcat");
			// $insert_cat = query("INSERT INTO categories(parent_id, cat_title) VALUES('0','{$cat_title}') ");
			// confirm($insert_cat);
			// set_message("Category Created");
	    }
	}
}

function sel_cat()
{
	if(isset($_POST['submit']))
	{
		if(isset($_POST['cat']))
		{
			$cat = $_POST['cat'];
			redirect("index.php?add_product&cat=$cat");
		}
		else
		if(isset($_POST['par']))
		{
			$par = $_POST['par'];
			$id = $_GET['id'];
			redirect("index.php?edit_product&cat=$par&id=$id");
		}

	}
}

function add_product() 
{
	global $connection;

	if(isset($_POST['publish'])) 
	{
		$parent_id = $_GET['cat'];
		$product_title          = escape_string($_POST['product_title']);
		$product_price          = escape_string($_POST['product_price']);
		$cat_id = escape_string($_POST['product_subcategory_id']);
		if(isset($_POST['product_description'])) { $product_description = escape_string($_POST['product_description']); } else { $product_description = NULL; }
		$product_quantity       = escape_string($_POST['product_limit']);

		$product_image = "images/" . basename($_FILES["prodfile"]["name"]);
		$target_dir = "../images/";
		$target_file = $target_dir . basename($_FILES["prodfile"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		if (file_exists($target_file)) 
		{
			set_message("File already exists.");
			redirect("index.php?products");
		}
		else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
		{
			set_message("Sorry, the file format has to be JPG, JPEG, PNG or GIF.");
			redirect("index.php?products");
		}
		else if(isset($product_title) && $product_price > 0 && isset($product_quantity))
		{
			move_uploaded_file($_FILES["prodfile"]["tmp_name"], $target_file);
			$query = "INSERT INTO products(product_title, cat_id, parent_id, product_price, product_desc, product_limit, product_image) VALUES('{$product_title}', '{$cat_id}', '{$parent_id}', '{$product_price}', '{$product_description}', '{$product_quantity}', '{$product_image}')";

			mysqli_query($connection , $query);

			$last_id = last_id();
			
			set_message("The new product with the ID {$last_id} was added.");
			redirect("index.php?products");
		}
		else
		{
			set_message("Something went wrong. Product wasn't added");
			redirect("index.php?products");
		}
    }
}

function show_subcategories_add_product_page()
{
	global $connection;
	$query = "SELECT * FROM categories WHERE parent_id = " . $_GET['cat'] . " ";
	$get_cat = mysqli_query($connection , $query);

	while($row = mysqli_fetch_array($get_cat)) 
	{
		$categories_options = <<<DELIMETER
		<option value="{$row['cat_id']}">{$row['cat_title']}</option>
		
DELIMETER;
		
	echo $categories_options;

	}
}

function show_categories_add_product_page()
{
	global $connection;
	$query = "SELECT * FROM categories WHERE parent_id = 0 ";
	$get_cat = mysqli_query($connection , $query);

	while($row = mysqli_fetch_array($get_cat)) 
	{
		$categories_options = <<<DELIMETER
		<option value="{$row['cat_id']}">{$row['cat_title']}</option>
		
DELIMETER;
		
	echo $categories_options;

	}
}

function display_users() 
{
	global $connection;
	$query = "SELECT * FROM users";
	$category_query = mysqli_query($connection , $query);

	while($row = mysqli_fetch_array($category_query)) 
	{
		$user_id = $row['userid'];
		$first = $row['first name'];
		$last = $row['last name'];
		$email = $row['email'];
		$password = $row['password'];

		$user = <<<DELIMETER

		<tr>
		    <td>{$user_id}</td>
		    <td>{$first} {$last}</td>
		     <td>{$email}</td>
		    <td><a class="btn btn-danger" href="../../resources/templates/back/delete_user.php?id={$row['userid']}"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
DELIMETER;

		echo $user;
    }
}

function add_user() 
{
	global $connection;
	if(isset($_POST['add_user'])) 
	{
		$firstname   = escape_string($_POST['firstname']);
		$secondname   = escape_string($_POST['secondname']);
		$email      = escape_string($_POST['email']);
		$password   = escape_string($_POST['password']);
		// $user_photo = escape_string($_FILES['file']['name']);
		// $photo_temp = escape_string($_FILES['file']['tmp_name']);


		// move_uploaded_file($photo_temp, UPLOAD_DIRECTORY . DS . $user_photo);

		$query = "INSERT INTO `users` (`userid`, `first name`, `last name`, `email`, `password`) VALUES (NULL, '$firstname', '$secondname', '$email', '$password')";
		mysqli_query($connection , $query);

		set_message("USER CREATED");

		redirect("index.php?users");
	}
}

function display_image($picture) 
{
	global $upload_directory;

	return $upload_directory  . DS . $picture;
}

function show_product_category_title($product_category_id)
{
	global $connection;
	$query = "SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ";
	$category_query = mysqli_query($connection , $query);
	
	while($category_row = mysqli_fetch_array($category_query)) 
	{
		return $category_row['cat_title'];
	}
}

function get_products_in_admin()
{
	global $connection;

	$query = "SELECT * FROM products";
	$get_products = mysqli_query($connection , $query);

	while($row = mysqli_fetch_array($get_products)) 
	{
		$category = show_product_category_title($row['parent_id']);
		$subcategory = show_product_category_title($row['cat_id']);

		$product = <<<DELIMETER

	    <tr>
	        <td>{$row['product_id']}</td>
	        <td><a href="index.php?select_category_to_edit&title={$row['product_title']}&id={$row['product_id']}">{$row['product_title']}</a></td>
	        <td><a href="index.php?select_category_to_edit&title={$row['product_title']}&id={$row['product_id']}"><img src="../{$row['product_image']}" width="50" height="50"></a></td>
	        <td>{$category}</td>
	        <td>{$subcategory}</td>
	        <td>&#8377; {$row['product_price']}</td>
	        <td><a style="color: black;" class="" data-toggle="modal" data-target="#exampleModalCenter{$row['product_id']}" href="index.php?delete_product&id={$row['product_id']}"><i class="fas fa-fw fa-trash"></i></a></td>
	    </tr>

		<div class="modal fade" id="exampleModalCenter{$row['product_id']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
			    <h5 class="modal-title" id="exampleModalCenterTitle">You sure?</h5>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      <span aria-hidden="true">&times;</span>
			    </button>
			  </div>
			  <div class="modal-body">
			    Do you really want to delete {$row['product_title']}?
			    This action cannot be undone!
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			    <a class="btn" href="index.php?delete_product&id={$row['product_id']}"><button type="button" class="btn btn-primary">Yes</button></a>
			  </div>
			</div>
			</div>
		</div>


DELIMETER;

		echo $product;
    }
}

function update_product() 
{
	global $connection;
	if(isset($_POST['update'])) 
	{
		$id = $_GET['id'];
		$product_title          = escape_string($_POST['product_title']);
		$product_subcategory_id    = escape_string($_POST['product_subcategory_id']);
		$product_desc = escape_string($_POST['product_description']);
		$product_price          = escape_string($_POST['product_price']);
		$parent_id = $_GET['cat'];
		$product_limit       = escape_string($_POST['product_limit']);
		// $product_image          = escape_string($_FILES['file']['name']);
		// $image_temp_location    = escape_string($_FILES['file']['tmp_name']);
		$target_dir = "../images/";
		$pic = $_FILES["prodfile"]["name"];
		// $product_image = "images/" . basename($_FILES["prodfile"]["name"]);

		if(empty($pic)) 
		{
			$get_pic = mysqli_query($connection, "SELECT product_image FROM products WHERE product_id =" .escape_string($_GET['id']). " ");

			while($pic = mysqli_fetch_array($get_pic)) 
			{
				$picdb = $pic['product_image'];
		    }
		    $target_file = "../" . $picdb;
    		$product_image = $picdb;
		}
		else
		{
			$target_file = $target_dir . basename($pic);
			$product_image = "images/" . $pic;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
			{
				set_message("Sorry, the file format has to be JPG, JPEG, PNG or GIF.");
				redirect("index.php?products");
			}
		}
		if(isset($product_title) && isset($id) && isset($parent_id) && isset($product_subcategory_id))
		{
			move_uploaded_file($_FILES["prodfile"]["tmp_name"], $target_file);

			$query = "UPDATE `products` SET `product_title` = '$product_title', `cat_id` = '$product_subcategory_id', `product_desc` = '$product_desc', `product_price` = '$product_price', `product_price` = '$product_price', `parent_id` = '$parent_id', `product_limit` = '$product_limit', `product_image` = '$product_image' WHERE `products`.`product_id` = '$id' ";
			mysqli_query($connection, $query);

			set_message("Product with ID {$id} has been updated");
			redirect("index.php?products");
		}
		else
		{
			set_message("Something went wrong. Product could not be updated.");
			redirect("index.php?products");
		}
	}
}

function get_employees()
{
	global $connection;
	$query = "SELECT * FROM login, employees WHERE login.email = employees.email AND login.priority = 2 ";	
	$send_query = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_array($send_query)) 
	{
		modal("../../resources/userend/back2/delete_employee.php?id={$row['employeeid']}");

		$emp = <<< DELIMETER
		
		    <tr>
		      <th scope="row">{$row['employeeid']}</th>
		      <td>{$row['first name']}</td>
		      <td>{$row['last name']}</td>
		      <td>{$row['email']}</td>
		      <td><a class="btn" style="color: black;" data-toggle="modal" data-target="#exampleModalCenter{$row['employeeid']}"><i class="fas fa-user-minus"></i></a></td>
		    </tr>


			<div class="modal fade" id="exampleModalCenter{$row['employeeid']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title" id="exampleModalCenterTitle">You sure?</h5>
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				    Do you really want to remove {$row['first name']} {$row['last name']}'s employee access permanently?
				    This action cannot be undone!
				  </div>
				  <div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				    <a class="btn" href="../../resources/userend/back2/delete_employee.php?id={$row['employeeid']}"><button type="button" class="btn btn-primary">Yes</button></a>
				  </div>
				</div>
				</div>
			</div>

DELIMETER;
		echo $emp;
		// echo $row['employeeid'];
		
	}
}

function modal($destination)
{
	$modal = <<<MODAL
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
		    <h5 class="modal-title" id="exampleModalCenterTitle">You sure?</h5>
		    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>
		  <div class="modal-body">
		    Do you really want to remove this employee's access permanently? {$destination}
		  </div>
		  <div class="modal-footer">
		    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		    <a class="btn" href="{$destination}"><button type="button" class="btn btn-primary">Yes</button></a>
		  </div>
		</div>
		</div>
	</div>
MODAL;
	echo $modal;
}

function get_customers()
{
	global $connection;
	$query = "SELECT * FROM login, customers WHERE login.email = customers.email AND login.priority = 3 ";	
	$send_query = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_array($send_query)) 
	{
		$emp = <<< DELIMETER
		
		    <tr>
		      <th scope="row">{$row['customerid']}</th>
		      <td>{$row['first name']}</td>
		      <td>{$row['last name']}</td>
		      <td>{$row['email']}</td>
		      <td><a class="btn" style="color: black;" data-toggle="modal" data-target="#exampleModalCenter{$row['customerid']}"><i class="fas fa-user-alt-slash"></i></a></td>
		    </tr>
	  	
			<div class="modal fade" id="exampleModalCenter{$row['customerid']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title" id="exampleModalCenterTitle">You sure?</h5>
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				    Do you really want to block customer {$row['first name']} {$row['last name']} ?
				  </div>
				  <div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				    <a class="btn" href="../../resources/userend/back2/block_customer.php?id={$row['customerid']}"><button type="button" class="btn btn-primary">Yes</button></a>
				  </div>
				</div>
				</div>
			</div>
DELIMETER;
		echo $emp;
	}
}

function get_blocked_customers()
{
	global $connection;
	$query = "SELECT * FROM login, customers WHERE login.email = customers.email AND login.priority = 0 ";	
	$send_query = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_array($send_query)) 
	{
		$emp = <<< DELIMETER
		
		    <tr>
		      <th scope="row">{$row['customerid']}</th>
		      <td>{$row['first name']}</td>
		      <td>{$row['last name']}</td>
		      <td>{$row['email']}</td>
		      <td><a class="btn" style="color: black;" data-toggle="modal" data-target="#exampleModalCenter{$row['customerid']}"><i class="fas fa-user-check"></i></a></td>
		    </tr>

			<div class="modal fade" id="exampleModalCenter{$row['customerid']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
				    <h5 class="modal-title" id="exampleModalCenterTitle">You sure?</h5>
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				  </div>
				  <div class="modal-body">
				    Do you want to unblock customer {$row['first name']} {$row['last name']} ?
				  </div>
				  <div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
				    <a class="btn" href="../../resources/userend/back2/block_customer.php?unbl={$row['customerid']}"><button type="button" class="btn btn-primary">Yes</button></a>
				  </div>
				</div>
				</div>
			</div>
DELIMETER;
		echo $emp;
	}
}

function get_admins()
{
	global $connection;
	$query = "SELECT * FROM login, admin WHERE login.email = admin.email AND login.priority = 1 ";	
	$send_query = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_array($send_query)) 
	{
		$emp = <<< DELIMETER
		
		    <tr>
		      <th scope="row">{$row['adminid']}</th>
		      <td>{$row['first name']}</td>
		      <td>{$row['last name']}</td>
		      <td>{$row['email']}</td>
		    </tr>
	  	
DELIMETER;
	    $emp1 = <<< DELIMETER
	
	    <tr>
			<th scope="row">{$row['adminid']}</th>
			<td>{$row['first name']}</td>
			<td>{$row['last name']}</td>
			<td>{$row['email']}</td>
			<td><a class="btn" style="color: blackl" data-toggle="modal" data-target="#exampleModalCenter{$row['adminid']}"><i class="fas fa-user-minus"></i></a></td>
	    </tr>  	


		<div class="modal fade" id="exampleModalCenter{$row['adminid']}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
			    <h5 class="modal-title" id="exampleModalCenterTitle">You sure?</h5>
			    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			      <span aria-hidden="true">&times;</span>
			    </button>
			  </div>
			  <div class="modal-body">
			    Do you really want to remove {$row['first name']} {$row['last name']}'s admin access permanently?
			    This action cannot be undone!
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			    <a class="btn" href="../../resources/userend/back2/delete_admin.php?id={$row['adminid']}"><button type="button" class="btn btn-primary">Yes</button></a>
			  </div>
			</div>
			</div>
		</div>

DELIMETER;
	    if(mysqli_num_rows($send_query) > 1)
	    {
	    	echo $emp1;
	    	$delete_option = "<th scope='col'>Remove Employee</th>";
	    }
	    else
	    {
	    	echo $emp;
	    }
	}
}

function employee_signup()
{
	if(isset($_POST['submit']))
	{
		global $wrong, $firstname, $lastname, $emptyemailerror, $emptypassworderror, $emailformaterror;
		global $email, $emptynameerror, $pwdwhitesperror, $matchpwd, $nameErr;		

		if(empty($_POST['firstname']))
		{
			$emptynameerror = "Name field cannot be empty!";
		}
		else
		{
			$firstnametest = clear_input($_POST['firstname']);
			if (!preg_match("/^[a-zA-Z]*$/",$firstnametest)) 
			{
			  	$nameErr = "Invalid name format!";
			}
			else
			{
				$firstname = clear_input($_POST['firstname']);
			}
		}

		if(empty($_POST['lastname']))
		{
			$emptynameerror = "Name field cannot be empty!";
		}
		else
		{
			$lastnametest = clear_input($_POST['lastname']);
			if (!preg_match("/^[a-zA-Z]*$/",$lastnametest)) 
			{
			  	$nameErr = "Invalid name format!";
			}
			else
			{
				$lastname = clear_input($_POST['lastname']);
			}
		}

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
		else if(strlen($_POST['password']) < 6)
		{
			$emptypassworderror = "Password cannot be lesser than 6 characters!";
		}
		else
		{
			$passwordtest = $_POST['password'];
			if($passwordtest == trim($passwordtest))
			{
				$password = md5($_POST['password']);
			}
			else
			{
				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
			}
		}
		if(empty($_POST['confirmpassword']))
		{
			$emptypassworderror = "Password field cannot be empty!";
		}
		else
		{
			$passwordtest2 = $_POST['confirmpassword'];
			if($passwordtest2 == trim($passwordtest2))
			{
				$confirmpassword = md5($_POST['confirmpassword']);
			}
			else
			{
				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
			}
		}

		if(isset($email) && isset($password) && isset($firstname) && isset($lastname) && isset($confirmpassword)) 
		{
			if($password == $confirmpassword)
			{
				global $connection;
				$query0 = "INSERT INTO `login` (`email`, `password`, `priority`) VALUES ('{$email}', '{$password}', '2');";
				$send_query = mysqli_query($connection, $query0);
				
				$query1 = "INSERT INTO `employees` (`first name`, `last name`, `email`) VALUES ('{$firstname}', '{$lastname}', '{$email}');";
				$send_query1 = mysqli_query($connection, $query1);

				if($send_query)
				{
					set_message("New Employee Added!");
					redirect("../../public/admin2/index.php?view_employee");
				}
				else
				{
					set_message("This E-mail is already registered!");
					redirect("../../public/admin2/index.php?add_employee");
				}
			}	
			else
			{
				$matchpwd = "Password fields don't match!";
			}
		}
	}	
}

function admin_signup()
{
	if(isset($_POST['submit']))
	{
		global $wrong, $firstname, $lastname, $emptyemailerror, $emptypassworderror, $emailformaterror;
		global $email, $emptynameerror, $pwdwhitesperror, $matchpwd, $nameErr;		

		if(empty($_POST['firstname']))
		{
			$emptynameerror = "Name field cannot be empty!";
		}
		else
		{
			$firstnametest = clear_input($_POST['firstname']);
			if (!preg_match("/^[a-zA-Z]*$/",$firstnametest)) 
			{
			  	$nameErr = "Invalid name format!";
			}
			else
			{
				$firstname = clear_input($_POST['firstname']);
			}
		}

		if(empty($_POST['lastname']))
		{
			$emptynameerror = "Name field cannot be empty!";
		}
		else
		{
			$lastnametest = clear_input($_POST['lastname']);
			if (!preg_match("/^[a-zA-Z]*$/",$lastnametest)) 
			{
			  	$nameErr = "Invalid name format!";
			}
			else
			{
				$lastname = clear_input($_POST['lastname']);
			}
		}

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
		else if(strlen($_POST['password']) < 6)
		{
			$emptypassworderror = "Password cannot be lesser than 6 characters!";
		}
		else
		{
			$passwordtest = $_POST['password'];
			if($passwordtest == trim($passwordtest))
			{
				$password = md5($_POST['password']);
			}
			else
			{
				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
			}
		}
		if(empty($_POST['confirmpassword']))
		{
			$emptypassworderror = "Password field cannot be empty!";
		}
		else
		{
			$passwordtest2 = $_POST['confirmpassword'];
			if($passwordtest2 == trim($passwordtest2))
			{
				$confirmpassword = md5($_POST['confirmpassword']);
			}
			else
			{
				$pwdwhitesperror = "Password cannot begin or end with an empty space!";
			}
		}

		if(isset($email) && isset($password) && isset($firstname) && isset($lastname) && isset($confirmpassword)) 
		{
			if($password == $confirmpassword)
			{
				global $connection;
				$query0 = "INSERT INTO `login` (`email`, `password`, `priority`) VALUES ('{$email}', '{$password}', '1');";
				$send_query = mysqli_query($connection, $query0);
				
				$query1 = "INSERT INTO `admin` (`first name`, `last name`, `email`) VALUES ('{$firstname}', '{$lastname}', '{$email}');";
				$send_query1 = mysqli_query($connection, $query1);

				if($send_query)
				{
					set_message("New Admin Added!");
					redirect("../../public/admin2/index.php?view_admin");
				}
				else
				{
					set_message("This E-mail is already registered!");
					redirect("../../public/admin2/index.php?add_admin");
				}
			}	
			else
			{
				$matchpwd = "Password fields don't match!";
			}
		}
	}	
}

function view_orders()
{
	global $connection;
	$query = "SELECT *, GROUP_CONCAT(products.product_title, ' ( x',order_products.quantity, ' ) <br>' SEPARATOR '') AS `grouped_product_title`, GROUP_CONCAT(order_products.quantity) AS `grouped_product_quantity` FROM orders, order_products, products, login WHERE orders.email = login.email AND orders.order_id = order_products.order_id AND products.product_id = order_products.product_id GROUP BY orders.order_date DESC";
	$send_query = mysqli_query($connection, $query);
	$blank = " ";
	while ($row = mysqli_fetch_array($send_query)) 
	{
		// $id = $row['order_id'];
		$orders = <<<DELIMETER
		<tbody>
			<tr>	
				<th scope="row"><a class="view-order" href="index.php?view_orders&id={$row['order_id']}">{$row['order_id']}</a></th>
				<td><a class="view-order rem-und" href="index.php?view_orders&id={$row['order_id']}">{$row['grouped_product_title']}</a></td>
				<td><a class="view-order rem-und" href="index.php?view_orders&id={$row['order_id']}">{$row['order_date']}</a></td>
				<td><a class="view-order rem-und" href="index.php?view_orders&id={$row['order_id']}">{$row['order_total']}</a></td>
				<td><a class="view-order rem-und" href="index.php?view_orders&id={$row['order_id']}">{$row['transaction_type']}</a></td>

				<td><div class="btn-group">
				<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{$row['order_status']}</button>
				<div class="dropdown-menu">
				<a class="dropdown-item" href="index.php?order_status&prepping&id={$row['order_id']}">PREPARING</a>
				<a class="dropdown-item" href="index.php?order_status&transit&id={$row['order_id']}">ON TRANSIT</a>
				<a class="dropdown-item" href="index.php?order_status&delivered&id={$row['order_id']}">DELIVERED</a>
</div></td>
			</tr>
		</tbody>
DELIMETER;
		echo $orders;
	}
}


function show_address_in_admin()
{
	global $connection;

	$query = "SELECT * FROM address, login, customers, orders WHERE address.email = login.email AND login.email = customers.email AND orders.address_id = address.address_id AND orders.order_id = " . $_GET['id'] . " ";
	$get_query = mysqli_query($connection , $query);

	while($row = mysqli_fetch_array($get_query)) 
	{
		if($row['alternative_contact_number'] != "0")
		{
			$alt_number = $row['alternative_contact_number'];
		}
		else
		{
			$alt_number = "";
		}
		$address = <<<ADDRESS
		<div class="card-body">
	        <h5 class="card-title">{$row['first name']} {$row['last name']}</h5>
	        <p class="card-text">{$row['address_1']}<br>{$row['address_2']}<br>{$row['city']}, {$row['state']}, {$row['pin']}<br>{$row['contact_number']}<br>{$alt_number}<br>{$row['email']}</p>
      	</div>
ADDRESS;
      	echo $address;
	}	
}

function show_payment_details()
{
	global $connection;

	$query = "SELECT * FROM orders, order_payment WHERE orders.order_id = order_payment.order_id AND order_payment.order_id = " . $_GET['id'] . " ";
	$get_query = mysqli_query($connection , $query);
	if(mysqli_num_rows($get_query) == 1)
	{ ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Order ID</th>
					<th scope="col">Transaction ID</th>
					<!-- <th scope="col">Quantity</th> -->
					<th scope="col">Transaction Status</th>
					<th scope="col">Response</th>
					<th scope="col">Bank Tnx ID</th>
					<th scope="col">Checksumhash</th>
				</tr>
			</thead>
		<?php
		while($row = mysqli_fetch_array($get_query)) 
		{
			$payment = <<<ADDRESS
			<tbody>
				<tr>
					<th scope="row">{$row['order_id']}</th>
					<td>{$row['txnid']}</td>
					<td>{$row['txnstatus']}</td>
					<td>{$row['responsemsg']}</td>
					<td>{$row['banktxnid']}</td>
					<td>{$row['checksumhash']}</td>
				</tr>
			</tbody>
ADDRESS;
	      	echo $payment;
		}	
		?></table><?php
	}
	else if(mysqli_num_rows($get_query) == 0)
	{
		$query2 = "SELECT * FROM orders WHERE orders.order_id = " . $_GET['id'] . " ";
		$get_query2 = mysqli_query($connection , $query2);

		while($row = mysqli_fetch_array($get_query2))
		{
			$cod = <<<COD

			<div class="alert alert-dark" role="alert">
			  <h4 class="alert-heading">Cash on Delivery Order</h4>
			  <hr>
			  <p>Amount to collect: <a href="#" class="alert-link">&#8377; {$row['order_total']}</a>.</p>
			</div>
COD;
			echo $cod;
		}
	}
}


function view_reports()
{
	if(isset($_POST['fromdate']) && isset($_POST['todate']))
	{
		global $connection;
		$fromdate = $_POST['fromdate'];
		$todate = $_POST['todate'];
		$query = "SELECT *, GROUP_CONCAT(products.product_title, ' ( x',order_products.quantity, ' ) <br>' SEPARATOR '') AS `grouped_product_title` FROM orders, order_products, products WHERE orders.order_id = order_products.order_id AND order_products.product_id = products.product_id AND orders.order_date > '$fromdate' AND orders.order_date < '$todate' GROUP BY orders.order_date DESC";
		$send_query = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_array($send_query)) 
		{
			$orders = <<<DELIMETER
			<tbody>
				<tr>	
					<th scope="row">{$row['order_id']}</th>
					<td>{$row['grouped_product_title']}</td>
					<td>{$row['order_total']}</td>
					<td>{$row['order_date']}</td>
					<td>{$row['transaction_type']}</td>
					<td>{$row['email']}</td>
				</tr>
			</tbody>
DELIMETER;
			echo $orders;
		}
	}
	else
	{
		set_message("Please select a range to generate report!");
		redirect("index.php?report_range");
	}
}
?>




<!-- Example single danger button -->
