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

$quote_id = $_SESSION['quoteid'];

$amount_query = "SELECT amount FROM quote WHERE quote_id = $quote_id";
$amount_result = $conn->query($amount_query);
$amount_row = $amount_result->fetch_assoc();
$amount = $amount_row['amount'];

if (isset($_POST['discount']) !== ''){
	$num = $_POST['discount'];
}

if (isset($_POST['discount_button'])){
	if (isset($_POST['discount_option'])) {
		$option = $_POST['discount_option'];
		if($option == 'percentage'){
			$percentage = $amount * .01 * $num;
			$amount = max(0, $amount - $percentage);
		}
		else if($option == 'amount'){
			$amount = max(0, $amount - $num);
		}
	}
}

$update_query = "UPDATE quote SET amount= $amount WHERE quote_id = $quote_id";
   
   if ($conn->query($update_query) === TRUE) {
		echo "Discount added";
		header("Location: update_quote_interface.php?quote_id=$quote_id");
    } else{
    echo "Discount not added";
    header("Location: update_quote_interface.php?quote_id=$quote_id");
}



?>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>