<?php


function getAllRecruiters()
{
  global $db;
  $query = "select * from Recruiter";
  $statement = $db->prepare($query); 
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}
?>
