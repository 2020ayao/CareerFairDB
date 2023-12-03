<?php
require("connect-db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $applicantID = $_POST['applicantID'] ?? '';
    $companyID = $_POST['companyID'] ?? '';
    $hiringStatus = $_POST['hiringStatus'] ?? '';

    // Validate and sanitize inputs
    // ...

    if ($applicantID !== '' && $companyID !== '') {
        if ($hiringStatus === 'true') {
            // Hiring the applicant - Insert into Hires table
            $query = "INSERT INTO Hires (companyID, applicantID) VALUES (:companyID, :applicantID)";
        } else {
            // Unhiring the applicant - Delete from Hires table
            $query = "DELETE FROM Hires WHERE companyID = :companyID AND applicantID = :applicantID";
        }

        try {
            $stmt = $db->prepare($query);
            $stmt->bindValue(':companyID', $companyID, PDO::PARAM_STR);
            $stmt->bindValue(':applicantID', $applicantID, PDO::PARAM_STR);
            $stmt->execute();

            echo "Hiring status updated successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid data";
    }
}
?>