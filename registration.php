<html>
<head>
<link rel="stylesheet" type="text/css" href="styles/style.css">   
<title> Registration </title>
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
      <a class="navbar-brand" href="index.php">Online Voting System</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
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
      <li><a href="#">Quries</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="registration.php"><span class="glyphicon glyphicon-user" style="color: white;"></span> Sign Up</a></li>
      <li><a href="index1.html"><span class="glyphicon glyphicon-log-in" style="color: white;"></span> Login</a></li>
    </ul>
  </div>
</nav>
  

<?php
	$fname =$lname= $email= $dob=$aadhar=$cpassword=$image= $password="";
	$efname =$elname= $eemail= $edob=$eaadhar=$ecpassword=$eimage= $epassword ="";
	if($_SERVER["REQUEST_METHOD"]=="POST" ){
        $fname =$_POST["f_name"];
        $lname =$_POST["l_name"];
        $email =$_POST["email"];
        $dob=$_POST["dob"];
        $aadhar =$_POST["aadhar"];
		$password =$_POST["psw"];
		$cpassword =$_POST["psw1"];
		if(empty($fname)){
			$efname="First Name is required";
			echo "<script>document.myform.f_name.focus();</script>";
		  }
		  if(empty($lname)){
			$elname="Last Name is required";
		  }
		  if(empty($email)){
			$eemail="Email-Id is required";
		  }
		  if(empty($dob)){
			$edob="Date of Birth is required";
		  }
		  if(empty($aadhar)){
			$eaadhar="aadhar number is required";
		  }
		  if(!empty($aadhar)){
			if (strlen($_POST["aadhar"]) < '12' || strlen($_POST["aadhar"]) > '12') {
				$eaadhar="Please enter a valid aadhar without space";
			}
		  }
		  if(empty($password)){
			$epassword="Password is required";
		  }

		  if(empty($cpassword)){
			$ecpassword="Confirm password is required";
		  }
		  
		  if($cpassword!=$password){
			$ecpassword="Password does not match ";
		  }
		  if(!empty($password)){
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
		  }
		}
		if(empty($fname) || empty($lname) || empty($email) ||empty($dob) || empty($aadhar) || empty($password) || empty($cpassword) || !empty($efname) || !empty($elname) || !empty($eemail) || !empty($edob) || !empty($eaadhar) || !empty($epassword) || !empty($ecpassword) ){
		
	?>     
	<div class="login-box" style="height: 820px;">
    <img src="images/av.png" class="avatar">
		<form action="<?php ($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" name="myform">
		First Name<input type="text" name="f_name" ><span>*<?php echo $efname ?></span><br>
		Last Name<input type="text" name="l_name" ><span>*<?php echo $elname ?></span><br>
		Email Id <input type="email" name="email" ><span>*<?php echo $eemail ?></span><br>
		DOB <input type="date" name="dob" ><span>*<?php echo $edob ?></span><br>
		Aadhar number <input type="Text" name="aadhar" ><span>*<?php echo $eaadhar ?></span><br>
		Password<input type="password" name="psw"><span>*<?php echo $epassword ?></span><br>
		Confirm Your Password<input type="password" name="psw1"><span>*<?php echo $ecpassword ?></span><br>
		Upload a age proof
    <input type="file" name="image[]" /><span>*</span><br>
    <button type="submit" style="background-color: red;" >Upload</button>
</form>
</div>
<br>
	<?php   }
	else{

		require_once(dirname(__FILE__) . '\vendor\autoload.php');
		$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
		$database = $mongoClient->image;
		$collection = $database->register;
		 
$output_dir = "upload/";/* Path for file upload */
	$RandomNum   = time();
	$ImageName      = str_replace(' ','-',strtolower($_FILES['image']['name'][0]));
	$ImageType      = $_FILES['image']['type'][0];
 
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
	$ImageExt       = str_replace('.','',$ImageExt);
	$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
	$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
    $ret[$NewImageName]= $output_dir.$NewImageName;
	
	/* Try to create the directory if it does not exist */
	if (!file_exists($output_dir))
	{
		@mkdir($output_dir, 0777);
	}               
	move_uploaded_file($_FILES["image"]["tmp_name"][0],$output_dir."/".$NewImageName );
	     
		 $collection->insertOne([
			'f_name' => $_POST["f_name"],
			'l_name' => $_POST["l_name"],
			'email' => $_POST["email"],
			'dob' => $_POST["dob"],
			'aadhar' => $_POST["aadhar"],
			'Password' => $_POST["psw"],
			'image' => $NewImageName,
			'verification'=>null
		  ]);
			
			echo '<script>alert("You are successfully registered! ");  window.location.href = "index.php";</script>'; 

		


	}	
	
?>
</body>
</html>