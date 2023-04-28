#!/usr/local/bin/php

<?php

function debugLog($num) {
    // echo "SEBLOGS " . $num . "\n";
}

$debug = 0;

$config = parse_ini_file("../db_config.ini");
$link = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
$link->set_charset('utf8mb4');
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    debugLog(++$debug);
 
    // Validate username and email
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
        debugLog(++$debug);
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
        debugLog(++$debug);
    } elseif(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
        debugLog(++$debug);
    } elseif(!preg_match('/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/', trim($_POST["email"]))){
        $email_err = "Email is invalid.";
        debugLog(++$debug);
    } else{
        debugLog(++$debug);
        // Prepare a select statement
        $sql = "SELECT Email FROM Test WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = htmlspecialchars(trim($_POST["email"]));
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "A user with that email already exists.";
                } else{
                    $email = htmlspecialchars(trim($_POST["email"]));
                    $username = htmlspecialchars(trim($_POST["username"]));
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            debugLog(++$debug);
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
        debugLog(++$debug);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["verifyPassword"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["verifyPassword"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        debugLog(++$debug);
        
        // Prepare an insert statement
        $sql = "INSERT INTO Test VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: ../index.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                die;
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);

    echo $username_err;
    echo $email_err;
    echo $password_err;
    echo $confirm_password_err;
}
?>
