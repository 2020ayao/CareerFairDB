<?php


function getAllApplied()
{
  global $db;
  $query = "select job.jobID, job.title, job.industry, job.pay, job.company 
            from Applies 
            inner join Job on Applies.jobID = Job.jobID
            where Applies.applicantID = :user_id";
  $statement = $db->prepare($query); 
  $statement->bindParam(':user_id', $_SESSION['user_id']);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;

  
}

function withdrawApplication($userId, $jobId)
{
    global $db;
    $query = "DELETE FROM Applies WHERE applicantID = :user_id AND jobID = :job_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':user_id', $userId);
    $statement->bindParam(':job_id', $jobId);
    $statement->execute();
    $statement->closeCursor();
}

?>
