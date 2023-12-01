<?php
// Connect to databases
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require("connect-db.php");
require("friend-db.php");
global $db;

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Encrypt password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    registerApplicant($username, $hashed_password, $email);

    // if ($db->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $db->error;
    // }
}
?>

<!-- HTML form for registration -->
<form method="post" action="">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Email: <input type="email" name="email" required><br>
    <input type="submit" value="Register">
</form>