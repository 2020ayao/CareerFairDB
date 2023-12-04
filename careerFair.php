<?php
// Starting the session, to use and
// store data in session variable
session_start();
require("connect-db.php");
require("careerFairDB.php");

// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

function console_log($output, $with_script_tags = true)
{
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
    ');';
  if ($with_script_tags) {
    $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}



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

//get user ID
$userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
//console_log($userID)
$list_of_career_fair_events = getAllCareerFairEvents();
//need to fix this
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['attendBtn'])) {
    // ALL WE NEED LEFT HERE IS TO INCLUDE THE APPLICANT ID HERE TOO IN ARGUMENT OF THIS FUNCTION
    // MISSING THE FIRST ARGUMENT OF APPLICANT ID
    attendCareerFairEvent($_SESSION['user_id'], $_POST['event_to_attend']);
    $list_of_career_fair_events = getAllCareerFairEvents();
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
  <title>Get started with DB programming</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>
  <?php include("header.php"); ?>

  <div class="container">
    <h1>Career Fair Events</h1>
    <hr />

    <div class="row justify-content-center">
      <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
          <tr style="background-color:#B0B0B0">
            <th width="25%">careerFairID
            <th width="25%">industry
            <th width="25%">date
            <th width="25%">Location

            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>



        <?php foreach ($list_of_career_fair_events as $career_fair_events): ?>
          <tr>

            <td>
              <?php echo $career_fair_events['careerFairID']; ?>
            </td> <!-- column name -->
            <td>
              <?php echo $career_fair_events['industry']; ?>
            </td>
            <td>
              <?php echo $career_fair_events['date']; ?>
            </td>
            <td>
              <?php echo $career_fair_events['Location']; ?>
            </td>

            <td>
              <?php
              // Check the user type
              $userType = $_SESSION['user_type'];


              // Check if the user is already attending the career event
              $isAttending = isUserAttending($_SESSION['user_id'], $career_fair_events['careerFairID']);

              // show the attend button
              if ($isAttending) {
                echo '<button class="btn btn-secondary" disabled>Already Attending</button>';
              } else {
                echo '
                <form action="careerFair.php" method="post">
                    <input type="submit" value="Attend" name="attendBtn" class="btn btn-success" />
                    <input type="hidden" name="event_to_attend" value="' . $career_fair_events['careerFairID'] . '" />
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
  </div>

  <?php include("footer.html"); ?>
</body>

</html>