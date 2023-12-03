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

function isHired($companyID, $applicantID)
{
    global $db;
    $query = "SELECT COUNT(*) FROM Hires WHERE applicantID = :user_id AND companyID = :company_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':user_id', $applicantID);
    $statement->bindParam(':company_id', $companyID);
    $statement->execute();
    $count = $statement->fetchColumn();
    $statement->closeCursor();
    return ($count > 0);
}

function hireApplicant($companyID, $applicantID)
{
    global $db;
    $query = "insert into Hires values (:companyID , :jobID)";

    $statement = $db->prepare($query);
    $statement->bindValue(':applicantID', $applicantID);
    $statement->bindValue(':jobID', $companyID);


    $statement->execute();
    $statement->closeCursor();
}

?>