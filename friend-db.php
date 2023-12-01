<?php
function addFriend($friendname, $major, $year)
{
  global $db;
  // bad way
  // $query = "insert into friends values ('" . $friendname . "', '" . $major . "'," . $year .") ";
  // $db->query($query);  // compile + exe

  // good way
  $query = "insert into friends values (:friendname, :major, :year) ";
  // prepare: 
  // 1. prepare (compile) 
  // 2. bindValue + exe

  $statement = $db->prepare($query);
  $statement->bindValue(':friendname', $friendname);
  $statement->bindValue(':major', $major);
  $statement->bindValue(':year', $year);
  $statement->execute();
  $statement->closeCursor();
}


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

function getAllJobs()
{
  global $db;
  $query = "select * from Job";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

function applyToJob($applicantID, $jobID)
{
  global $db;
  $query = "insert into Applies values (:applicantID , :jobID)";

  $statement = $db->prepare($query);
  $statement->bindValue(':applicantID', $applicantID);
  $statement->bindValue(':jobID', $jobID);

  $statement->execute();
  $statement->closeCursor();
}

function deleteFriend($name)
{
  global $db;
  $query = "delete from friends where name=:name";

  $statement = $db->prepare($query);
  $statement->bindValue(':name', $name);
  $statement->execute();
  $statement->closeCursor();
}
?>