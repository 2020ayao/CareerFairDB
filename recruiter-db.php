<?php


function getAllRecruiters()
{
  global $db;
  $query = "
    SELECT recruiter.recruiterID, recruiter.name AS recruiterName, recruiter.contact_email, recruiter.contact_phone, company.name
    FROM Recruiter recruiter
    JOIN Company company ON recruiter.companyID = company.companyID
  ";
  $statement = $db->prepare($query); 
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}
?>
