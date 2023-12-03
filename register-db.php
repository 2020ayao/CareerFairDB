<?php

function registerApplicant($username, $email, $password, $gpa)
{
  global $db;
  $query = "INSERT INTO Applicant(username, password, email, gpa) VALUES (:username, :password, :email, :gpa)";

  try {
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':gpa', $gpa);

    // Execute the query and return true if successful
    if ($statement->execute()) {
      $statement->closeCursor();
      return true;
    } else {
      // If execute() returns false, return false
      $statement->closeCursor();
      return false;
    }
  } catch (Exception $e) {
    // Catch any exceptions and return false
    // Optionally, you can log the exception message for debugging purposes
    // error_log($e->getMessage());
    return false;
  }
}


?>