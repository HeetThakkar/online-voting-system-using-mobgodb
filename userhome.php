<?php
session_start();
$cn=mysqli_connect("localhost","root","","image") or die("Could not Connect My Sql");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../index.php">Online Voting System</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="../index.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Parties <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="https://www.inc.in/en" target="_blank">INC</a></li>
          <li><a href="https://www.bjp.org/" target="_blank">BJP</a></li>
          <li><a href="https://shivsena.org/en/" target="_blank">SHIVSENA</a></li>
          <li><a href="https://aamaadmiparty.org/" target="_blank">AAP</a></li>
          <li><a href="https://www.bspindia.org/" target="_blank">BSP</a></li>
          <li><a href="https://www.samajwadiparty.in/" target="_blank">SP</a></li>
          <li><a href="https://ncp.org.in/en/home/" target="_blank">NCP</a></li>
          <li><a href="https://cpim.org/" target="_blank">CPI(M)</a></li>
          <li><a href="https://aitcofficial.org/" target="_blank">AITC</a></li>
        </ul>
      </li>
      <li><a href="#">Quries</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php $aadhar=$_SESSION["aadhar1"];  
 $email=$_SESSION["email"];
 $aadhar=$_SESSION["aadhar1"];
 require_once(dirname(__FILE__) . '\vendor\autoload.php');
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->image;
$collection = $database->register;
 $record = $collection->find(['email' => $email],['limit'=>1]);  
 foreach ($record as $employe) { 
   echo $employe['f_name']; }?> <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="edituser.php" >Edit Profile </a></li>
          <li><a href="index.php" >Log Out</a></li>
         
        </ul>
      </li>
     
  
     </ul>
  </div>
</nav>
<br><br>
  <h3 style="color: red; margin-left:5%;"> Dear <?php $record = $collection->find(['email' => $email],['limit'=>1]);  
 foreach ($record as $employe) { 
   echo $employe['f_name']; }?> please go through the bellow instructions before you vote. </h3>
<ol style="margin-left: 8%;">
<li>Check if the account is your else click <a href="../index.php" >Log Out</a>. </li>
<li>Decide which party to vote. If you need any help about the party  <a href="../index.php#party" >click here</a>. </li>
<li>Vote only if you are 18+ years old.</li>
<li>Vote only once. </li>
<li>Accept the terms and condition to vote. </li><br>
<form action="voting.php" method="POST">
 Please check the box to accept <input type="checkbox" name="" id="" required> <span style="color: red;">*</span><br>
 <br>
  <input type="submit" value="Vote">
</form>
</ol>

</body>
</html>
