<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$name = $_POST['my_item_name'];
	$price = $_POST['my_item_price'];
	
	$quote_id = $_SESSION['quoteid'];
	
	$sql = "INSERT INTO line_items(line_itemName, line_itemPRICE, quote_id) VALUES ('$name', '$price', $quote_id)";
	
	$amount_query = "SELECT amount FROM quote WHERE quote_id = $quote_id";
	$amount_result = $conn->query($amount_query);
	$amount_row = $amount_result->fetch_assoc();
	$amount = (float) $amount_row['amount'];
	
	$amount = $amount + $price;
	
	if($conn->query($sql) === TRUE){
	$new_amount_query = "UPDATE quote SET amount = '$amount' WHERE quote_id = $quote_id";
		$conn->query($new_amount_query);
		echo "Line item added successfully";
		header("Location: update_quote_interface.php?quote_id=$quote_id");
	} else{
		echo "Error adding Line Item";
	}
	
	$conn->close();
}
?>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>