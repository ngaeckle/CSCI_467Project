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

if (isset($_GET['quote_id'])){

    $quoteid = $_GET['quote_id'];
    $query = "DELETE from Quote where quote_id = $quoteid";

    if ($conn->query($query) === TRUE) {
        echo "Quote deleted successfuly";
        header("Location: view_quote.php");
     } else {
         echo "Error: " . $query . "<br>" . $conn->error;
     }
} else{
    echo "No quote received";
    header("Location: view_quotes.php");
}

?>