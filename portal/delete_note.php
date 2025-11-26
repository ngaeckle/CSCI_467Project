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

if (isset($_GET['note_id'])){

    $note_id = $_GET['note_id'];
    $query = "DELETE from secret_notes WHERE secret_noteID = $note_id";
	
	$quote_id = $_SESSION['quoteid'];

    if ($conn->query($query) === TRUE) {
        echo "Note deleted successfuly";
        header("Location: update_quote_interface.php?quote_id=$quote_id");
     } else {
         echo "Error: " . $query . "<br>" . $conn->error;
     }
} else{
    echo "No note received";
    header("Location: view_quote.php");
}

?>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>