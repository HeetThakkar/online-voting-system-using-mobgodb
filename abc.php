<?php
require_once(dirname(__FILE__) . '\vendor\autoload.php');

// connect to mongodb
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
echo "connected to server";
// select a database
$database = $mongoClient->trial;
echo "Database training selected";
$collection = $database->createCollection("mobile");
echo "collection created";

$mycollection = (new mongoDB\Client)->trial->employee;

?>