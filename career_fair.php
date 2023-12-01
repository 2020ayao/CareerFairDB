<?php
require("connect-db.php");
require("career_fair-db.php");

$list_of_career_fair_events = getAllCareerFairEvents();
//need to fix this
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   if (!empty($_POST['attendBtn']))
   {
    // ALL WE NEED LEFT HERE IS TO INCLUDE THE APPLICANT ID HERE TOO IN ARGUMENT OF THIS FUNCTION
    // MISSING THE FIRST ARGUMENT OF APPLICANT ID
    attendCareerFairEvent($_POST['applicantID'], $_POST['career_fair_ID'], $_POST['recruiterID']);
      $list_of_jobs = getAllJobs();
   }
}

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
<h3>List of Career Fair Events</h3>
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">careerFairID        
    <th width="25%">industry        
    <th width="25%">date 
    <th width="25%">Location 
        
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  </thead>


<?php foreach ($list_of_career_fair_events as $career_fair_events): ?>
  <tr>
     <td><?php echo $career_fair_events['careerFairID']; ?></td>   <!-- column name --> 
     <td><?php echo $career_fair_events['industry']; ?></td>        
     <td><?php echo $career_fair_events['date']; ?></td>
     <td><?php echo $career_fair_events['Location']; ?></td>   
     <td>
      <form action="simpleform.php" method="post">
         <input type="submit" value="Attend" name="AttendBtn" class="btn btn-success"  />
         <input type="hidden" name="career_fair_ID"  
                 value="<?php echo $job['careerFairID']; ?>" 
          />
      </form>
     </td> 
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