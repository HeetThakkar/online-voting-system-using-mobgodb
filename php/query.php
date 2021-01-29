<?php
session_start();
$cn=mysqli_connect("localhost","root","","image") or die("Could not Connect My Sql");
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../styles/query.css">   
<title> Query </title>
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
      <li class="active"><a href="../index.php">Home</a></li>
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
    <?php
    if($aadhar=""){
        ?>
    <ul class="nav navbar-nav navbar-right">
   
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user" style="color: white;"></span> <?php $aadhar=$_SESSION["aadhar1"];  
    $sql = "SELECT f_name
    FROM registration
    where aadhar=$aadhar";
$result= mysqli_query($cn,$sql);
while($row = $result->fetch_assoc()) {
  echo $row["f_name"]; }?> <span class="caret" style="color: white;"></span></a>
        <ul class="dropdown-menu">
          <li><a href="edituser.php" >Edit Profile </a></li>
          <li><a href="../index.php" >Log Out</a></li>
         
        </ul>
      </li>
     
  
     </ul>
  </div>
  <?php }
  else{
      ?>
    <ul class="nav navbar-nav navbar-right">
    <li><a href="registration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
    <li><a href="../index1.html"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
  </ul>
</div>
 <?php }
  ?>
</nav>
 <?php 
 
if(!$_SESSION["aadhar1"]==""){
$aadhar=$_SESSION["aadhar1"];
$email=$_SESSION["email"];
}
$conn = mysqli_connect("localhost","root","","image") or die("Could not Connect My Sql");

$sql1 = "SELECT *
FROM registration
WHERE email='$email' or aadhar='$aadhar' ";
$result1 = mysqli_query($conn,$sql1);
while($row = $result1->fetch_assoc()){
    $fname =$lname= $email= $query=$subject= "";
 $efname=$eemail= $equery="";
	if($_SERVER["REQUEST_METHOD"]=="POST" ){
    if($aadhar==""){
        $fname =$_POST["f_name"];
        if($fname==""){
            $efname="please enter your first name";
        }
        $lname =$_POST["l_name"];
        $email =$_POST["email"];
        if($email==""){
            $email="please enter your email";
        }
    }
    else{
        $fname=$row["f_name"];
        $lname=$row["l_name"];
        $email=$row["email"];
    }
        $subject=$_POST["subject"];
        
        $query=$_POST["query"];
        if($query==""){
            $equery="please enter your query";
        }
    }
if( $query=="" || $email=="" || $fname==""){
       
    ?>
	
	<div class="login-box" style="height: 570px;">
    <img src="../images/av.png" class="avatar">
		<form action="<?php ($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" name="myform">
		First Name<input type="text" name="f_name" placeholder="<?php echo $row["f_name"] ?>" ><span style="color: red;"><?php echo $efname; ?></span><br>
		Last Name<input type="text" name="l_name" placeholder="<?php echo $row["l_name"] ?>" ><br>
		Email Id <input type="email" name="email" placeholder="<?php echo $row["email"] ?>" ><span style="color: red;"><?php echo $eemail; ?></span><br>
		Subject <input type="text" name="subject"><br>
        Query <input type="textarea" name="query"><span style="color: red;"><?php echo $equery; ?></span><br>
	<br>
    <input type="submit" value="save changes">
</form>
</div>
<?php }
else {
echo $fname . $lname . $email . $subject . $query;
mysqli_close($conn);
mysqli_close($cn);
$cn=mysqli_connect("localhost","root","","image") or die("Could not Connect My Sql");

 $sql4 = "INSERT INTO `queries` (`f_name`,`l_name`,`email`,`subject`,`query`)  VALUES ('$fname','$lname','$email','$subject','$query')";
 if (mysqli_query($cn, $sql4)) {
     
     echo '<script>alert("Your query is noted! ");  window.location.href = "../index.php";</script>'; 

 }
 else
 {
     echo "Error".mysqli_error($cn);
 }


}  }?>
</body>
</html>