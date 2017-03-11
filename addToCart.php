<?php

$email = strval($_POST['email']);
$shoe_id = intval($_POST['shoe_id']);

$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"hilska");
$sql = "call proc_addToCart(" . $shoe_id . ",'" . $email . "')";
$query = mysqli_query($con,$sql);
if ($query) {
	echo "Item successfully added to cart";
} 
else {
	error_log(mysqli_error($con));
	echo "Could not add item to cart";
	// var_dump($shoe_id);
}
mysqli_close($con);
?>