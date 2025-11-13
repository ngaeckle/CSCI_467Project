
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

// Accessing the information for the DB connection from the configuration file and validating that a user is logged in.
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (isset($_GET['quote_id'])){

    $quote_id = isset($_GET['quote_id']) ? $_GET['quote_id'] : " ";
	
	echo var_dump($quote_id);
	
	$query = "SELECT associate, customer FROM quote WHERE quote_id = '$quote_id'";	
	$result = $conn->query($query);
    $row = mysqli_fetch_array($result);
	$customer_name = $row['customer'];
    $username = $row['associate'];

    $query = "UPDATE quote SET status='(Ordered)' WHERE quote_id = $quote_id";;
    echo $query;
    if (mysqli_query($conn, $query)) {
        echo "Order processed successfully!";
        header("Location: process_orders.php");
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

echo var_dump($order_id);

$sql = "SELECT id AS custid FROM customers WHERE name = '$customer_name'";
$result = $conn2->query($sql);
$row = mysqli_fetch_array($result);
$custid = $row['custid'];

echo var_dump($custid);

$sql = "SELECT associate_id FROM user WHERE Uusername ='$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$associate_id = $row['associate_id'];

echo var_dump($associate_id);


$sql = "SELECT amount FROM quote WHERE quote_id = '$quote_id'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
$amount = $row['amount'];

echo var_dump($amount);

$sql = "INSERT INTO orders(order_id, associate_id, quote_id, custid, amount) VALUES ('$order_id', '$associate_id', '$quote_id', '$custid', '$amount')";

echo var_dump($sql);

if (mysqli_query($conn, $sql)) {
       echo "Order processed successfully!";
       header("Location: process_orders.php");
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
echo($result);
?>