<?php
session_start();
require("connect-db.php");
require("createjob-db.php");

// Starting the session, to use and
// store data in the session variable


// If the session variable is empty, this 
// means the user is yet to log in
// The user will be sent to 'login.php' page
// to allow the user to log in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
    exit();
}

// Logout button will destroy the session, and
// will unset the session variables
// The user will be headed to 'login.php'
// after logging out
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id']);
    header("location: login.php");
    exit();
}



// Assuming you have a user_type in your session variable
$companyID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

// Retrieve the name of the company based on user_id
$companyName = getCompanyName($companyID);

$title = $industry = $pay = "";
$title_err = $industry_err = $pay_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    if (empty(trim($_POST["title"]))) {
        $title_err = "Please enter the job title.";
    } else {
        $title = trim($_POST["title"]);
    }

    // Validate industry
    if (empty(trim($_POST["industry"]))) {
        $industry_err = "Please enter the industry.";
    } else {
        $industry = trim($_POST["industry"]);
    }

    // Validate pay
    if (empty(trim($_POST["pay"]))) {
        $pay_err = "Please enter the pay for the job.";
    } else {
        $pay = trim($_POST["pay"]);
    }

    if (!empty($_POST['createBtn'])) {
        $success = createJob($title, $industry, $pay, $companyName, $companyID);
        if ($success) {
            // Redirect to jobpostings.php
            header("location: jobpostings.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="your name">
    <meta name="description" content="include some description about your page">
    <title>Recruiters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container">
        <h1>Create Job</h1>

        <hr />
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title"
                    class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $title; ?>">
                <span class="invalid-feedback">
                    <?php echo $title_err; ?>
                </span>
            </div>

            <br>

            <div class="form-group">
                <label>Industry</label>
                <input type="text" name="industry"
                    class="form-control <?php echo (!empty($industry_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $industry; ?>">
                <span class="invalid-feedback">
                    <?php echo $industry_err; ?>
                </span>
            </div>

            <br>

            <div class="form-group">
                <label>Pay</label>
                <input type="text" name="pay" class="form-control <?php echo (!empty($pay_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $pay; ?>">
                <span class="invalid-feedback">
                    <?php echo $pay_err; ?>
                </span>
            </div>

            <br>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create Job" name="createBtn">
            </div>
        </form>
    </div>
</body>
<?php include("footer.html"); ?>

</html>