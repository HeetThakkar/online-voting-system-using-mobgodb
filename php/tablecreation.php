<html>
<head>
<title> Create table  </title>
</head>
<body>
<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'image';
	$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	$sql = "Create table Registration(
			`f_name` varchar(30),
			`l_name` varchar(30),
			`email` varchar(40) Unique,
			`aadhar` int Primary Key,
			`dob` date,
			`Password` varchar(30),
			`image` varchar(55) NOT NULL
			
			)ENGINE=InnoDB DEFAULT CHARSET=latin1;";
		if(mysqli_query($conn,$sql))
	{
		echo "Table Created Successfully";
	}
	else
	{
		echo "Error".mysqli_error($conn);
	}
	$sql1 = "Create table vote(
			`email` varchar(40) Unique,
			`aadhar` int Primary Key,
			`vote_party` char(10)
			);";
	$sql2 = "create table party(name char(20) PRIMARY key,founded_on date,president char(50), overview varchar(500));";
			
	if(mysqli_query($conn,$sql1))
	{
		echo "Table Created Successfully";
	}
	else
	{
		echo "Error".mysqli_error($conn);
	}
	if(mysqli_query($conn,$sql2))
	{
		echo "Table Created Successfully";
	}
	else
	{
		echo "Error".mysqli_error($conn);
	}
	$sql3 = "Create table queries(
		`f_name` varchar(30),
			`l_name` varchar(30),
			`email` varchar(40),
		`subject` char(10),
		`query` varchar(500)
		);";
		
if(mysqli_query($conn,$sql3))
{
	echo "Table Created Successfully";
}
else
{
	echo "Error".mysqli_error($conn);
}

	mysqli_close($conn);
?>
</body>
</html>