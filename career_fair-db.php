<?php


function getAllCareerFairEvents()
{
  global $db;
  $query = "select * from Career_fair";
  $statement = $db->prepare($query); 
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

//need to fix this
function attendCareerFairEvent($applicantID, $careerFairID, $recruiterID)
{
  global $db;
  $query = "insert into Attends values (:applicantID , :jobID, :recruiterID)";

  $statement = $db->prepare($query);
  $statement->bindValue(':applicantID', $applicantID);
  $statement->bindValue(':careerFairID', $jobID);
  $statement->bindValue(':recruiterID', $recruiterID);

  $statement->execute();
  $statement->closeCursor();
}
?>
