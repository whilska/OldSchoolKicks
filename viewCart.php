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
// viewCart.php
$email = strval($_POST['email']);
// var_dump($email);
$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"hilska");
$sql = "SELECT * FROM shopping_cart_view WHERE email = '" . $email . "'";
$query = mysqli_query($con,$sql);
?>
<form>
<h2 align='center'>Shopping Cart</h2>
<table id='shoppingCart' width='page'>
<tr>
<th>
	<a id="viewCartSelect" onclick="selectAllCartItems()">Select</a>
</th>
<th>Product Name</th>
<th>Price</th>
</tr>
<?php
$subtotal = 0;
while($r = mysqli_fetch_assoc($query)) {
	echo "<tr>";
    // echo "<td><input type='checkbox' onclick=removeItemFromCart(".$r['id'].")></td>";
    echo "<td><input class='cartItems' type='checkbox' value=" . $r['id'] . "></td>";
    echo "<td>" . $r['shoe_name'] . "</td>";
    if ($r['special_price'] == NULL) {
	    $price = $r['price'];
	}
	else {
		$price = $r['special_price'];
	}
	echo "<td> $" . $price . "</td>";
    echo "</tr>"; 
    $subtotal = $subtotal + $price;
    // var_dump($r);
}
echo "<tr><td>-</td><td>-</td><td>-</td></tr>";
echo "<tr><td></td><td>Subtotal</td><td>$".$subtotal."</td></tr>";
mysqli_close($con);
?>
</table>
<button type="button" onclick=removeMultipleFromCart()>Remove</button>
</form>
</body>
<html>