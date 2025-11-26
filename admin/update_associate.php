
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

if (isset($_POST['user_id'])){

    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : " ";
    $username = isset($_POST['username']) ? $_POST['username'] : " ";
    $new_pass = isset($_POST['new_pass']) ? $_POST['new_pass'] : " ";
    $address = isset($_POST['address']) ? $_POST['address'] : " ";
	$commission = isset($_POST['commission']) ? $_POST['commission'] : " ";
	if($new_pass == ""){
		$query = "UPDATE user SET Uusername='$username', address='$address', commission='$commission' WHERE user_id = $user_id";
	}
	else{
		$query = "UPDATE user SET Uusername='$username', Upassword='$new_pass', address='$address', commission='$commission' WHERE user_id = $user_id";
	}
    echo $query;

    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
        header("Location: view_associates.php");
      } else {
        echo "Error updating record: " . mysqli_error($conn);
      }

}
else {
  echo "No user id received on request at update associate";
  die();
}

?>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>