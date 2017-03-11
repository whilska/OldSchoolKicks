<?php
session_start();
/*if( isset($_GET['email']) )
{
    $_SESSION['email'] = strval($_GET['email']);
    $_SESSION['admin'] = strval($_GET['admin']);
    $_SESSION['firstname'] = strval($_GET['firstname']);
}*/
if (isset($_GET['d'])) {
	session_unset(); 
	session_destroy(); 
	echo "User logged out";
}
else {
	$retVal = [
		'email' => $_SESSION['email'],
		'admin' => $_SESSION['admin'],
		'firstname' => $_SESSION['firstname'],
	];
	echo json_encode($retVal);
	// echo $_SESSION['email'];
}

?>