<h1>Add New Category</h1>
<hr>

<?php add_category(); ?>

<div class="col-md-4">

    <p class="bg-success"><?php display_message(); ?></p>
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input name="cat_title" type="text" class="form-control">
        </div>

        <div class="form-group">
            
            <input name="add_category" type="submit" class="btn btn-primary" value="Add Category">
        </div>      

    </form>

</div>