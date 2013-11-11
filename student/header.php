<?php
require_once("include.php");
checkLogin();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Exam app admin panel</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/jquery.countdown.css">

    <!-- Add custom CSS here -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

    
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.jeditable.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.editable.js"></script>
    
    <script type="text/javascript" src="js/jquery.countdown.js"></script>

  </head>

  <body>
  
    <div id="wrapper">
      
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
          <li class="sidebar-brand"><a href="#">Exam Application </a></li>
          <li><a href="home.php">Dashboard</a></li>
          <li><a href="profile.php">Profile</a></li>
          <!--li><a href="#">News & Announcements</a></li-->
          <li><a href="upexams.php">Upcoming Exams</a></li>
          <li><a href="examhistory.php">Exam History</a></li>
          <!--li><a href="#">Group Report</a></li-->
           <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
