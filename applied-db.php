<?php


function getAllApplied()
{
  global $db;
  $query = "select job.title, job.industry, job.pay, job.company 
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
?>
