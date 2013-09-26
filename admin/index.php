<?php
require_once("include.php");

if(isLoggedIn()){
    redirect("home.php");
}
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="">
    
    <script src="js/jquery.js" type="text/javascript"></script>
     <script src="js/bootstrap.min.js"></script>
     
     
     <script src="js/lib.js"></script>
     
     <script type="text/javascript">

    jQuery(document).ready(function(){
        jQuery('.form-signin').submit(function(){
            $.post('core/login.php', $('.form-signin').serialize(), function(data){
        	if(data.indexOf("OK") != -1){
        	    window.location.href = "home.php";
        	}else{
        	    alert(data);
        	    return false;
        	}
            });
            
            return false;
            
        });
    });
    
</script>
    
    <title>Exam Application</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin">
        <h2 class="form-signin-heading" style="font-size:20px;">Exam Application login</h2>
        <input type="text" class="form-control" placeholder="Username" autofocus name="username">
        <input type="password" class="form-control" placeholder="Password" name="pass">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
