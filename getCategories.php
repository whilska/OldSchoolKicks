<?php

function getCategories() {
	$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
	if (!$con) {
	    die('Could not connect: ' . mysqli_error($con));
	}
	$sql = "select * from categories where active_flag = 1";
	$query = mysqli_query($con,$sql);
	$rows = array();
	while($r = mysqli_fetch_assoc($query)) {
	    $rows[] = $r;
	}
	return json_encode($rows);
}

// getCategories();
?>