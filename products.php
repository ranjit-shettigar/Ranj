
<h1 class="page-header">All Products</h1>
<br>
<?php display_message(); ?>
<table class="table table-hover">


    <thead>

      <tr>
           <th>ID</th>
           <th>Title</th>
           <th></th>
           <th>Category</th>
           <th>Sub-Category</th>
           <th>Price</th>
      </tr>
    </thead>
    <tbody>

      
      <?php get_products_in_admin(); ?>


  </tbody>
</table>



