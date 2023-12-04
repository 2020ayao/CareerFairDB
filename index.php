<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':                   // URL (without file name) to a default screen
        require 'login.php';
        break;
    case '/register.php':                   // URL (without file name) to a default screen
        require 'register.php';
        break;

    case '/login.php':     // if you plan to also allow a URL with the file name 
        require 'login.php';
        break;

    case '/applicants.php':     // if you plan to also allow a URL with the file name 
        require 'applicants.php';
        break;
    case '/applied.php':     // if you plan to also allow a URL with the file name 
        require 'applied.php';
        break;
    case '/careerFair.php':     // if you plan to also allow a URL with the file name 
        require 'careerFair.php';
        break;
    case '/careerFairApplied.php':     // if you plan to also allow a URL with the file name 
        require 'careerFairApplied.php';
        break;
    case '/createjob.php':     // if you plan to also allow a URL with the file name 
        require 'createjob.php';
        break;
    case '/handle_reach_out.php':     // if you plan to also allow a URL with the file name 
        require 'handle_reach_out.php';
        break;
    case '/header.php':     // if you plan to also allow a URL with the file name 
        require 'header.php';
        break;
    case '/hireApplicant.php':     // if you plan to also allow a URL with the file name 
        require 'hireApplicant.php';
        break;
    case '/jobapplicants.php':     // if you plan to also allow a URL with the file name 
        require 'jobapplicants.php';
        break;
    case '/jobpostings.php':     // if you plan to also allow a URL with the file name 
        require 'jobpostings.php';
        break;
    case '/logout.php':     // if you plan to also allow a URL with the file name 
        require 'logout.php';
        break;
    case '/recruiter.php':     // if you plan to also allow a URL with the file name 
        require 'recruiter.php';
        break;
    case '/updateProfile.php':     // if you plan to also allow a URL with the file name 
        require 'updateProfile.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
}
?>