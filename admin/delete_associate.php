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

if (isset($_GET['user_id'])){

    $userid = $_GET['user_id'];
    $query = "DELETE from User where user_id = $userid";

    if ($conn->query($query) === TRUE) {
        echo "Student deleted successfuly";
        header("Location: view_associates.php");
     } else {
         echo "Error: " . $query . "<br>" . $conn->error;
     }
} else{
    echo "No user_id received";
    header("Location: view_associates.php");
}

?>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>