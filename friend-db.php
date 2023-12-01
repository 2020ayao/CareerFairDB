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
?>
