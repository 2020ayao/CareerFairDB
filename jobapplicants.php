<?php
// Include necessary files and functions
require("connect-db.php");
require("jobapplicants-db.php");

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
    exit();
}

// Check if the user is a company
if ($_SESSION['user_type'] !== 'company') {
    // Redirect to an appropriate page or show an error message
    header('location: error.php');
    exit();
}

// Get the job ID from the request
$jobID = isset($_GET['jobID']) ? $_GET['jobID'] : null;

// Get job details and applicants
$job = getJobDetails($jobID);
$applicants = getJobApplicants($jobID);
?>

<!DOCTYPE html>
<html lang="en">

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
    <?php include("header.php"); ?>
    <div class="container">
    <h1>Job Applicants for <?php echo $job['title']; ?></h1>

    <hr />
    <div class="row justify-content-center">
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
          <tr style="background-color:#B0B0B0">
            <th width="30%">Username
            <th width="25%">Email
            <!-- <th width="20%">Pay
            <th width="30%">Company -->
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <?php
          foreach ($applicants as $applicant): ?>
            <tr>
                <td><?php echo $applicant['username']; ?></td>
                <td><?php echo $applicant['email']; ?></td>
            </tr>
        <?php endforeach ?>
        <?php include("footer.html"); ?>
      </table>
    </div>


    <!-- Add your JavaScript or link Bootstrap JS if needed -->
</body>


</html>
