<!--
/**
 * CSCI 467 Intro to Software Engineering
 * @author For NIU by David Jones
 * @version 1.0
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 */
-->


<?php 

session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['item_id'])){

    $item_id = $_GET['item_id'];
    $query = "DELETE from line_items WHERE line_itemID = $item_id";
	
	$price_query = "SELECT line_itemPrice FROM line_items WHERE line_itemID = $item_id";
	$price_result = $conn->query($price_query);
	$price_row = $price_result->fetch_assoc();
	$price = $price_row['line_itemPrice'];
	
	$quote_id_query = "SELECT quote_id FROM line_items WHERE line_itemID = $item_id";
	$quote_result = $conn->query($quote_id_query);
	$quote_row = $quote_result->fetch_assoc();
	$quote_id = $quote_row['quote_id'];
	
	$amount_query = "SELECT amount FROM quote WHERE quote_id = $quote_id";
	$amount_result = $conn->query($amount_query);
	$amount_row = $amount_result->fetch_assoc();
	$amount = $amount_row['amount'];

    if ($conn->query($query) === TRUE) {
		$amount = max(0, $amount - $price);
		$update_query = "UPDATE quote SET amount= $amount WHERE quote_id = $quote_id";
		$conn->query($update_query);
		echo "Item deleted successfuly";
	   
		header("Location: update_quote_interface.php?quote_id=$quote_id");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
     }
} else{
    echo "Item not deleted";
    header("Location: update_quote_interface.php?quote_id=$quote_id");
}

?>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>