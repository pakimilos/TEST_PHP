<!doctype html>
<html lang="en">
  <head>
    
  <?php require 'header_part.php'; require 'functions.php'; ?>

    <title>Register</title>
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
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button id="main-btn" class="btn btn-outline-success my-2 my-sm-1" type="submit" name="search-btn">Search</button>
            </form>
            </div>
        </div>
 </nav>


 



 <div class="box">
          <h2>Register</h2>

          <form action="" method="POST">
              <div class="inputBox">

                  <label for="">Name</label>
                  <input type="text" name="name">
                  
              </div> 

              <div class="inputBox">

                  <label for="">E-mail</label>
                  <input type="email" name="email">
                  
              </div>

              <div class="inputBox">

                  <label for="">Password</label>
                  <input type="password" name="password">
                  
              </div>

              <div class="inputBox">

                  <label for="">Repeat password</label>
                  <input type="password" name="re-password">
                  
              </div>

              <div class="inputBox">
              <label for="">User type</label>
              <select name="type">
                <option value=""> Select user type</option>

                    <?php
                    
                    $all_types = get_types();
                    $hierarchy = build_hierarchy($all_types);

                    display_select( $hierarchy, 0 );
                    ?>

             </select>

              </div>
              <input id="btnx" type="submit" name="signup" value="Register">
              <label id="lblreg" for="">Already have an account? <a href="login.php"><strong style="color: black" >Sign in here</strong></a></label>
          </form>

          <?php 
            
            if(isset($_POST['signup'])){

                $name = '';
                $email = '';
                $password = '';
                $type = '';

                if(isset($_POST['name']) && !empty($_POST['name'])){
                    $name = $_POST['name'];
                }else{
                    echo "<div class='alert alert-danger' role='alert'> Name is required field</div>"; die;
                }

                if(isset($_POST['email']) && !empty($_POST['email'])){
                    $email = $_POST['email'];
                }else{
                    echo "<div class='alert alert-danger' role='alert'> E-mail is required field</div>"; die;
                }
                
                if(isset($_POST['password']) && !empty($_POST['password'])){
                    $password = $_POST['password'];
                }else{
                    echo "<div class='alert alert-danger' role='alert'> Password is required field</div>"; die;
                }
                
                if(isset($_POST['re-password']) && !empty($_POST['re-password'])){
                    if($password != $_POST['re-password']){
                        echo "<div class='alert alert-danger' role='alert'> Password do not match</div>"; die;
                    }
                }else{
                    echo "<div class='alert alert-danger' role='alert'> Repeat password is required field</div>"; die;
                }

                if(isset($_POST['type']) && !empty($_POST['type'])){
                    $type = $_POST['type'];
                }else{
                    echo "<div class='alert alert-danger' role='alert'> Type is required field</div>"; die;
                }

                echo add_user($name, $email, $password, $type);
                

            }
     

        ?>
            
      </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>