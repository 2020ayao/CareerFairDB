<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require("connect-db.php");

$email = $password = "";
$email_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginbtn'])) {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Check in the Applicant table
        $sql_applicant = $db->prepare("SELECT * FROM `Applicant` WHERE `email` = ?");
        $sql_applicant->bindParam(1, $email, PDO::PARAM_STR);
        $sql_applicant->execute();
        $fetch_applicant = $sql_applicant->fetch();

        // Check in the Recruiter table
        $sql_recruiter = $db->prepare("SELECT * FROM `Recruiter` WHERE `email` = ?");
        $sql_recruiter->bindParam(1, $email, PDO::PARAM_STR);
        $sql_recruiter->execute();
        $fetch_recruiter = $sql_recruiter->fetch();

        // Check in the Company table
        $sql_company = $db->prepare("SELECT * FROM `Company` WHERE `email` = ?");
        $sql_company->bindParam(1, $email, PDO::PARAM_STR);
        $sql_company->execute();
        $fetch_company = $sql_company->fetch();

        if ($fetch_applicant) {
            // Applicant login
            $passHash = $fetch_applicant['password'];
            echo "<h2>" . $passHash . "</h2>";
            if (password_verify($password, $passHash)) {
                // if (true) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $fetch_applicant['applicantID'];
                $_SESSION['user_type'] = 'applicant';
                header("location: jobpostings.php");
                exit;
            } else {
                $login_err = 'Password incorrect!';
            }
        } elseif ($fetch_recruiter) {
            // Recruiter login
            $passHash = $fetch_recruiter['password'];
            if (password_verify($password, $passHash)) {
                // if (true) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $fetch_recruiter['recruiterID'];
                $_SESSION['user_type'] = 'recruiter';
                header("location: recruiter.php");
                exit;
            } else {
                $login_err = 'Password incorrect!';
            }
        } elseif ($fetch_company) {
            // Company login
            $passHash = $fetch_company['password'];
            if (password_verify($password, $passHash)) {
                // if (true) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $fetch_company['companyID'];
                $_SESSION['user_type'] = 'company';
                header("location: jobpostings.php");
                exit;
            } else {
                $login_err = 'Password incorrect!';
            }
        } else {
            $login_err = 'Email does not exist!';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                    class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $email; ?>">
                <span class="invalid-feedback">
                    <?php echo $email_err; ?>
                </span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                    class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback">
                    <?php echo $password_err; ?>
                </span>
            </div>
            <div class="form-group">
                <input type="submit" name="loginbtn" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>

</html>