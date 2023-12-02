<?php
function getCompanyName($companyId)
{
    global $db;
    $query = "SELECT name FROM Company WHERE companyID = :companyID";
    $statement = $db->prepare($query);
    $statement->bindParam(':companyID', $companyId);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    // Return the company name
    return $result['name'];
}

function createJob($title, $industry, $pay, $company)
{
    global $db;
    $query = "insert into Job (title, industry, pay, company) values (:title, :industry, :pay, :company)";
  
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':industry', $industry);
    $statement->bindValue(':pay', $pay);
    $statement->bindValue(':company', $company);
    $success = $statement->execute();
    $statement->closeCursor();

    return $success;
}
?>
