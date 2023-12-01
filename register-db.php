<?php

function registerApplicant($username, $password, $email)
{
  global $db;
  $query = "insert into Applicant(username, password, email) values (:username, :password, :email) ";
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':password', $password);
  $statement->bindValue(':email', $email);
  $statement->execute();
  $statement->closeCursor();
}

?>