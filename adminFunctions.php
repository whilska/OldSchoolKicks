<?php
$function = strval($_POST['f']);

$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"hilska");

if ($function == "aShoe") {
	$name = strval($_POST['name']);
	$desc = strval($_POST['desc']);
	$price = floatval($_POST['price']);
	$quantity = intval($_POST['quantity']);
	$link = strval($_POST['link']);
	
	$category; 
	if (empty($_POST['category'])) { // Handle empty category
		$category = "NULL";
	}
	else {
		$category = intval($_POST['category']);
	}

	$sql = "insert into shoes (shoe_name,shoe_desc,price,quantity,pic_link,category_id) values ('".$name."','".$desc."',".$price.",".$quantity.",'".$link."',".$category.")";
	$query = mysqli_query($con,$sql);
	if ($query) {
		echo "Product Successfully added";
	}
	else {
		echo "Error adding product";
	}
}
elseif ($function == "aSpecial") {
	$id = intval($_POST['shoe_id']);
	$special_price = floatval($_POST['special_price']);
	$start_date;
	$end_date;
	// Sets start_date to null if in query if it is blank/null
	if (empty($_POST['start_date'])) {
		$start_date = "NULL";
	}
	else {
		$start_date_dt = date_create_from_format('m/j/Y G:i:sa', strval($_POST['start_date']) . ' 12:00:00 AM');
		$start_date = "'" . $start_date_dt->format('Y-m-d H:i:s') . "'";
	}
	// Sets end_date to null if in query if it is blank/null
	if (empty($_POST['end_date'])) {
		$end_date = "NULL";

	}
	else {
		$end_date_dt = date_create_from_format('m/j/Y G:i:sa', strval($_POST['end_date']) . ' 12:00:00 AM');
		$end_date = "'" . $end_date_dt->format('Y-m-d H:i:s') . "'";	
	}
	$sql = "INSERT INTO specials (shoe_id,special_price,start_date,end_date) values (".$id.",".$special_price.",".$start_date.",".$end_date.")";
	//$sql = "INSERT INTO specials (shoe_id,special_price,end_date) values (" . $id . "," . $special_price . ",'" . $end_date . "')";
	$query = mysqli_query($con,$sql);
	if ($query) {
		echo "New special added";
	}
	else {
		error_log($sql);
		echo "Error processing request";
	}
}
elseif ($function == "uShoe") {
	$newPrice = floatval($_POST['price']);
	$id = intval($_POST['id']);
	$sql = "UPDATE shoes SET price = ".$newPrice." WHERE id =".$id;
	$query = mysqli_query($con,$sql);
	if ($query) {
		echo "Price updated";
	}
	else {
		echo "Error updating price";
	}
}
elseif ($function == "dShoe") {
	$id = intval($_POST['id']);
	$sql = "delete from shoes where id=".$id;
	$query = mysqli_query($con,$sql);
	if ($query) {
		echo "Product successfully deleted";
	}
	else {
		echo "Error deleting product";
	}

}
else {
	echo "badArg";
}

mysqli_close($con);
?>
