<?php
session_start();
require("connect-db.php");
require("applicant-db.php"); // Update this to your actual applicant database functions file



if (!isset($_SESSION['user_id'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: login.php');
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_id']);
    header("location: login.php");
    exit();
}

// Fetch the list of applicants
$list_of_applicants = getAllApplicants(); // Update this function according to your actual function
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
        <h1>Applicants</h1>
        <hr />

        <div class="row justify-content-center">
            <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
                <thead>
                    <tr style="background-color:#B0B0B0">
                        <th width="20%">Name</th>
                        <th width="20%">Email</th>
                        <th width="20%">GPA</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>

                <?php foreach ($list_of_applicants as $applicant): ?>
                    <tr>

                        <td>
                            <?php echo $applicant['username']; ?>
                        </td>
                        <td>
                            <?php echo $applicant['email']; ?>
                        </td>
                        <td>
                            <?php echo $applicant['gpa']; ?>
                        </td>
                        <td>
                            <button onclick="toggleReachOut(this, <?php echo $applicant['applicantID']; ?>)"
                                class="btn btn-primary">Reach Out</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- JavaScript for AJAX and Button Toggle -->
        <script>
            function toggleReachOut(buttonElement, applicantID) {
                console.log("Button clicked for applicantID:", applicantID); // Debugging log
                var action = buttonElement.innerHTML.trim() === "Reach Out" ? 'reach_out' : 'reached_out';

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "handle_reach_out.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (this.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 200) {
                            var response = JSON.parse(this.responseText);
                            console.log("Response from server:", response); // Debugging log
                            if (response.status === "success") {
                                if (action === 'reach_out') {
                                    buttonElement.innerHTML = "Reached Out";
                                    buttonElement.className = "btn btn-success";
                                } else {
                                    buttonElement.innerHTML = "Reach Out";
                                    buttonElement.className = "btn btn-primary";
                                }
                            } else {
                                console.error("Error: ", response.message);
                            }
                        } else {
                            console.error("AJAX request failed: ", this.status); // Debugging log
                        }
                    }
                }
                xhr.send("applicantID=" + applicantID + "&action=" + action);
            }

        </script>

        <!-- (Keep the script and footer sections as is) -->

        <!-- CDN for JS bootstrap -->
        <!-- you may also use JS bootstrap to make the page dynamic -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3"></script>
    </div>

    <?php include("footer.html"); ?>
</body>

</html>