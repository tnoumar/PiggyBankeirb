<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password =  "";
$username_err = $password_err = $confirm_password_err = $email_err=$nom_err=$prenom_err=$date_err="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT user_id FROM USERS WHERE pseudo = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            //Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){// motdepasse doit dépasser 6 caracteres et ouais
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }


    //validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    }
    else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){// email doit etre valide mon grand
        $email_err = "Please enter a correct email";
    } else{
        $email = $_POST["email"];
    }
//validate date
    if(empty($_POST["birth"])){
        $date_err = "Please enter your date of birth.";

    } else{
        $birth = $_POST["birth"];
    }

    //validate prenom
    if(empty($_POST["prenom"])){
        $prenom_err = "Please enter your prenom.";

    } else{
        $prenom = $_POST["prenom"];
    }
    //validate nom
    if(empty($_POST["nom"])){
        $nom_err = "Please enter your name.";

    } else{
        $nom = $_POST["nom"];
    }
    //Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)  && empty($email_err) && empty($nom_err) && empty($prenom_err) && empty($date_err)){
        $param_username = $username;
        $param_password = $password;
        $param_email=$email;
        $param_birth=$birth;
        $param_prenom=$prenom;
        $param_nom=$nom;
        //Prepare an insert statement
        $sql = "INSERT INTO USERS (pseudo, passwd,email, birth,prenom, nom) VALUES ('$param_username', '$param_password','$param_email','$param_birth', '$param_prenom','$param_nom')";

        if($stmt = mysqli_prepare($link, $sql)){
            //Bind variables to the prepared statement as parameters


            //Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo"you are now registered";
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            //Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>






    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="./images/ico/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/ico/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/ico/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="./images/ico/favicon_io/site.webmanifest">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">


</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>enter email</label>
                <input type="mail" name="email" class="form-control" >
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>enter dateof birth </label>
                <input type="date" name="birth" class="form-control" >
                <span class="help-block"><?php echo $date_err; ?></span>
            </div>
            <div class="form-group">
                <label>enter prenom</label>
                <input type="text" name="prenom" class="form-control" >
                <span class="help-block"><?php echo $prenom_err; ?></span>
            </div>
            <div class="form-group">
                <label>enter nom</label>
                <input type="text" name="nom" class="form-control" >
                <span class="help-block"><?php echo $nom_err; ?></span>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">

            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
