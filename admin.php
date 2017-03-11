<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="admin.css">
</style>
<script type="text/javascript" id="adminJs">
	$( function() {
		$(".datepicker").datepicker();
		getAdminSpecials();
	});
	$.getScript("adminFunctions.js");
	echoGetCategories();
	function getAdminSpecials(showInactiveSpecials){
		$.get('adminSpecials.php', {showInactiveSpecials: showInactiveSpecials},
			function(response){
				document.getElementById("adminSpecials").innerHTML = response;
			});
	}
</script>	
</head>
<body>

<?php
$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
$sql = "select * from shoes order by quantity";
$query = mysqli_query($con,$sql);
echo "<form>";
echo "<h3 align='center'>Inventory</h3>";

echo "<table id='invTbl' width='page'>
<tr>
<th>Product ID</th>
<th>Quantity</th>
<th>Product</th>
<th>Price</th>
<th>Update Price</th>
<th>Delete</th>
</tr>";

while($r = mysqli_fetch_assoc($query)) {
	echo "<tr>";
	echo "<td>" . $r['id'] . "</td>";
	echo "<td>" . $r['quantity'] . "</td>";
	echo "<td>" . $r['shoe_name'] . "</td>";
	echo "<td>" . $r['price'] . "</td>";
	echo "<td><input type='button' name='update_price' value='New Price' onclick='updatePrice(".$r['id'].")'></td>";
	echo "<td><input type='radio' name='del' onclick='deleteProduct(".$r['id'].")'></td>";
	echo "</tr>";
}

echo "</table>";
echo "</form>";
?>
<form>
<h3 align='center'>Input New Item</h3>
	Shoe Name: <input type='text' name='shoe_name'><br>
	Shoe Description: <input type='text' name='shoe_desc'><br>
	Price: <input type='text' name='price'><br>
	Quantity: <input type='text' name='quantity'><br>
	Link to Image: <input type='text' name='pic_link'><br>
	Category: <select class='search' name='category_id'></select><br>
	<input type='button' value='Add Product' onclick='addProduct(this)'>
</form>
<div id='adminSpecials'></div>
<br>
<form>
	Product ID: <input type='text' name='shoe_id' placeholder="Product ID">
	Sale Price: <input type='number' name='special_price' min="0" max="1000000" placeholder="0">
	Sale Starts: <input type='text' class="datepicker" name='start_date' placeholder="Start Date">
	Sale Ends: <input type='text' class="datepicker" name='end_date' placeholder="End Date">
	<input type='button' value='Create Special' onclick='addSpecial(this)'>
</form>
<?php
$sql3 = "SELECT * FROM shoppers_report_view ORDER BY user_email";
$query3 = mysqli_query($con,$sql3);

echo "<h3 align='center'>Shopper's Report</h3>";
echo "<table id='shoppers' width='page'>
<tr>
<th>Email</th>
<th>Last Name</th>
<th>First Name</th>
<th>Product</th>
<th>Product ID</th>
</tr>";

while($r = mysqli_fetch_assoc($query3)) {
	echo "<tr>";
	echo "<td>" . $r['user_email'] . "</td>";
	echo "<td>" . $r['lastname'] . "</td>";
	echo "<td>" . $r['firstname'] . "</td>";
	echo "<td>" . $r['shoe_name'] . "</td>";
	echo "<td>" . $r['shoe_id'] . "</td>";
	echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>

</body>
</html>