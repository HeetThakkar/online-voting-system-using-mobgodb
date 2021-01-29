<?php
session_start();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/edituser.css">   
<title> Edit Profile </title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
	span{
		color: red;
	}
	</style>
</head>
<body> 
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../index.php">Online Voting System</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="userhome.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Parties <span class="caret" style="color: white;"></span></a>
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
      <li><a href="query.php">Quries</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user" style="color: white;"></span> <?php $aadhar=$_SESSION["aadhar1"];  
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
 <?php 
 

 $email=$_SESSION["email"];
 $aadhar=$_SESSION["aadhar1"];
 require_once(dirname(__FILE__) . '\vendor\autoload.php');
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$database = $mongoClient->image;
$collection = $database->register;
 $record = $collection->find(['email' => $email],['limit'=>1]);  
 foreach ($record as $employe) { 
  
   
    $fname =$lname= $email= $oldpassword=$cpassword= $password="";
 $eoldpassword=$ecpassword= $epassword=$eopassword="";
	if($_SERVER["REQUEST_METHOD"]=="POST" ){
        $fname =$_POST["f_name"];
        $lname =$_POST["l_name"];
        $email =$_POST["email"];
        $password =$_POST["psw"];
        $cpassword =$_POST["psw1"];
        $oldpassword =$_POST["old_password"];
    if(!$fname==""){
        $email=  $employe['email'];
        $updateResult = $collection->updateOne(
          [ 'aadhar' => $aadhar ],
          [ '$set' => [ 'f_name' => $fname ]]
      );
    }
    if(!$lname==""){
      $email=  $employe['email'];
      $updateResult = $collection->updateOne(
        [ 'aadhar' => $aadhar ],
        [ '$set' => [ 'l_name' => $lname ]]
    );
    }
    if(!$email==""){
      $email=  $employe['email'];
      $updateResult = $collection->updateOne(
        [ 'aadhar' => $aadhar ],
        [ '$set' => [ 'email' => $email ]]
    );
    }
    if( !$password==""){
        if(!$oldpassword==""){
            if($oldpassword== $employe['Password']){
                if (strlen($_POST["psw"]) <= '8') {
                  $epassword = "Your Password Must Contain At Least 8 Characters!";
                }
                elseif(!preg_match("#[0-9]+#",$password)) {
                  $epassword = "Your Password Must Contain At Least 1 Number!";
                }
                elseif(!preg_match("#[A-Z]+#",$password)) {
                  $epassword = "Your Password Must Contain At Least 1 Capital Letter!";
                }
                elseif(!preg_match("#[a-z]+#",$password)) {
                  $epassword = "Your Password Must Contain At Least 1 Lowercase Letter!";
                } else {
                  $epassword = "";
                }
                
                if( $password== $cpassword &&  $epassword=="" ){
                    $email= $row["email"];
                    $updateResult = $collection->updateOne(
                      [ 'aadhar' => $aadhar ],
                      [ '$set' => [ 'Password' => $password ]]
                  );
                }
            else{
                $ecpassword="does not match the new password";
            }
        }
        else{
            $eopassword="does not match the old password";
        }
    }
    else
    {
      $eopassword="enter old password to update";
    }
}
}
    
    ?>
	
	<div class="login-box" style="height: 570px;">
    <img src="images/av.png" class="avatar">
		<form action="<?php ($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" name="myform">
		First Name<input type="text" name="f_name" placeholder="<?php echo  $employe['f_name']; ?>" ><br>
		Last Name<input type="text" name="l_name" placeholder="<?php echo  $employe['l_name']; ?>" ><br>
		Email Id <input type="email" name="email" placeholder="<?php echo  $employe['email']; ?>" ><br>
		Old password <input type="password" name="old_password"><span style="color: red;"><?php echo $eopassword; ?></span><br>
		New Password<input type="password" name="psw"><span style="color: red;"><?php echo $epassword; ?></span><br>
		Confirm Your Password<input type="password" name="psw1"><br><span style="color: red;"><?php echo $ecpassword; ?></span>
	<br>
    <input type="submit" value="save changes">
</form>
</div>
<?php }?>
</body>
</html>