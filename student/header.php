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

    <title>my profile</title>

    <!-- Bootstrap core CSS -->
    <link class="include" rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="css/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="css/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="css/shThemejqPlot.min.css" />
    
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
    
    
    
     <script class="include" type="text/javascript" src="js/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="js/shCore.min.js"></script>
    <script type="text/javascript" src="js/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="js/shBrushXml.min.js"></script>
<!-- End Don't touch this! -->

<!-- Additional plugins go here -->

    <script class="include" language="javascript" type="text/javascript" src="js/jqplot.barRenderer.min.js"></script>
    <script class="include" language="javascript" type="text/javascript" src="js/jqplot.categoryAxisRenderer.min.js"></script>
    <script class="include" language="javascript" type="text/javascript" src="js/jqplot.pointLabels.min.js"></script>

    
    
    
    
    

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
          <li><a href="pchart.php">Performance Chart</a></li>
           <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
