<?php
// Starting the session, to use and
// store data in session variable
session_start();
require("connect-db.php");
require("applied-db.php");

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');



// If the session variable is empty, this 
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['user_id'])) {
  $_SESSION['msg'] = "You have to log in first";
  header('location: login.php');
  exit();
}

// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after logging out
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user_id']);
  header("location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['withdrawBtn'])) {
  $jobIdToWithdraw = $_POST['job_to_withdraw'];
  withdrawApplication($_SESSION['user_id'], $jobIdToWithdraw);
  $appliedJobs = getAllApplied(); // Refresh the list of applied jobs after withdrawal
}

$list_of_jobs_applied = getAllApplied();
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
    <h1>Jobs Applied</h1>
    <hr />

    <div class="row justify-content-center">
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
          <tr style="background-color:#B0B0B0">
            <th width="20%">Title
            <th width="20%">Industry
            <th width="20%">Pay
            <th width="20%">Company
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>


        <?php foreach ($list_of_jobs_applied as $applies): ?>
          <tr>
            <td>
              <?php echo $applies['title']; ?>
            </td> <!-- column name -->
            <td>
              <?php echo $applies['industry']; ?>
            </td>
            <td>
              <?php echo $applies['pay']; ?>
            </td>
            <td>
              <?php echo $applies['company']; ?>
            </td>
            <td>
              <form action="applied.php" method="post">
                <input type="submit" value="Withdraw" name="withdrawBtn" class="btn btn-danger" />
                <input type="hidden" name="job_to_withdraw" value="<?php echo $applies['jobID']; ?>" />
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>



    <!-- CDN for JS bootstrap -->
    <!-- you may also use JS bootstrap to make the page dynamic -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"></script>

    <!-- for local -->
    <!-- <script src="your-js-file.js"></script> -->

  </div>
  </div>

  <?php include("footer.html"); ?>
</body>

</html>