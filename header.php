<?php
session_start();
require("connect-db.php");
require("header-db.php");

?>

<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <?php
      // Starting the session to access user information
      

      // Check if the user is logged in
      if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $userType = $_SESSION['user_type'];
        $username = getUsernameByIdAndType($userId, $userType);

        echo '<span class="nav-link">Logged in as ' . $userType . ': ' . $username . '</span>';
      } else {
        echo '<span class="nav-link">Not logged in</span>';
      }

      ?>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"
        aria-controls="collapsibleNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="jobpostings.php">Jobs</a>
          </li>
          <?php
          // Conditionally show or hide "Recruiters" based on user type
          if ($userType === 'applicant' || $userType === 'recruiter' || $userType === 'company') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="recruiter.php">Recruiters</a>
                  </li>';
          }

          // Conditionally show or hide "Career Fairs" based on user type
          if ($userType === 'applicant') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="careerFair.php">Career Fairs</a>
                  </li>';
          }

          // Conditionally show or hide "Career Fairs Attending" based on user type
          if ($userType === 'applicant') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="careerFairApplied.php">CF Attendance</a>
                  </li>';
          }

          // Conditionally show or hide "Jobs Applied" based on user type
          if ($userType === 'applicant') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="applied.php">Jobs Applied</a>
                  </li>';
          }

          // Conditionally show or hide "Applicants" based on user type == Recruiter
          if ($userType === 'recruiter') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="applicants.php">Applicants</a>
                  </li>';
          }


          if ($userType === 'company') {
            echo '<li class="nav-item">
                    <a class="nav-link" href="createjob.php">Create Job Posting</a>
                  </li>';
          }


          ?>

          <a href="updateProfile.php" class="btn btn-info ml-3" style="margin-right:5px;">Update Profile</a>

          <a href="/logout.php" class="btn btn-danger ml-3">Sign Out</a>
        </ul>
      </div>
    </div>
  </nav>
</header>