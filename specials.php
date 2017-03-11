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


$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$sql = "SELECT * FROM display_specials_view";
$query = mysqli_query($con,$sql);
if (mysqli_num_rows($query) > 0) {
	$count = 0;
	echo "<form id='contentDiv'><h2 align='center'>Specials</h2>";
	echo "<table id='specials' width='page'>";
	while($r = mysqli_fetch_assoc($query)) {
		$buyString = "We have [".$r['quantity']."] left in stock <input type='button' value='Add to Cart' onclick='addToCart(".$r['shoe_id'].",1)'>";
		if ($count < 2) {
			if ($count == 0) {
				// start new row
				echo "<tr>";
			}
			// add entry
			echo "<td>";
			echo "<img class='prodImg' src='".$r['pic_link']."' height='300' width='400' align='middle'><br>";
			echo $r['shoe_name']."<br>''".$r['shoe_desc']."''<br>$".$r['special_price']."<br>";
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
			echo $r['shoe_name']."<br>''".$r['shoe_desc']."''<br>$".$r['special_price']."<br>";
			echo $buyString;
			echo "</td>";
			$count = 1;
		}
	}
	echo "</table>";
	echo "</form>";
}
else {
	echo "noSpecials";
}
mysqli_close($con);
?>

</body>
</html>