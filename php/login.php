#!/usr/bin/env php

<?php
session_start();
 
// Check if the user is already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}

$config = parse_ini_file("../db_config.ini");

$link = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

$email = $password = "";
$email_err = $password_err = $login_err = "";

if(array_key_exists("error", $_GET)){
   $login_err = "Please login first.";
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
  if(empty(trim($_POST["email"]))){
      $email_err = "Please enter email.";
  } else{
      $email = trim($_POST["email"]);
  }
  
  if(empty(trim($_POST["password"]))){
      $password_err = "Please enter your password.";
  } else{
      $password = trim($_POST["password"]);
  }
  
  if(empty($email_err) && empty($password_err)){
      $sql = "SELECT UserId, Email, Password FROM dev_users WHERE email = ?";
      
      if($stmt = mysqli_prepare($link, $sql)){
          mysqli_stmt_bind_param($stmt, "s", $param_email);
          
          $param_email = $email;
          
          if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_store_result($stmt);
              
              if(mysqli_stmt_num_rows($stmt) == 1){                    
                  mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                  if(mysqli_stmt_fetch($stmt)){
                      if(password_verify($password, $hashed_password)){
                          session_start();
                          
                          $_SESSION["loggedin"] = true;
                          $_SESSION["id"] = $id;
                          $_SESSION["email"] = $email;                            
                          
                          header("location: ../index.php");
                      } else{
                          $login_err = "Invalid email or password.";
                      }
                  }
              } else{
                  $login_err = "Invalid email or password.";
              }
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }

          mysqli_stmt_close($stmt);
      }
  }
  
  mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in to Wagwan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <br>
                    <img src="./WagwanLogo.png" class="rounded mx-auto d-block" alt="WagwanLogo" width="70" height="70"></img>
                    <br>
                    <h1 style="text-align:center">Wagwan</h1>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col-md-auto">
                    <h6 class="font-weight-light">Log in with your Email</h6>
                </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                    <p class="text-danger" id="email_err"><?php echo $email_err; ?></p>
                </div>   
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <p class="text-danger" id="password_err"><?php echo $password_err; ?></p>
                </div>
                <div class="col text-center">
                <p class="text-danger" id="password_err"><?php echo $login_err; ?></p>
                    <br>
                    <input type="submit" class="btn btn-dark" value="Login">
                    <input type="reset" class="btn btn-danger ml-2" value="Reset">
                    <br><br>
                    <p>Don't have an account? <a href="./signup.php">Sign up here</a>.</p>
                </div>
            </form>
        </div>    
    </div>
</body>
</html>