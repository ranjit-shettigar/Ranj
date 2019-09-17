<?php add_product(); ?>
<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Add Product
</h1>
</div>
               
<hr>

<form action="" method="post" enctype="multipart/form-data">

<div class="col-md-8">

    <div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" id="validationCustom01" placeholder="Item Name" class="form-control" required>
      <div class="invalid-feedback">
        Please provide your name.
      </div>
    </div>


    <div class="form-group">
      <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60" required>
      </div>
    </div>

    <div class="form-group">
         <label for="product-title">Product Sub-Category</label>

        <select name="product_subcategory_id" id="" class="form-control" required>
            <option value="">Select Category</option>

            <?php show_subcategories_add_product_page(); ?>
           
        </select>
    </div>

    <div class="form-group">
      <label for="product-title">Product Limit (Default value 10)</label>
        <input type="number" name="product_limit" value="10" class="form-control">
    </div>

    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="prodfile" required>
      
    </div>



    <div class="form-group">
     <!-- <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft"> -->
      <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
    </div>

</div>

    
</form>
