
<!--
/**
 * CSCI 467 Intro to Software Engineering
 * @author For NIU by David Jones
 * @version 1.0
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 */
--><?php

// Accessing the information for the DB connection from the configuration file and validating that a user is logged in.
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['quote_id'])){

    $quote_id = isset($_GET['quote_id']) ? $_GET['quote_id'] : " ";
	
	$query = "SELECT associate, customer FROM quote WHERE quote_id = '$quote_id'";	
	$result = $conn->query($query);
    $rows = mysqli_fetch_array($result);
	$customer_name = $rows['customer'];
    $username = $rows['associate'];


    $query = "UPDATE quote SET status='(Ordered)' WHERE quote_id = $quote_id";
    if (mysqli_query($conn, $query)) {
       } else {
       echo "Error processing: " . mysqli_error($conn);
	}
   }
	else {
		echo "No quote id received on request at process order";
		die();
}

function generateLetters(int $numOfLetters): String {
	$characters = 'abcdefghijklmnopqrstuvwxyz';
    $shuffled_characters = str_shuffle($characters);
    return substr($shuffled_characters, 0, $numOfLetters);
}

function generateNineDigits(): Int {
	$randomNumber = mt_rand(100000000, 999999999);
	return $randomNumber;
}

$id_char = generateLetters(3);
$id_num = generateNineDigits();
$id_char2 = generateLetters(2);

$order_id = $id_char. "-". $id_num. "-" .$id_char2;



$sql = "SELECT id AS custid FROM customers WHERE name = '$customer_name'";
$result = $conn2->query($sql);
$row = mysqli_fetch_array($result);
$custid = $row['custid'];

$sql = "SELECT associate_id FROM user WHERE Uusername ='$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$associate_id = $row['associate_id'];


$sql = "SELECT amount FROM quote WHERE quote_id = '$quote_id'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$amount = $row['amount'];

$sql = "INSERT INTO orders(order_id, associate_id, quote_id, custid, amount) VALUES ('$order_id', '$associate_id', '$quote_id', '$custid', '$amount')";


if (mysqli_query($conn, $sql)) {
     } else {
       echo "Error processing: " . mysqli_error($conn);
     }
	 
$url = 'http://blitz.cs.niu.edu/PurchaseOrder/';
$data = array(
	'order' => $order_id, 
	'associate' => $associate_id,
	'custid' => $custid, 
	'amount' => $amount);
		
$options = array(
    'http' => array(
        'header' => array('Content-type: application/json', 'Accept: application/json'),
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

$data = json_decode($result, true);

$commission = $data['commission'];
$commission = intval($commission);
$commission = $commission*.01;
$amount = $commission * $amount;

$process_day = $data['processDay'];
$commission_percent = $data['commission'];
$time_stamp = $data['timeStamp'];
$order_id = $data['order'];
$_id = $data['_id'];
$name = $data['name'];

$sql = "UPDATE orders SET name = '$name', processDay = '$process_day', commission = '$commission_percent', timeStamp='$time_stamp', _id='$_id' WHERE order_id = '$order_id'";

if (mysqli_query($conn, $sql)){
	} else{
		echo "Error updating record: " . mysqli_error($conn);
	}

$sql = "UPDATE user SET commission = commission + '$amount' WHERE associate_id = '$associate_id'";
if (mysqli_query($conn, $sql)) {
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }


$message1 = "Order has been processed for: $process_day";
$message2 = "Commission of $$amount has been credited to: " . $rows['associate'];

echo "<script type='text/javascript'>alert('$message1\\n$message2');
window.location.href='process_orders.php';</script>";
	  ?>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>