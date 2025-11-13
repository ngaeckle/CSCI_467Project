
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

if (isset($_POST['quote_id'])){

    $quote_id = isset($_POST['quote_id']) ? $_POST['quote_id'] : " ";

    $query = "UPDATE quote SET status='(Finalized)' WHERE quote_id = $quote_id"; 
    echo $query;

    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
        header("Location: view_quote.php");
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }
}
else {
  echo "No quote id received on request at finalize quote";
  die();
}

?>