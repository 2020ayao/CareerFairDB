<?php
require("connect-db.php");
require("recruiter-db.php");

$list_of_recruiters = getAllRecruiters();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
  <title>Get started with DB programming</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>
<?php include("header.html"); ?>  


<hr/>
<h3>List of recruiters</h3>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="20%">recruiterID        
    <th width="20%">companyID        
    <th width="20%">name 
    <th width="20%">contact_email 
    <th width="20%">contact_phone 
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  </thead>


<?php foreach ($list_of_recruiters as $recruiter): ?>
  <tr>
     <td><?php echo $recruiter['recruiterID']; ?></td>   <!-- column name --> 
     <td><?php echo $recruiter['companyID']; ?></td>        
     <td><?php echo $recruiter['name']; ?></td>
     <td><?php echo $recruiter['contact_email']; ?></td>    
     <td><?php echo $recruiter['contact_phone']; ?></td>  
  </tr>
<?php endforeach; ?>
</table>
</div>  



  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->  
  
</div> 

<?php include("footer.html"); ?>
</body>
</html>