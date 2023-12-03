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
function attendCareerFairEvent($applicantID, $careerFairID)
{
  global $db;
  $query = "insert into Attends values (:applicantID , :careerFairID)";

  $statement = $db->prepare($query);
  $statement->bindValue(':applicantID', $applicantID);
  $statement->bindValue(':careerFairID', $careerFairID);
 

  $statement->execute();
  $statement->closeCursor();
}
function isUserAttending($userId, $careerFairID)
{
    global $db;
    $query = "SELECT COUNT(*) FROM Attends WHERE applicantID = :user_id AND careerFairID = :career_fair_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':user_id', $userId);
    $statement->bindParam(':career_fair_id', $careerFairID);
    $statement->execute();
    $count = $statement->fetchColumn();
    $statement->closeCursor();
    return ($count > 0);
}

?>