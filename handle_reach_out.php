<?php
session_start();
header('Content-Type: application/json');
require("connect-db.php");
require("createjob-db.php");
// ini_set('display_errors', 0); // Turn off error displaying
// error_reporting(E_ALL); // Log errors


// Function to handle 'reach out' action
function addReachesOutEntry($recruiterId, $applicantId)
{
    global $db;

    $query = "INSERT INTO Reaches_out (recruiterID, applicantID) VALUES (:recruiterId, :applicantId)";
    try {
        $statement = $db->prepare($query);
        $statement->bindParam(':recruiterId', $recruiterId);
        $statement->bindParam(':applicantId', $applicantId);
        $statement->execute();
        $statement->closeCursor();

        return true;
    } catch (PDOException $e) {
        // Handle exception
        return false;
    }
}

// Function to handle 'reached out' action
function removeReachesOutEntry($recruiterId, $applicantId)
{
    global $db;

    $query = "DELETE FROM Reaches_out WHERE recruiterID = :recruiterId AND applicantID = :applicantId";
    try {
        $statement = $db->prepare($query);
        $statement->bindParam(':recruiterId', $recruiterId);
        $statement->bindParam(':applicantId', $applicantId);
        $statement->execute();
        $statement->closeCursor();

        return true;
    } catch (PDOException $e) {
        // Handle exception
        return false;
    }
}

// Assuming recruiterID is stored in the session
// session_start();
$recruiterId = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $recruiterId) {
    $applicantId = $_POST['applicantID'] ?? '';
    $action = $_POST['action'] ?? '';

    if (!empty($applicantId)) {
        if ($action == 'reach_out') {
            $result = addReachesOutEntry($recruiterId, $applicantId);
        } elseif ($action == 'reached_out') {
            $result = removeReachesOutEntry($recruiterId, $applicantId);
        } else {
            $result = false;
        }

        if ($result) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update the database"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method or recruiter not logged in"]);
}
?>