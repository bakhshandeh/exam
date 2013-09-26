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
    <link rel="shortcut icon">

    <title>Exam Application</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="dataTables.bootstrap.css">
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
    
    <script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.jeditable.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.editable.js"></script>
    <script type="text/javascript" language="javascript" src="js/lib.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Exam Application</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li id="home_li"><a href="home.php">Dashboard</a></li>
            <li id="subjects_li"><a href="subjects.php">Subjects</a></li>
            
            <!-- li id="users_li"><a href="users.php">Users</a></li -->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">Users <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="stdgroups.php">Student Groups</a></li>
                  <li><a href="students.php">Students</a></li>
                </ul>
              </li>
            
            <li id="exams_li"><a href="exams.php">Exams</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
