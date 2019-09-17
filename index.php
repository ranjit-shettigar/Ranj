<?php require_once("../../resources/config.php"); ?>

<?php 

if(!isset($_SESSION['empname']))
{
	redirect("../login");
} 

?>

<?php include("../../resources/userend/employee/header.php"); ?>

  <div id="wrapper">
  	
    <!-- Sidebar -->
    <?php include("../../resources/userend/employee/side_nav.php"); ?>
    <!-- Sidebar -->

    <div id="content-wrapper">

      <div class="container-fluid">

      <?php 
      if($_SERVER['REQUEST_URI'] == "/carou/public/employee/" || $_SERVER['REQUEST_URI'] == "/carou/public/employee/index.php") 
      {

        include("../../resources/userend/employee/admin_content.php");

      }
      if(isset($_GET['orders']))
      {

        include("../../resources/userend/employee/orders.php");

      }

      if(isset($_GET['categories'])){

        include("../../resources/userend/employee/categories.php");

      }
      
      if(isset($_GET['add_category'])){

        include("../../resources/userend/employee/add_category.php");

      }
      
      if(isset($_GET['add_subcat'])){

        include("../../resources/userend/employee/add_subcat.php");

      }


      if(isset($_GET['products'])){


        include("../../resources/userend/employee/products.php");


      }


      if(isset($_GET['add_product'])){


        include("../../resources/userend/employee/add_product.php");


      }


      if(isset($_GET['edit_product'])){


        include("../../resources/userend/employee/edit_product.php");


      }

      if(isset($_GET['users'])){


        include("../../resources/userend/employee/users.php");


      }


      if(isset($_GET['add_user'])){


        include("../../resources/userend/employee/add_user.php");


      }


      if(isset($_GET['edit_user'])){


        include("../../resources/userend/employee/edit_user.php");


      }


      if(isset($_GET['reports'])){


        include("../../resources/userend/employee/reports.php");


      }

      if(isset($_GET['slides'])){


        include("../../resources/userend/employee/slides.php");


      }


      if(isset($_GET['delete_order_id'])){


        include("../../resources/userend/employee/delete_order.php");


      }

      if(isset($_GET['delete_product_id'])){


        include("../../resources/userend/employee/delete_product.php");


      }

      if(isset($_GET['delete_category_id'])){


        include("../../resources/userend/employee/delete_category.php");


      }


      if(isset($_GET['delete_report_id'])){

        include("../../resources/userend/employee/delete_report.php");

      }

      if(isset($_GET['delete_user_id'])){

        include("../../resources/userend/employee/delete_user.php");

      }


      if(isset($_GET['delete_slide_id']))
      {

        include("../../resources/userend/employee/delete_slide.php");

      }

      if(isset($_GET['disp_subcat']))
      {

        include("../../resources/userend/employee/disp_subcat.php");

      }

      if(isset($_GET['view_subcat']))
      {

        include("../../resources/userend/employee/view_subcat.php");

      }
      if(isset($_GET['select_category']))
      {

        include("../../resources/userend/employee/select_category.php");

      }
      if(isset($_GET['view_employee']))
      {

        include("../../resources/userend/employee/view_employee.php");

      }
      if(isset($_GET['add_employee']))
      {

        include("../../resources/userend/employee/add_employee.php");

      }
      if(isset($_GET['view_admin']))
      {

        include("../../resources/userend/employee/view_admin.php");

      }
      if(isset($_GET['add_admin']))
      {

        include("../../resources/userend/employee/add_admin.php");

      }
      if(isset($_GET['view_customer']))
      {

        include("../../resources/userend/employee/view_customer.php");

      }
      if(isset($_GET['unblock_customer']))
      {

        include("../../resources/userend/employee/unblock_customer.php");

      }
      if(isset($_GET['transaction_status']))
      {

        include("../../resources/userend/employee/transaction_status.php");

      }
      if(isset($_GET['order_status']))
      {

        include("../../resources/userend/employee/order_status.php");

      }
      if(isset($_GET['view_orders']))
      {

        include("../../resources/userend/employee/view_orders.php");

      }
      if(isset($_GET['add_pincode']))
      {

        include("../../resources/userend/employee/add_pincode.php");

      }
      
      ?>
        
      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



  <!-- Bootstrap core JavaScript-->
  <script src="../admin2/vendor/jquery/jquery.min.js"></script>
  <script src="../admin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../admin2/js/sb-admin.min.js"></script>

<script type="text/javascript">
	document.getElementByClassName("modal")
    .addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementByClassName("btn").click();
    }
});
</script>

</body>

</html>
