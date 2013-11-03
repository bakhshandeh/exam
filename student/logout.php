<?

require_once("include.php");
unset($_SESSION['loginInfo']);
header('Location:index.php',true,301);

?>