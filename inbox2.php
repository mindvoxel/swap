<html>

  <head>
    <title>Inbox</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
   
  </head>
  
  <body>    
    <div class = "header" style="margin:10px">
      <p><img src="mainImg.jpg" alt="Yellow swap Arrows" height='100' width='110'>
      <h1>&nbspInbox</h1></p>
    </div>

<?php

require_once("generate.php");
require_once("profile.php");

if (!isset($_SESSION)) {
    session_start();
}

#check to make sure logged in correctly, if not send to login page

if (!isset($_SESSION["username"]) || !isset($_SESSION["password"])) {
    header("Location: login.php");
} else {
    $username = $_SESSION['username'];
    $passwordValue = $_SESSION['password'];
    $temp = new Profile("", "", []);
    $profile = $temp->find_profile_on_db($username);
    if ($profile == null) { #couldnt find the username on the db
        header("Location: login.php");
    }
    $password_encrypted = $profile->get_password();
    if (!password_verify($passwordValue, $password_encrypted)) { #password was wrong
        header("Location: login.php");
    }
}
$username = $_SESSION['username'];
$passwordValue = $_SESSION['password'];

function connectToDB($host, $user, $password, $database) {
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {
	        return $db_connection;
	}
}  

if((isset($_POST['accept']) )){
  $swap = $_POST['accept'];
  list($mode, $recipient, $item1, $sender, $item2) = preg_split('/[+]/', $swap);
  $host = "localhost";
	$user = "swapadmin";
	$password = "password";
	$database = "swapbase";
  $db = connectToDB($host, $user, $password, $database);
  
  if ($mode == 'accept'){
  
  $sql = "UPDATE `items` SET `user-key`= '".$recipient."'  WHERE `user-key` = '".$sender."' AND `name` = '".$item2."'";
	
	$result = mysqli_query($db, $sql);	
        
    if (!$result) {
		  echo("Error");
	  }
    else{
	  $sql2 = "UPDATE `items` SET `user-key`= '".$sender."'  WHERE `user-key` = '".$recipient."' AND `name` = '".$item1."'";
	
	$result = mysqli_query($db, $sql2);	
        
        if (!$result) {
		  echo("Error");
	  }else{
	  $sql3 = "DELETE FROM `inbox` WHERE `Recipient` = '".$recipient."' AND `Sender` = '".$sender."' AND `Item1` = '".$item1."' AND `Item2` = '".$item2."'";
	  
	  $result = mysqli_query($db, $sql3);	
	  
	  if (!$result) {
		  echo("Error");
	  }else{
	  
	  $sql4 = "DELETE FROM `inbox` WHERE `Recipient` = '".$recipient."'  AND `Item1` = '".$item1."'";
	  
	$result = mysqli_query($db, $sql4);	
	
	if (!$result) {
		  echo("Error");
	  }else{
	
	$sql5 = "DELETE FROM `inbox` WHERE `Recipient` = '".$sender."'  AND `Item1` = '".$item2."'";
	  
	$result = mysqli_query($db, $sql5);	
	
	if (!$result) {
		  echo("Error");
	  }else{
	  
	  $sql6 = "DELETE FROM `inbox` WHERE `Sender` = '".$recipient."'  AND `Item2` = '".$item1."'";
	  
	$result = mysqli_query($db, $sql6);	
	
	if (!$result) {
		  echo("Error");
	  }else{
	
	$sql7 = "DELETE FROM `inbox` WHERE `Sender` = '".$sender."'  AND `Item2` = '".$item2."'";
	  
	$result = mysqli_query($db, $sql7);	
	
	if (!$result) {
		  echo("Error");
	  }else{
	  
  echo("<div class = 'container-fluid'><p>Completed Accept</p></div>");
 }}}}}}}}
 else{
  
  
  $sql3 = "DELETE FROM `inbox` WHERE `Recipient` = '".$recipient."' AND `Sender` = '".$sender."' AND `Item1` = '".$item1."' AND `Item2` = '".$item2."'";
	  
	$result = mysqli_query($db, $sql3);	
	  
	  if (!$result) {
		  echo("Error");
	  }
	  else{
	    echo("<div class = 'container-fluid'><p>Completed Delete</p></div>");
	  }
  
}
}
else{

  echo("<div class = 'container-fluid'><p>Nothing Selected</p></div>");

}

?>

    <div class = "container-fluid">
      <form action="landing.php"">
        <input id = "b" type="submit" value="Return to Main Menu" class="btn btn-warning" style = "width:40%">
      </form>
    </div>
  </body>

<style>
.header img {
  float: left;
  width: 100px;
  clear: right;

}
.header h1 {
  position: relative;
  top: 15px;
  left: 10px;
  padding-bottom: 60px;

}
form{
padding-top: 5px;

}


</style>

</html>


