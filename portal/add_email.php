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

if (isset($_POST['email'])){

    $email = isset($_POST['email']) ? $_POST['email'] : " ";
	$quote_id = $_SESSION['quoteid'];
	echo $email;
    $query = "UPDATE quote SET email = '$email' WHERE quote_id = $quote_id";

    if ($conn->query($query) === TRUE) {
        echo "Email updated successfuly";
        header("Location: update_quote_interface.php?quote_id=$quote_id");
     } else {
         echo "Error: " . $query . "<br>" . $conn->error;
     }
} else{
    echo "Error";
    header("Location: view_quote.php");
}

?>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>