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
    <title>CSCI 467 Quote Sanction</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Sanction Quote</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
        <!-- Displaying a form with the information of the user so values can be modified 
             Note that the ID is not shown to be modified, only other attributes. -->

        <form action="sanction_quote.php" method="post">
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
	        <div class="form-group">
                <label for="line_item">Line Item</label>
                <input class="form-control" type="text" id="line_item" name="line_item" value="<?php echo $row['line_item'] ?>">
            </div>
			<div class="form-group">
                <label for="line_item_price">Line Item Price</label>
                <input class="form-control" type="text" id="line_item_price" name="line_item_price" value="<?php echo $row['line_item_price'] ?>">
            </div>
			<div class="form-group">
                <label for="secret_note">Secret Note</label>
                <input class="form-control" type="text" id="secret_note" name="secret_note" value="<?php echo $row['secret_note'] ?>">
            </div>
			<div class="form-group">
                <label for="amount">Amount</label>
                <input class="form-control" type="text" id="amount" name="amount" value="<?php echo $row['amount'] ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Sanction Quote">
            </div>
        </form>
        <div>
            <br>
            <a href="view_finalized_quote.php">Back to Finalized Quotes</a></br>
        </div>

        <!-- jQuery and JS bundle w/ Popper.js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</body>



</html>