<?php
require("connect-db.php");
require("jobpostings-db.php");


// Starting the session, to use and
// store data in session variable
session_start();

// If the session variable is empty, this 
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['user_id'])) {
  $_SESSION['msg'] = "You have to log in first";
  header('location: login.php');
}

// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after logging out
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user_id']);
  header("location: login.php");
}

$list_of_jobs = getAllJobs();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['applyBtn'])) {
    applyToJob($_SESSION['user_id'], $_POST['job_to_apply']);
    $list_of_jobs = getAllJobs();
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">
  <title>Job Postings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>
  <?php include("header.html"); ?>
  <div class="container">
    <h1>Job Postings</h1>

    <hr />
    <h3>List of jobs</h3>
    <div class="row justify-content-center">
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
          <tr style="background-color:#B0B0B0">
            <th width="30%">Title
            <th width="25%">Industry
            <th width="20%">Pay
            <th width="30%">Company
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>

        <?php foreach ($list_of_jobs as $job): ?>
          <tr>
            <td><?php echo $job['title']; ?></td>
            <td><?php echo $job['industry']; ?></td>
            <td><?php echo $job['pay']; ?></td>
            <td><?php echo $job['company']; ?></td>
            <td>
              <?php
            // Check if the user has already applied to this job
              $hasApplied = hasUserApplied($_SESSION['user_id'], $job['jobID']);
              
              if ($hasApplied) {
                  echo '<button class="btn btn-secondary" disabled>Applied already</button>';
              } else {
                  // If not applied, show the Apply button
                  echo '
                      <form action="jobpostings.php" method="post">
                          <input type="submit" value="Apply" name="applyBtn" class="btn btn-success" />
                          <input type="hidden" name="job_to_apply" value="' . $job['jobID'] . '" />
                      </form>
                  ';
              }
              ?>
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

  <?php include("footer.html"); ?>
</body>

</html>