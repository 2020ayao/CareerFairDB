<?php
function getJobDetails($jobID)
{
    global $db;
    $query = "SELECT * FROM Job WHERE jobID = :jobID";
    $statement = $db->prepare($query);
    $statement->bindParam(':jobID', $jobID);
    $statement->execute();
    $jobDetails = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $jobDetails;
}

function getJobApplicants($jobID)
{
    global $db;
    $query = "SELECT A.applicantID, AP.username, AP.email, AP.gpa
              FROM Applies AS A
              JOIN Applicant AS AP ON A.applicantID = AP.applicantID
              WHERE A.jobID = :jobID";
    $statement = $db->prepare($query);
    $statement->bindParam(':jobID', $jobID);
    $statement->execute();
    $applicants = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $applicants;
}

?>