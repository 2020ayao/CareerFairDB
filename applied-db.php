<?php


function getAllApplied()
{
  global $db;
  $query = "select * from Applies where applicantID = :user_id";
  $statement = $db->prepare($query); 
  $statement->bindParam(':user_id', $_SESSION['user_id']);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;

  
}
?>
