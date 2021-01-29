<?php
session_start();
?>
<html>
<body>
<?php
require_once(dirname(__FILE__) . '\vendor\autoload.php');
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->image;
$collection = $database->register;
 
$user = $_POST["email"];
$pwd = $_POST["password"];

if ($user=='admin' & $pwd=='admin'){
	header("location: admin.html");
}
$record = $collection->find(['email' => $user],['limit'=>1]);
foreach ($record as $employe) {  
	$_SESSION["aadhar1"]= $employe['aadhar'];
	$_SESSION["email"]= $employe['email'];  

if ($pwd == $employe['Password']) 
	
{
	  if($employe['verification']=="verified")
		{
			header("location:userhome.php");

		
		}
else{
echo '<script>alert("You are not a verified user! ");  window.location.href = "index1.html";</script>'; 
}
       
	}
	
	else{

		echo '<script>alert("You have entered wrong password!  ");  window.location.href = "index1.html";</script>'; 

	}
}

?>
</body>
</html>