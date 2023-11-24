<?php
function addFriend($friendname, $major, $year)
{
  global $db;
  //   $query = "insert into friends values ('" . $friendname . "', '" . $major . "'," . $year .") ";
  // $db->query($query);  // compile + exe

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

function getAllFriends()
{
  global $db;
  $query = "select * from friends";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

function updateFriendByName($friendname_to_update, $new_major, $new_year)
{
  global $db;
  // Correctly formatted query with placeholders for values
  $query = "UPDATE friends SET major = :major, year = :year WHERE name = :name";
  $statement = $db->prepare($query);

  // Binding the parameters to the query
  $statement->bindValue(':name', $friendname_to_update);
  $statement->bindValue(':major', $new_major);
  $statement->bindValue(':year', $new_year);

  // Execute the query
  $statement->execute();

  // For UPDATE operations, you usually check the number of affected rows
  $count = $statement->rowCount();
  $statement->closeCursor();

  // Return the number of affected rows
  return $count;
}


function deleteFriend($friendname_to_delete)
{
  global $db;
  // Correct the query to use a placeholder for the value
  $query = "DELETE FROM friends WHERE name = :name";
  $statement = $db->prepare($query);
  // Bind the placeholder to the actual value
  $statement->bindValue(':name', $friendname_to_delete);
  $statement->execute();

  // For DELETE operations, you usually check the number of affected rows
  $count = $statement->rowCount();
  $statement->closeCursor();

  // Return the number of affected rows
  return $count;
}

?>