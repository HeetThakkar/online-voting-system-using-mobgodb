<?php
session_start();
?>
<html>
<head>
<title> Verification </title>
<style>
  body{
    background-color: cyan;
    text-align: left;
  }
</style>
</head>
<body> 
  <h1 style="text-align: center;">Please select verified only if details match</h1>
<?php
require_once(dirname(__FILE__) . '\vendor\autoload.php');
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->image;
$collection = $database->register;
$record = $collection->find(['verification' => null],['limit'=>1]);  
foreach ($record as $employe) { 



    echo "- first name: " . $employe['f_name']."<br>"."<br>";
    echo " - last Name: " . $employe["l_name"]."<br>"."<br>";
    echo "- Aadhar number " . $employe["aadhar"]."<br>"."<br>";
    echo "- Date of birth " . $employe["dob"] ."<br>"."<br>";
    $src='upload/'. $employe["image"];
    $_SESSION["aadhar"] = $employe["aadhar"];
    ?>
    <img src="<?php echo $src; ?>" alt="" width="200px" height="150px"><br><br>
    <form action="verification.php" method="POST">
        <select name="verification" id="">
            <option value="verified">verified</option>
            <option value="not-verified" default>not-verified</option>

        </select>
        <input type="submit" value="submit">

    </form>
    <?php
?>

<?php   
}


?>
 </body>
</html> 