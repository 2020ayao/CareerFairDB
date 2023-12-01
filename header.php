<?php
require("header-db.php");
?>

<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <?php
      // Starting the session to access user information
      // session_start();

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
          <li class="nav-item">
            <a class="nav-link" href="recruiter.php">Recruiters</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="career_fair.php">Career Fairs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="applied.php">Jobs Applied</a>
          </li>
          <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>

        </ul>
      </div>
    </div>
  </nav>
</header>
