<?php 

global $connection;
$query = mysqli_query($connection, "SELECT * FROM categories WHERE cat_id = " . $_GET['cat'] . " ");

while($row = mysqli_fetch_array($query))
{
	$cat_title = $row['cat_title'];
}
?>

<h1>Sub Categories of <?php echo $cat_title; ?></h1>
<!-- <hr> -->

<table class="table">
    <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Delete Sub-Category</th>
        </tr>
    </thead>
    
    <tbody>
       <?php view_subcat(); ?>
    </tbody>
</table>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button> -->

<!-- Modal -->
