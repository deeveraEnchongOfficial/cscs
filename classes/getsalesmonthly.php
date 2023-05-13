<?php
	header('Content-Type: application/json');
	require_once('DBConnection.php');
	$db = new DBConnection;
	$conn = $db->conn;
	
	$sql = "SELECT
		SUM(`sale_products`.`qty`) AS TotalSales
		, `product_list`.`name`
	FROM
		`sale_products`
		INNER JOIN `sale_list` 
			ON (`sale_products`.`sale_id` = `sale_list`.`id`)
		INNER JOIN `product_list` 
			ON (`sale_products`.`product_id` = `product_list`.`id`)
			WHERE  YEAR(sale_list.date_created)=YEAR(CURDATE()) AND MONTH(sale_list.date_created)=moNTH(CURDATE())
		   GROUP BY `product_list`.`name` ORDER BY SUM(`sale_products`.`qty`) DESC;";

	$inventory_result = $conn->query($sql);
	
	$emparray = array();
	
	if ($inventory_result->num_rows > 0) {
		while ($row = $inventory_result->fetch_assoc()) {
			$emparray[] = $row;
		}
	}

	echo json_encode($emparray);

?>