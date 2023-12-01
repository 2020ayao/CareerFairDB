<?php
session_start();
require("connect-db.php");
require("register-db.php");

// Initialize variables for student registration
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

// Initialize variables for recruiter registration
$company_id = $recruiter_name = $recruiter_email = $recruiter_phone = $recruiter_password = $recruiter_confirm_password = "";
$company_id_err = $recruiter_name_err = $recruiter_email_err = $recruiter_phone_err = $recruiter_password_err = $recruiter_confirm_password_err = "";

// Initialize variables for company registration
$company_name = $company_email = $company_password = $company_confirm_password = "";
$company_name_err = $company_email_err = $company_password_err = $company_confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $registration_type = $_POST["registration_type"];

    if ($registration_type === "student") {
        // Validate student registration fields
        // ... (student registration validation code)

        if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
            // Hash the password before storing it in the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists in the Applicant table
            $stmt_check_email = $db->prepare("SELECT COUNT(*) FROM `Applicant` WHERE `email` = ?");
            $stmt_check_email->bindParam(1, $email, PDO::PARAM_STR);
            $stmt_check_email->execute();
            $email_count = $stmt_check_email->fetchColumn();

            if ($email_count > 0) {
                $email_err = "This email is already registered.";
            } else {
                // Insert the student's information into the database
                $stmt = $db->prepare("INSERT INTO Applicant (username, password, email) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $username, PDO::PARAM_STR);
                $stmt->bindParam(2, $hashed_password, PDO::PARAM_STR);
                $stmt->bindParam(3, $email, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    // Redirect to the login page after successful registration
                    header("location: login.php");
                    exit;
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }
        }
    } elseif ($registration_type === "recruiter") {
        // Validate recruiter registration fields
        // ... (recruiter registration validation code)

        if (empty($company_id_err) && empty($recruiter_name_err) && empty($recruiter_email_err) && empty($recruiter_phone_err) && empty($recruiter_password_err) && empty($recruiter_confirm_password_err)) {
            // Hash the recruiter password before storing it in the database
            $hashed_password = password_hash($recruiter_password, PASSWORD_DEFAULT);

            // Check if email already exists in the Recruiter table
            $stmt_check_email = $db->prepare("SELECT COUNT(*) FROM `Recruiter` WHERE `email` = ?");
            $stmt_check_email->bindParam(1, $recruiter_email, PDO::PARAM_STR);
            $stmt_check_email->execute();
            $email_count = $stmt_check_email->fetchColumn();

            if ($email_count > 0) {
                $recruiter_email_err = "This email is already registered.";
            } else {
                // Insert the recruiter's information into the database
                $stmt = $db->prepare("INSERT INTO Recruiter (companyID, name, email, phone, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $company_id, PDO::PARAM_INT);
                $stmt->bindParam(2, $recruiter_name, PDO::PARAM_STR);
                $stmt->bindParam(3, $recruiter_email, PDO::PARAM_STR);
                $stmt->bindParam(4, $recruiter_phone, PDO::PARAM_STR);
                $stmt->bindParam(5, $hashed_password, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    // Redirect to the login page after successful registration
                    header("location: login.php");
                    exit;
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }
        }
    } elseif ($registration_type === "company") {
        // Validate company registration fields
        // ... (company registration validation code)

        if (empty($company_name_err) && empty($company_email_err) && empty($company_password_err) && empty($company_confirm_password_err)) {
            // Hash the company password before storing it in the database
            $hashed_password = password_hash($company_password, PASSWORD_DEFAULT);

            // Check if email already exists in the Company table
            $stmt_check_email = $db->prepare("SELECT COUNT(*) FROM `Company` WHERE `email` = ?");
            $stmt_check_email->bindParam(1, $company_email, PDO::PARAM_STR);
            $stmt_check_email->execute();
            $email_count = $stmt_check_email->fetchColumn();

            if ($email_count > 0) {
                $company_email_err = "This email is already registered.";
            } else {
                // Insert the company's information into the database
                $stmt = $db->prepare("INSERT INTO Company (name, email, password) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $company_name, PDO::PARAM_STR);
                $stmt->bindParam(2, $company_email, PDO::PARAM_STR);
                $stmt->bindParam(3, $hashed_password, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    // Redirect to the login page after successful registration
                    header("location: login.php");
                    exit;
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }

        .additional-fields {
            display: none;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Set default selection to "Student" and show corresponding fields
            var registrationType = document.getElementById("registrationType");
            registrationType.value = "student";
            toggleAdditionalFields();
        });

        function toggleAdditionalFields() {
            var registrationType = document.getElementById("registrationType").value;
            var additionalFieldsRecruiter = document.getElementById("additionalFieldsRecruiter");
            var additionalFieldsStudent = document.getElementById("additionalFieldsStudent");
            var additionalFieldsCompany = document.getElementById("additionalFieldsCompany");

            additionalFieldsRecruiter.style.display = (registrationType === "recruiter") ? "block" : "none";
            additionalFieldsStudent.style.display = (registrationType === "student") ? "block" : "none";
            additionalFieldsCompany.style.display = (registrationType === "company") ? "block" : "none";
        }
    </script>
</head>

<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Existing form fields -->

            <div class="form-group">
                <label>Registration Type</label>
                <select name="registration_type" id="registrationType" class="form-control" onchange="toggleAdditionalFields()">
                    <option value="student">Student</option>
                    <option value="recruiter">Recruiter</option>
                    <option value="company">Company</option>
                </select>
            </div>

            <div id="additionalFieldsRecruiter" class="additional-fields">
                <!-- Additional fields for recruiter registration -->
                <div class="form-group">
                    <label>Company ID</label>
                    <input type="text" name="company_id" class="form-control">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="recruiter_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="recruiter_email" class="form-control">
                    <span class="text-danger"><?php echo $recruiter_email_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="recruiter_phone" class="form-control">
                </div>
                <!-- Password fields for recruiter -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="recruiter_password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="recruiter_confirm_password" class="form-control">
                </div>
            </div>

            <div id="additionalFieldsStudent" class="additional-fields">
                <!-- Additional fields for student registration -->
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="student_email" class="form-control">
                    <span class="text-danger"><?php echo $email_err; ?></span>
                </div>
                <!-- Password fields for student -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="student_password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="student_confirm_password" class="form-control">
                </div>
            </div>

            <div id="additionalFieldsCompany" class="additional-fields">
                <!-- Additional fields for company registration -->
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="company_name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="company_email" class="form-control">
                    <span class="text-danger"><?php echo $company_email_err; ?></span>
                </div>
                <!-- Password fields for company -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="company_password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="company_confirm_password" class="form-control">
                </div>
            </div>

            <!-- Remaining form fields -->

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>

</html>
