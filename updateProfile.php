<?php
session_start();
require("connect-db.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    // Handle not logged in
    echo "You must be logged in to update your profile.";
    exit;
}

$userID = $_SESSION['user_id'];
$userType = $_SESSION['user_type'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    // ...

    if ($userType == 'applicant') {
        // Update Applicant profile
        $email = $_POST['email'] ?? '';
        $gpa = $_POST['gpa'] ?? '';

        // Additional validation
        // ...

        $query = "UPDATE Applicant SET email = :email, gpa = :gpa WHERE applicantID = :userID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':gpa', $gpa);
        $stmt->bindValue(':userID', $userID);
    } elseif ($userType == 'recruiter') {
        // Update Recruiter profile
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';

        // Additional validation
        // ...

        $query = "UPDATE Recruiter SET name = :name, email = :email, phone = :phone WHERE recruiterID = :userID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':phone', $phone);
        $stmt->bindValue(':userID', $userID);
    } elseif ($userType == 'company') {
        // Update Company profile
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';

        // Additional validation
        // ...

        $query = "UPDATE Company SET name = :name, email = :email WHERE companyID = :userID";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':userID', $userID);
    }

    // Execute the query
    try {
        $stmt->execute();

        echo "Profile updated successfully.";
        header('location: jobpostings.php');
    } catch (PDOException $e) {
        // Handle exceptions, such as database errors
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="your name">
    <meta name="description" content="include some description about your page">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>
    <?php include("header.php"); ?>
    <div class="container mt-5">
        <h1 class="mb-4">Update Profile</h1>

        <form id="updateProfileForm" action="updateProfile.php" method="post" class="border p-4">
            <!-- Common fields like email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <!-- Applicant-specific fields -->
            <div id="applicantFields" style="display: none;" class="form-group">
                <label for="gpa">GPA:</label>
                <input type="text" id="gpa" name="gpa" class="form-control">
            </div>

            <!-- Recruiter-specific fields -->
            <div id="recruiterFields" style="display: none;" class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control">
                <label for="phone" class="mt-2">Phone:</label>
                <input type="tel" id="phone" name="phone" class="form-control">
            </div>

            <!-- Company-specific fields -->
            <div id="companyFields" style="display: none;" class="form-group">
                <label for="companyName">Company Name:</label>
                <input type="text" id="companyName" name="companyName" class="form-control">
            </div>


            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="jobpostings.php" class="btn btn-danger ml-2">Exit</a>
        </form>
    </div>

    <script>
        var userType = "<?php echo $userType; ?>"; // Set this variable dynamically
        window.onload = function () {
            switch (userType) {
                case 'applicant':
                    document.getElementById('applicantFields').style.display = 'block';
                    break;
                case 'recruiter':
                    document.getElementById('recruiterFields').style.display = 'block';
                    break;
                case 'company':
                    document.getElementById('companyFields').style.display = 'block';
                    break;
            }
        };
    </script>
    <?php include("footer.html"); ?>
</body>

</html>