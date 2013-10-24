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

    <!-- Add custom CSS here -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>

  </head>

  <body>
  
    <div id="wrapper">
      
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
          <li class="sidebar-brand"><a href="#">Exam Application </a></li>
          <li><a href="home.php">Dashboard</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="#">News & Announcements</a></li>
          <li><a href="upexams.php">Upcoming Exams</a></li>
          <li><a href="#">Exam History</a></li>
          <li><a href="#">Group Report</a></li>
        </ul>
      </div>
