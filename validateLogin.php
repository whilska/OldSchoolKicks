<?php
$email = strval($_POST['email']);
$pass = strval($_POST['pass']);
// $testPass = '$Blizzard93';
// $testEmail = 'bill@test.com';
$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"hilska");
$sql="SELECT firstname,password,admin_flag FROM users where email = '".$email."'";
$query = mysqli_query($con,$sql);
$r = mysqli_fetch_assoc($query);
$pass_from_db = $r['password'];
$admin_flag = $r['admin_flag'];
$firstname = $r['firstname'];
mysqli_close($con);

if ($pass == $pass_from_db) {
	session_start(); 
	if($admin_flag == 1) {
		$_SESSION['admin'] = "true";
		// error_log("admin flag saved to session");
	}
	else {
		$_SESSION['admin'] = "false";
	}
	$_SESSION['firstname'] = $firstname;
	echo "true";
}
else {
	echo "false";
}

?>
