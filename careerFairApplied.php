<?php
require("connect-db.php");
require("careerFairDB.php"); // Assuming you have a similar file for career fair operations

error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id']);
    header("location: login.php");
}

// Assuming you have a similar function to withdraw from a career fair
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['withdrawBtn'])) {
    $careerFairIdToWithdraw = $_POST['career_fair_to_withdraw'];
    withdrawCareerFair($_SESSION['user_id'], $careerFairIdToWithdraw);
    $appliedCareerFairs = getAllAppliedCareerFairs(); // Refresh the list after withdrawal
}

$list_of_career_fairs_applied = getAllAppliedCareerFairs();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="your name">
    <meta name="description" content="include some description about your page">
    <title>Get started with DB programming</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>

    <?php include("header.php"); ?>

    <div class="container">
        <h1>Career Fairs Applied</h1>
        <hr />

        <div class="row justify-content-center">
            <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
                <thead>
                    <tr style="background-color:#B0B0B0">
                        <th width="20%">Industry
                        <th width="20%">Date
                        <th width="20%">Location
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <?php foreach ($list_of_career_fairs_applied as $appliedFair): ?>
                    <tr>
                        <td>
                            <?php echo $appliedFair['industry']; ?>
                        </td>
                        <td>
                            <?php echo $appliedFair['date']; ?>
                        </td>
                        <td>
                            <?php echo $appliedFair['location']; ?>
                        </td>
                        <td>
                            <form action="careerFairApplied.php" method="post">
                                <input type="submit" value="Withdraw" name="withdrawBtn" class="btn btn-danger" />
                                <input type="hidden" name="career_fair_to_withdraw"
                                    value="<?php echo $appliedFair['careerFairID']; ?>" />
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Similar scripts and footer as your appliedJobs.php -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    </div>

    <?php include("footer.html"); ?>
</body>

</html>