<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	p {font-style: normal;}
	table {
    	width: 100%;
	}
	th {text-align: left;}
</style>	
</head>
<body>

<?php

echo 
"<form id='contentDiv'>
<h2 align='center'>Catalogue</h2>";

$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"hilska");
if (isset($_GET['c'])) {
	// sick
	$category = intval($_GET['c']);
	$sql="SELECT * FROM shoes where category_id = ".$category;
}
else {
	$sql="SELECT * FROM shoes";
}
$query = mysqli_query($con,$sql);

// 2 on a row
$count = 0;
echo "<table id='catalogue' width='page'>";

while($r = mysqli_fetch_assoc($query)) {
	if ($r['quantity'] == "0") {
		$buyString = "SOLD OUT";
	}
	else {
		$buyString = "We have [".$r['quantity']."] left in stock <input type='button' value='Add to Cart' onclick='addToCart(".$r['id'].",0)'>";
	}
	if ($count < 2) {
		if ($count == 0) {
			// start new row
			echo "<tr>";
		}
		// add entry
		echo "<td>";
		echo "<img class='prodImg' src='".$r['pic_link']."' height='300' width='400' align='middle'><br>";
		echo $r['shoe_name']."<br>''".$r['shoe_desc']."''<br>$".$r['price']."<br>";
		echo $buyString;
		echo "</td>";
		$count = $count + 1;
	}
	else {
		// end row
		echo "</tr>";
		echo "<tr>";
		echo "<td>";
		echo "<img class='prodImg' src='".$r['pic_link']."' height='300' width='400' align='middle'><br>";
		echo $r['shoe_name']."<br>''".$r['shoe_desc']."''<br>$".$r['price']."<br>";
		echo $buyString;
		echo "</td>";
		$count = 1;
	}
}

echo "</table>";
echo "</form>";
mysqli_close($con);
?>

</body>
</html>