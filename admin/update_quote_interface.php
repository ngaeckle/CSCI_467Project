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

if (isset($_GET['quote_id'])) {
    $quoteid = $_GET['quote_id'];
    $sql = "SELECT * FROM quote WHERE quote_id = $quoteid";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
}
else {
    echo "No user id received on request at update_quote_interface get";
    die();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CSCI 467 Quote Update</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Update Quote</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <!-- Displaying a form with the information of the user so values can be modified 
             Note that the ID is not shown to be modified, only other attributes. -->

        <form action="update_quote.php" method="post">
			<input type="hidden" name="quote_id" id="quote_id" value="<?php echo $row['quote_id'] ?>">
			<div class="form-group">
                <label for="customer">Customer</label>
                <input class="form-control" type="text" id="customer" name="customer" value="<?php echo $row['customer'] ?>">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input class="form-control" type="text" id="address" name="address" value="<?php echo $row['address'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" id="email" name="email" value="<?php echo $row['email'] ?>">
            </div>
						<label for="Line Items">Line Items:</label>
			<br>
			<?php 
			$sql = "SELECT q.quote_id AS quote_id, l.line_itemName AS name, l.line_itemID AS item_id, l.line_itemPrice AS price FROM Quote q LEFT JOIN line_items l ON q.quote_id = l.quote_id WHERE q.quote_id = $quoteid ORDER by l.line_itemName, l.line_itemPrice";
			
			$result = $conn->query($sql);
			$price = 0;
			while($data = $result->fetch_assoc()){
				echo "<input type=text placeholder= " . '"' . $data["name"] . '"' . " disabled>";
				echo "<input type=text placeholder= " . '"' . $data["price"] . '"' . " disabled>";
				if($data["item_id"] != ''){
					echo "<a href=delete_line_item.php?item_id=". $data["item_id"] . ">Delete</a></td>";
				}
				echo "<br>\n";
					$price = $data["price"] + $price;
				}
				$amount = $price;
			$sql = "UPDATE quote SET amount = '$amount' WHERE quote_id = $quoteid";
			$conn->query($sql);
			?>
			
			<label for="Line Items">Secret Notes:</label>
			<br>
			
			<?php 
			$sql = "SELECT q.quote_id AS id, n.secret_noteID AS note_id, n.secret_noteSTRING AS note FROM quote q LEFT JOIN secret_notes n ON q.quote_id = n.quote_id WHERE q.quote_id = $quoteid ORDER by n.secret_noteSTRING";
			
			$result = $conn->query($sql);
			while($data = $result->fetch_assoc()){
				echo "<input type=text placeholder= " . '"' . $data["note"] . '"' . " disabled>";
				if($data["note_id"] != ''){
					echo "<a href=delete_note.php?note_id=". $data["note_id"] . ">Delete</a></td>";
				}
				echo "<br>\n";
				}
			?>
			<div class="form-group">
                <label for="amount">Amount</label>
                <input class="form-control" type="text" id="amount" name="amount" value="<?php echo $row['amount'] ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Update">
            </div>
        </form>
        <div>
            <br>
            <a href="view_quotes.php">Back to Quotes</a></br>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>



</html>

<?php
mysqli_close($conn2);
mysqli_close($conn);
?>