
<?php 

global $connection;

if(isset($_GET['id'])) 
{
  $id = $_GET['id'];
  $query = "SELECT * FROM products WHERE product_id = " . $id . " ";
  $select_product = mysqli_query($connection, $query);

  while($row = mysqli_fetch_array($select_product)) 
  {

    $product_title          = escape_string($row['product_title']);

    $product_price          = escape_string($row['product_price']);
    $product_description    = escape_string($row['product_desc']);

    $product_quantity       = escape_string($row['product_limit']);
    $product_image          = escape_string($row['product_image']);

  }

update_product();

}

?>



<h1>Edit Product</h1>
<hr>

<div class="row">
  <div class="col-lg-12">
    

               


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label for="product-title">Product Title </label>
      <input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>" required>
       
    </div>

    <div class="form-group">
      <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?php echo $product_description; ?></textarea>
    </div>

    <div class="form-group">
      <label for="product-price">Product Price</label>
      <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $product_price; ?>" required>
    </div>

    <div class="form-group">
          <label for="product-title">Product Sub-Category </label>

          <select name="product_subcategory_id" id="" class="form-control">

            <?php show_subcategories_add_product_page(); ?>
    
          </select>
    </div>

    <div class="form-group">
      <label for="product-title">Product Limit</label>
        <input type="number" name="product_limit" class="form-control" value="<?php echo $product_quantity; ?>">
    </div>

    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="prodfile">        
        <br> 
        <label>Current image:</label>
        <br>

        <img width='200' src="../<?php echo $product_image; ?>" alt="">
      
    </div>

    <div class="form-group">
      <!-- <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft"> -->
      <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
    </div>




    
</form>
  </div>
</div>