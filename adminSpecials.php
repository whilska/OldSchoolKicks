<!DOCTYPE html>
<html>
	<form>
		<h3 align='center'>Specials</h3>
		<table id='specials' width='page'>
			<tr>
				<th>Product ID</th>
				<th>Product</th>
				<th>Special Price</th>
				<th>Start Date</th>
				<th>End Date</th>
			</tr>
			<?php
			// adminSpecials.php
			$showInactiveSpecials = boolval($_GET['showInactiveSpecials']);
			$con = mysqli_connect('localhost','oldschoolkicks','welcome1','oldschoolkicks');
			if (!$con) {
			    die('Could not connect: ' . mysqli_error($con));
			}
			$sql2 = "select * from admin_specials_view";
			if ($showInactiveSpecials) {
				$sql2 = $sql2 . " where active_flag = 0";
			}
			else {
				$sql2 = $sql2 . " where active_flag = 1";
			}
			$query2 = mysqli_query($con,$sql2);
			while($r = mysqli_fetch_assoc($query2)) {
				$start_date = date_create($r['start_date']);
				$end_date = date_create($r['end_date']);
				$dateFormat = 'm/j/Y g:ia';
				echo "<tr>";
				echo "<td>" . $r['shoe_id'] . "</td>";
				echo "<td>" . $r['shoe_name'] . "</td>";
				echo "<td>" . $r['special_price'] . "</td>";
				echo "<td>" . $start_date->format($dateFormat) . "</td>";
				echo "<td>" . $end_date->format($dateFormat) . "</td>";
				echo "</tr>";
			}
			?>
		</table>
		<br>
		<div id="toggleSpecialsLink">
			<?php
			if ($showInactiveSpecials) {
				echo "<a onclick='getAdminSpecials()'>Show Active Specials</a>";
			}
			else {
				echo "<a onclick='getAdminSpecials(true)'>Show Inactive Specials</a>";
			}
			?>
		</div>
	</form>
</html>