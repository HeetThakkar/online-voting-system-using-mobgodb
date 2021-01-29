<?php
session_start();
?>
<html>
<body style="background-color: cyan;">
<?php
$verification = $_POST['verification'];
$aadhar=$_SESSION["aadhar"];
require_once(dirname(__FILE__) . '\vendor\autoload.php');
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->image;
$collection = $database->register;
$record = $collection->find(['aadhar' => $aadhar],['limit'=>1]);  
foreach ($record as $employe) { 

if($verification=='verified')
{
  $updateResult = $collection->updateOne(
    [ 'aadhar' => $aadhar ],
    [ '$set' => [ 'verification' => "verified" ]]
);
}
else{
  $updateResult = $collection->updateOne(
    [ 'aadhar' => $aadhar ],
    [ '$set' => [ 'verification' => "not-verified" ]]
);
}

	echo"<h1 style='text-align: center ;font-size: 40px;font-style: italic; opacity: 1.0;margin-top:250px;'>". "User saved as $verification! "."</h1>";
}
?>
<a href="verify.php" style="margin-left: 42%;text-decoration:none ">Click here to Verify users</a>
</body>
</html>