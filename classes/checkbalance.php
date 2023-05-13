<?php
	require_once('DBConnection.php');
	$db = new DBConnection;
	$conn = $db->conn;
	
	$client_name = $_POST['client_name'];  

	$stmt = $conn->prepare("SELECT * FROM sale_list WHERE amount > tendered AND client_name=?");
 
	$stmt->bind_param("s", $client_name);

	$stmt->execute();

	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->close();
		echo true;
	} else {
		$stmt->close();
		echo false;
	} 

?>