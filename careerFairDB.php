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

function getAllAppliedCareerFairs()
{
  global $db;
  $query = "SELECT Career_fair.careerFairID, Career_fair.industry, Career_fair.date, Career_fair.location 
            FROM Attends 
            INNER JOIN Career_fair ON Attends.careerFairID = Career_fair.careerFairID
            WHERE Attends.applicantID = :user_id";
  $statement = $db->prepare($query);
  $statement->bindParam(':user_id', $_SESSION['user_id']);
  $statement->execute();
  $results = $statement->fetchAll();
  $statement->closeCursor();
  return $results;
}

function withdrawCareerFair($userId, $careerFairId)
{
  global $db;
  $query = "DELETE FROM Attends WHERE applicantID = :user_id AND careerFairID = :career_fair_id";
  $statement = $db->prepare($query);
  $statement->bindParam(':user_id', $userId);
  $statement->bindParam(':career_fair_id', $careerFairId);
  $statement->execute();
  $statement->closeCursor();
}


?>