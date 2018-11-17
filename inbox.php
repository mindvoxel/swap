<!doctype html>

<?php  

function connectToDB($host, $user, $password, $database) {
	$db_connection = new mysqli($host, $user, $password, $database);
	if ($db_connection->connect_error) {
		die($db_connection->connect_error);
	} else {
	        return $db_connection;
	}
}  

#check to make sure logged in correctly, if not send to login page


session_start();

$username = $_SESSION['user'];
$password = $_SESSION['password'];
?>

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
    <div class = "container-fluid">
    <?php 
    $host = "localhost";
	  $user = "swapadmin";
	  $password = "password";
	  $database = "swapbase";
	
	  $db = connectToDB($host, $user, $password, $database);
	
	  $sql = "SELECT `recipient`, `sender`, `item1`, `item2` FROM `inbox` WHERE `recipient` = '".$username."'";
	
	  $result = mysqli_query($db, $sql);	
        
        
        $row_count=mysqli_num_rows($result);
          
				echo("<form action = 'inbox2.php' method = 'POST'> <table class = table table-bordered>");
				echo("<tr><th>From</th><th>Your Image</th><th>Your Item</th><th>Your Description</th><th>Your Value</th><th>Their Image</th><th>Their Item</th><th>Their Description</th><th>Their Value</th><th>Accept</th><th>Delete</th></tr>");
				for($i =0; $i < $row_count; $i++){
				  $result->data_seek($i);
          $row = $result->fetch_array(MYSQLI_ASSOC);
          
          $recipient = $row['recipient'];
          $sender = $row['sender'];
          $item1 = $row['item1'];
          $item2 = $row['item2'];
          
          $sql1 = "SELECT `image`, `name`, `description`, `value` FROM `items` WHERE `user-key` = '".$recipient."' AND `name` = '".$item1."'";
	
	        $result1 = mysqli_query($db, $sql1);	
              
          $row_count1=mysqli_num_rows($result1);
         
				        $result1->data_seek(1);
                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                
                $image1 = $row1['image'];
                $name1 = $row1['name'];
                $desc1 = $row1['description'];
                $value1 = $row1['value'];
                
                
          
          $sql2 = "SELECT `image`, `name`, `description`, `value` FROM `items` WHERE `user-key` = '".$sender."' AND `name` = '".$item2."'";
	
	        $result2 = mysqli_query($db, $sql2);	
              
              
              $row_count2=mysqli_num_rows($result2);
            
				        $result2->data_seek(1);
                $row2 = $result2->fetch_array(MYSQLI_ASSOC);
                
                $image2 = $row2['image'];
                $name2 = $row2['name'];
                $desc2 = $row2['description'];
                $value2 = $row2['value'];
                
           echo("<tr><td>".$sender."</td><td>");
           echo("<img alt='product image' height='110' src='data:image/jpeg;base64,".$image1."'></td>");
           echo("<td>".$item1."</td><td>".$desc1."</td><td>".$value1."</td><td>");
           
           echo("<img alt='product image' height='110' src='data:image/jpeg;base64,".$image2."'></td>");
           
           
           echo("<td>".$item2."</td><td>".$desc2."</td><td>".$value2."</td>");
           
           echo("<td><input type='radio' name='accept' value='accept+".$recipient."+".$item1."+".$sender."+".$item2."'></td>");
           echo("<td><input type='radio' name='accept' value='delete+".$recipient."+".$item1."+".$sender."+".$item2."'></td></tr>");
				}
        echo("</table><input type = 'submit' value = 'Accept/Delete' class='btn btn-warning' style = 'width:40%;margin-bottom:10px'>  </form>");
        
        $sql = "SELECT `recipient`, `sender`, `item1`, `item2` FROM `inbox` WHERE `sender` = '".$username."'";
	
	  $result = mysqli_query($db, $sql);	
        
        
        $row_count=mysqli_num_rows($result);
          
				echo("<h2>Pending:</h2><table class = table table-bordered>");
				echo("<tr><th>Sent To</th><th>Their Image</th><th>Their Item</th><th>Their Description</th><th>Their Value</th><th>Your Image</th><th>Your Item</th><th>Your Description</th><th>Your Value</th></tr>");
				for($i =0; $i < $row_count; $i++){
				  $result->data_seek($i);
          $row = $result->fetch_array(MYSQLI_ASSOC);
          
          $recipient = $row['recipient'];
          $sender = $row['sender'];
          $item1 = $row['item1'];
          $item2 = $row['item2'];
          
          $sql1 = "SELECT `image`, `name`, `description`, `value` FROM `items` WHERE `user-key` = '".$recipient."' AND `name` = '".$item1."'";
	
	        $result1 = mysqli_query($db, $sql1);	
              
          $row_count1=mysqli_num_rows($result1);
         
				        $result1->data_seek(1);
                $row1 = $result1->fetch_array(MYSQLI_ASSOC);
                
                $image1 = $row1['image'];
                $name1 = $row1['name'];
                $desc1 = $row1['description'];
                $value1 = $row1['value'];
                
                
          
          $sql2 = "SELECT `image`, `name`, `description`, `value` FROM `items` WHERE `user-key` = '".$sender."' AND `name` = '".$item2."'";
	
	        $result2 = mysqli_query($db, $sql2);	
              
              
              $row_count2=mysqli_num_rows($result2);
            
				        $result2->data_seek(1);
                $row2 = $result2->fetch_array(MYSQLI_ASSOC);
                
                $image2 = $row2['image'];
                $name2 = $row2['name'];
                $desc2 = $row2['description'];
                $value2 = $row2['value'];
                
           echo("<tr><td>".$recipient."</td><td>");
           echo("<img alt='product image' height='110' src='data:image/jpeg;base64,".$image2."'></td>");
           echo("<td>".$item2."</td><td>".$desc2."</td><td>".$value2."</td><td>");
           
           echo("<img alt='product image' height='110' src='data:image/jpeg;base64,".$image1."'></td>");
           
           
           echo("<td>".$item1."</td><td>".$desc1."</td><td>".$value1."</td></tr>");

				}
        echo("</table>");
    ?>
    </div>
    <div class = "container-fluid">
      <form action="landing.php"">
         <input id = "b" type="submit" value="Return to Main Menu" class="btn btn-warning" style = "width:40%">
      </form>
    </div>
    
    <div class = "container-fluid">
      <hr>
      <p>If you have any questions about Swap, please contact the system administrator at <a href="mailto:admin@swap.com">admin@swap.com</a></p>
    </div>
    
  </body>
</html>

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

