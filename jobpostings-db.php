<?php

function getAllJobs()
{
  global $db;
  $query = "select * from Job";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

function applyToJob($applicantID, $jobID)
{
  global $db;
  $query = "insert into Applies values (:applicantID , :jobID)";

  $statement = $db->prepare($query);
  $statement->bindValue(':applicantID', $applicantID);
  $statement->bindValue(':jobID', $jobID);

  $statement->execute();
  $statement->closeCursor();
}

function hasUserApplied($userId, $jobId)
{
    global $db;
    $query = "SELECT COUNT(*) FROM Applies WHERE applicantID = :user_id AND jobID = :job_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':user_id', $userId);
    $statement->bindParam(':job_id', $jobId);
    $statement->execute();
    $count = $statement->fetchColumn();
    $statement->closeCursor();
    return ($count > 0);
}


