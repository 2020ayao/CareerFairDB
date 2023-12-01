<!-- below is header-db.php -->
<?php
function getUsernameByIdAndType($userId, $userType)
{
    global $db;
    $table = '';
    $column = '';
    switch ($userType) {
        case 'applicant':
            $table = 'Applicant';
            $column = 'username';
            break;
        case 'recruiter':
            $table = 'Recruiter';
            $column = 'name';
            break;
        case 'company':
            $table = 'Company';
            $column = 'name';
            break;
        // Add more cases as needed
    }

    $query = "SELECT $column FROM $table WHERE {$table}ID = :user_id";
    $statement = $db->prepare($query);
    $statement->bindParam(':user_id', $userId);
    $statement->execute();
    $result = $statement->fetchColumn();
    $statement->closeCursor();
    return $result;
}
?>
