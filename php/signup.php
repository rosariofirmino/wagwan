#!/usr/local/bin/php

<?php

function debugLog($txt)
{
    // echo "SEBLOGS: " . $txt . "\n";
}

$config = parse_ini_file("../db_config.ini");
$link = new mysqli($config["servername"], $config["username"], $config["password"], $config["dbname"]);
$link->set_charset('utf8mb4');
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$username = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username and email
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    }
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!preg_match('/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/', trim($_POST["email"]))) {
        $email_err = "Email is invalid.";
    } else {
        $sql = "SELECT Email FROM dev_users WHERE Email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = htmlspecialchars(trim($_POST["email"]));

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "A user with that email already exists.";
                } else {
                    $email = htmlspecialchars(trim($_POST["email"]));
                    $username = htmlspecialchars(trim($_POST["username"]));
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must contain at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["verifyPassword"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["verifyPassword"]);
        if (($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
            $confirm_password = "";
        }
    }

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        $sql = "INSERT INTO dev_users VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;
            $param_prof_pic = "default.jpg"; // Default profile picture for new users
            $param_date = date("Y-m-d");

            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_email, $param_prof_pic, $param_date);

            if (mysqli_stmt_execute($stmt)) {
                session_start();

                $_SESSION["loggedin"] = true;
                $_SESSION["email"] = $param_email;
                $_SESSION["id"] = $param_username;
                $_SESSION["ProfilePic"] = $param_prof_pic; // ProfilePic is a directory to image
                header("location: ../actions/send_email.php?email=" . $param_email);

            } else {
                echo "Oops! Something went wrong. Please try again later.";
                die;
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
    <title>Sign Up for Wagwan</title>
    <link rel="icon" href="../homepage/hp/icon.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="../js/error_ajax.js"></script>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <br>
                    <img src="./WagwanLogo.png" class="rounded mx-auto d-block" alt="WagwanLogo" width="70" height="70">
                    <br>
                    <h1 style="text-align:center">Wagwan</h1>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col-md-auto">
                    <h6 class="font-weight-light">Sign up with your Email</h6>
                </div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" onkeyup="email_err(this.value)"
                        class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $email; ?>">
                    <p class="text-danger" id="email_err">
                        <?php echo $email_err; ?>
                    </p>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" onkeyup="username_err(this.value)"
                        class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $username; ?>">
                    <p class="text-danger" id="username_err">
                        <?php echo $username_err; ?>
                    </p>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" onkeyup="password_err(this.value)"
                        class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $password; ?>">
                    <p class="text-danger" id="password_err">
                        <?php echo $password_err; ?>
                    </p>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="verifyPassword"
                        onkeyup="ver_password_err(document.getElementById('password').value, this.value)"
                        class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>"
                        value="<?php echo $confirm_password; ?>">
                    <p class="text-danger" id="ver_password_err">
                        <?php echo $confirm_password_err; ?>
                    </p>
                </div>
                <div class="col text-center">
                    <br>
                    <input type="submit" class="btn btn-dark" value="Sign Up">
                    <input type="reset" class="btn btn-danger ml-2" value="Reset">
                    <br><br>
                    <p>Already have an account? <a href="./login.php">Login here</a>.</p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>