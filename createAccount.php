<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	p {font-style: normal;}
</style>	
</head>
<body>
<?php

$first = strval($_POST['first']);
$last = strval($_POST['last']);
$email = strval($_POST['email']);
$pass = strval($_POST['pass']);

$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"hilska");
$sql = "insert into users (firstname,lastname,email,password,admin_flag) values ('".$first."', '".$last."', '".$email."', '".$pass."',".0.")";
$query = mysqli_query($con,$sql);
$r = mysqli_fetch_assoc($query);
$pass_from_db = $r['password'];
mysqli_close($con);

if ($query) {
	echo "<p>Thanks for signing up, " . $first . "!</p>";
	echo "Click here to log in with your new account <input type='button' value='Log In' onclick='logInForm()'>";
} 
else {
	echo "<p>Sorry, there was an error creating your account. There may already an account in the system with that email.</p>";;
}


?>
</body>
</html>