<?php
function getUsernameById($userId)
{
    global $db;
    $query = "SELECT username FROM Applicant WHERE applicantID = :user_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':user_id', $userId);
    $statement->execute();
    $result = $statement->fetchColumn();
    $statement->closeCursor();
    return $result;
}
?>

