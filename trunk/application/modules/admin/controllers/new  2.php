$response["products"] = array();
	 
	while ($row = mysql_fetch_array($result)) {
		// temp user array
		$product = array();
		$product["pid"] = $row["pid"];
	$product["name"] = $row["name"];
		$product["price"] = $row["price"];
		$product["created_at"] = $row["created_at"];
		$product["updated_at"] = $row["updated_at"];
 
			// push single product into final response array
			array_push($response["products"], $product);
		}
		// success
		$response["success"] = 1;
	 
		// echoing JSON response
		echo json_encode($response);