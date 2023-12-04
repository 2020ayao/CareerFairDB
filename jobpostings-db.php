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

function getCompanyName($companyId)
{
  global $db;
  $query = "SELECT name FROM Company WHERE companyID = :companyID";
  $statement = $db->prepare($query);
  $statement->bindParam(':companyID', $companyId);
  $statement->execute();
  $result = $statement->fetch(PDO::FETCH_ASSOC);
  $statement->closeCursor();

  // Return the company name
  return $result['name'];
}

function getJobsByCompany($companyName)
{
  global $db;
  $query = "SELECT * FROM Job WHERE company = :companyName";
  $statement = $db->prepare($query);
  $statement->bindParam(':companyName', $companyName);
  $statement->execute();
  $jobs = $statement->fetchAll(PDO::FETCH_ASSOC);
  $statement->closeCursor();

  return $jobs;
}

function deleteJob($jobID)
{
  global $db;
  $appliesQuery = "DELETE FROM Applies WHERE jobID = :jobID";
  $appliesStatement = $db->prepare($appliesQuery);
  $appliesStatement->bindParam(':jobID', $jobID);
  $appliesStatement->execute();
  $appliesStatement->closeCursor();

  $query = "DELETE FROM Job WHERE jobID = :jobID";
  $statement = $db->prepare($query);
  $statement->bindParam(':jobID', $jobID);
  $statement->execute();
  $statement->closeCursor();
}
?>