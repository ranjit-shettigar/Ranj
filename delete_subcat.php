<?php require_once("../../config.php");


if(isset($_GET['id'])) {
echo $_GET['id'];
$query = mysqli_query($connection, "DELETE FROM categories WHERE categories.cat_id=products.cat_id AND categories.cat_id = " . $_GET['id'] . " ");
echo mysqli_error($connection);
// confirm($query);

// if(mysqli_affected_rows($query) > 0)
// {
// 	set_message("CATEGORY DELETED");
// 	redirect("../../../public/admin2/index.php?categories");
// }
// else
// {
// 	redirect("../../../public/admin2/index.php?add_subcat");
// }

}




 ?>