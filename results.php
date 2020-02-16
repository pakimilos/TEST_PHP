<!doctype html>
<html lang="en">
  <head>
    
  <?php require 'header_part.php'; require 'functions.php';?>

    <title>Results</title>
  </head>
  <body>
  
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">PHP Quantox</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
            </button>

             <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav ml-auto">

              <?php 
                  if(isset($_SESSION['id'])):
              ?>
              <li class="nav-item">
             <a class="nav-link"  href="logout.php">Logout</a>
             </li>
              <?php 
                  else:
              ?>
             <li class="nav-item">
             <a class="nav-link"  href="login.php">Login</a>
             </li>
             <li class="nav-item">
             <a class="nav-link" href="registration.php">Register</a>
            </li>
              <?php 
                  endif
              ?>

             
            </ul>
            <form id="main-form" class="form-inline my-2 my-lg-0" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="name">
			      <select class="src_opt" name="type" style="width: 37%; margin-top: 22px; margin-right: 8px;">
               <option value=""> Select user type</option>
                    <?php
                    
                    $all_types = get_types();
                    $hierarchy = build_hierarchy($all_types);

                    display_select( $hierarchy, 0 );
                    ?>

              </select>
            <button id="main-btn" class="btn btn-outline-success my-2 my-sm-1" type="submit" name="search-btn">Search</button>
            </form>
            </div>
        </div>
 </nav>


                    <div class="container">
                      <div class="row">
                        <div class="col-4 offset-4 text-center">
                          <?php 
                          if(isset($_SESSION['name'])) {?>
                              <h3 id='welcomee'> Welcome, <?php echo $_SESSION['name']; ?> </h3>
                         <?php }

                          ?>
                            
                          </div>
                        </div>
                     

                      <div class="row justify-content-center">
                        <div class="col-5 offset-1 pt-3 my-4 bg-dark rounded ml-1">
                                  <?php
                                    $all_types = get_types();
                                    $hierarchy = build_hierarchy($all_types);
                                    //print_r($hierarchy );
                                    //var_dump($hierarchy );
                                    display_types($hierarchy);
                                  ?>
                        </div>
                        <div class="col-5 pt-3 my-4 bg-light rounded ml-1">
                          <?php
                      
                            if (isset($_GET["search-btn"])) {
                           
                            $name = $_GET['name'];
                            $type = $_GET['type'];
                            
						              	$results = search($name, $type);
                                echo "<ul class='results'>";
                                foreach($results as $key => $result){
								              	echo "<li>".$result['name']." ". $result['email']. "</li>" ;
						              		}
							                 	echo "</ul>";
                             }

                            ?>
                 </div>
           </div>
      </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>