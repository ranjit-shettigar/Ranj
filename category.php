<?php require_once("C:/xampp/htdocs/carou/resources/config.php") ?>
<?php set_error_handler("customError"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="images/top-logo.png">
<title>Drnklab Online</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- <link href="custom/carousel.css" rel="stylesheet"> -->
<!-- CUSTOM CSS --> 
<link rel="stylesheet" type="text/css" href="custom/custom.css">

<link rel="stylesheet" type="text/css" href="custom/category.css">
<style type="text/css"> 
</style>
</head>
<body>

  	<!-- NAV -->
    <?php include(TEMPLATE_FRONT . "/topnav.php"); ?>   
    <!-- NAV -->

    <!-- Page Content -->
    <div class="container">

      <div class="row row-2">

		<!-- NAV -->
		<?php include(TEMPLATE_FRONT . "/sidenav.php"); ?>   
		<!-- NAV -->
      
          
          <div class="col-lg-9"> <!-- BANNER CAROUSELS AND ITEMS -->
          	<?php 

			if(isset($_GET['id']) && isset($_GET['num'])) 
			{
				get_subcat_title(); 
			}
			else
			{
				get_cat_title();
			}
			
			?>
          <div class="row banner">  <!--  FOR BANNER CAROUSELS -->
            <div class="col-md-6">  <!-- 1ST BANNER CAROUSEL -->

              <!-- <div id="carouselExampleIndicators" class="banner-img carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <img class="d-block img-fluid" src="http://placehold.it/500x350" alt="First slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="http://placehold.it/500x350" alt="Second slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="http://placehold.it/500x350" alt="Third slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
 -->
              <!-- <img class="img-fluid banner-img" src="http://placehold.it/500x350" alt="offer"> -->

            </div>    <!-- 1ST BANNER CAROUSEL -->

            <div class="col-md-6">  <!-- 2ND BANNER CAROUSEL -->
              
              <!-- <div id="carouselExampleIndicators-2" class="banner-img carousel slide my-4" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators-2" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators-2" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators-2" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <img class="d-block img-fluid" src="http://placehold.it/500x350" alt="First slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="http://placehold.it/500x350" alt="Second slide">
                  </div>
                  <div class="carousel-item">
                    <img class="d-block img-fluid" src="http://placehold.it/500x350" alt="Third slide">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators-2" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators-2" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div> -->
              
                <!-- <img class="img-fluid banner-img" src="http://placehold.it/500x350" alt="offer"> -->
              

            </div>    <!-- 2ND BANNER CAROUSEL -->
          </div>


          <div class="row" id="anotherdiv"> <!-- FOR ITEMS -->
            
            <?php 

            if(isset($_GET['id']) && isset($_GET['num'])) 
            {
            	get_product_for_cat();            	
            }
            else 
            {
            	get_product();
            }

            ?>   <!-- DISPLAYS ALL PRODUCTS FROM DB -->

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

  	<!-- FOOTER -->
    
    <?php include(TEMPLATE_FRONT . "/footer.php"); ?>

    <!-- FOOTER -->

  <!-- BOOTSTRAP JS START-->
  <!-- JQUERY -->
  <script type="text/javascript" src="js/bootstrap.jquery.js"></script>
  <!-- POPPER -->
  <script type="text/javascript" src="js/bootstrap.popper.js"></script>
  <!-- JS -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- BOOSTRAP JS END -->

  </body>

</html>
