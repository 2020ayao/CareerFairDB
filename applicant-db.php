<?php

function getAllApplicants()
{
    global $db;
    $query = "
    SELECT * FROM Applicant
  ";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();   // fetch()
    $statement->closeCursor();
    return $results;
}
?>