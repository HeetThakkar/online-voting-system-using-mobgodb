<?php
session_start();
?>
<html>
<body>
<?php
$aadhar=$_SESSION["aadhar1"];
$email=$_SESSION["email"];


require_once(dirname(__FILE__) . '\vendor\autoload.php');
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->image;
$collection = $database->register;
$record = $collection->find(['email' => $email],['limit'=>1]);  
foreach ($record as $employe) { 
  



		if ($employe['vote']==null)
		{
			header("location: ballot.html");

		}
		else
		{
			echo '<script>alert("You have already voted once! you are not allowed to vote again ");  window.location.href = "../index.php";</script>'; 
		session_destroy();
		}
       
	
}



?>
</body>
</html>