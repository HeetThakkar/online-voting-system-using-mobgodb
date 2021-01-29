<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
</head>
<body style="background-color:rgb(180, 178, 178) ;opacity: 0.7;">
    <h1 style="text-align: center;font-style: italic;"><u>RESULTS</u></h1>

<?php

   echo "<div style=' background-color: rgb(180, 178, 178);opacity: 1.0;margin-left:47%'>";
   require_once(dirname(__FILE__) . '\vendor\autoload.php');
   $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
   $database = $mongoClient->image;
   $collection = $database->vote;
      
   $record = $collection->find(); 
   foreach ($record as $employe) {  
       echo $employe['aadhar'] ." ". $employe['vote']."<br>";
   }
echo "</div>";

?>
</body>
</html>