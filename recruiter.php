<?php
require("connect-db.php");
require("recruiter-db.php");

// Starting the session, to use and
// store data in session variable
session_start();

// If the session variable is empty, this 
// means the user is yet to log in
// User will be sent to 'login.php' page
// to allow the user to log in
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

// Assuming you have a user_type in your session variable
$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : '';

// Get recruiters based on user type
if ($userType === 'company') {
    // Get recruiters by company ID
    $list_of_recruiters = getRecruitersByCompanyId($_SESSION['user_id']);
} else {
    // Get all recruiters
    $list_of_recruiters = getAllRecruiters();
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>
<body>

<?php include("header.php"); ?>
<div class="container">
  <h1>Recruiters</h1>
  <hr/>

  <div class="row justify-content-center">  
    <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
      <thead>
        <tr style="background-color:#B0B0B0">
          <th width="20%">Company Name</th>
          <th width="20%">Name</th>        
          <th width="20%">Email</th>    
          <th width="20%">Phone Number</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
      </thead>

      <?php foreach ($list_of_recruiters as $recruiter): ?>
        <tr>
          <td>
            <?php
                if ($_SESSION['user_type'] === 'company') {
                    // Assuming the company name is in the 'Company' table and linked through 'companyID'
                    $companyId = $recruiter['companyID'];
                    $query = "SELECT name FROM Company WHERE companyID = :companyId";
                    $statement = $db->prepare($query);
                    $statement->bindParam(':companyId', $companyId);
                    $statement->execute();
                    $companyName = $statement->fetchColumn();
                    echo $companyName;
                } else {
                    // If the user type is not 'company', use the existing 'company' array key
                    echo $recruiter['name'];
                }
            ?>
          </td>
          <td>
            <?php 
                if ($_SESSION['user_type'] === 'company') {
                    echo isset($recruiter['name']) ? $recruiter['name'] : '';
                } else {
                    echo isset($recruiter['recruiterName']) ? $recruiter['recruiterName'] : '';
                }
            ?>
          </td>    
          <td><?php echo $recruiter['email']; ?></td>    
          <td><?php echo $recruiter['phone']; ?></td>  
        </tr>
      <?php endforeach; ?>
    </table>
  </div>  

  <!-- CDN for JS bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>  
</div> 

<?php include("footer.html"); ?>
</body>
</html>
