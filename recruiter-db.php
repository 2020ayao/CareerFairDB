<?php


function getAllRecruiters()
{
  global $db;
  $query = "
    SELECT recruiter.recruiterID, recruiter.name AS recruiterName, recruiter.email, recruiter.phone, company.name
    FROM Recruiter recruiter
    JOIN Company company ON recruiter.companyID = company.companyID
  ";
  $statement = $db->prepare($query); 
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

function getRecruitersByCompanyId($companyId) {
    global $db; // Assuming $db is your database connection

    try {
        // Prepare the SQL query to get recruiters by company ID
        $query = "SELECT * FROM `Recruiter` WHERE `companyID` = :company_id";
        $statement = $db->prepare($query);
        $statement->bindParam(':company_id', $companyId, PDO::PARAM_INT);
        
        // Execute the query
        $statement->execute();

        // Fetch all recruiters as an associative array
        $recruiters = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Close the database connection
        $statement->closeCursor();

        return $recruiters;
    } catch (PDOException $e) {
        // Handle database errors here (log or display an error message)
        echo "Error: " . $e->getMessage();
        return array(); // Return an empty array on error
    }
}
?>
