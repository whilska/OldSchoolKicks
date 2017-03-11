<?php
$cart_ids_arr = json_decode($_POST['cart_ids']);
$success = false;
if (sizeof($cart_ids_arr) > 0) {
	$success = true;
	$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
	if (!$con) {
	    die('Could not connect: ' . mysqli_error($con));
	}
	$sql = "";
	// Builds delimited string of SP calls for each value from cart_ids, and executes a multi query
	foreach ($cart_ids_arr as $value) {
		$sql .= "call proc_removeFromCart(". $value .");";
	}
	$query = mysqli_multi_query($con,$sql);
	if($query == false){
		$success = false;
		error_log("[MySQL Error] " . mysqli_error($con));
	}
	mysqli_close($con);	
}
echo $success;
?>