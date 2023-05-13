<?php
	header('Content-Type: application/json');
	require_once('DBConnection.php');
	$db = new DBConnection;
	$conn = $db->conn;

		$sql = "SELECT
		   SUM( `qty`) AS TotalStock
			, `name`
		FROM
			`product_list`
			GROUP BY `name` ORDER BY SUM( `qty`) ASC";
	
		$inventory_result = $conn->query($sql);
		
		$emparray = array();
		
		if ($inventory_result->num_rows > 0) {
			while ($row = $inventory_result->fetch_assoc()) {
				$emparray[] = $row;
			}
		}

		echo json_encode($emparray);

?>