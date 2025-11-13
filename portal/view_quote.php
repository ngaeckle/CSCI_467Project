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
/*
* Reference for tables: https://getbootstrap.com/docs/4.5/content/tables/
*/

session_start();
require_once('../config.php');
require_once('../validate_session.php');
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>

<?php
$sql = "SELECT name FROM customers"; // Replace 'categories' and 'id', 'name' with your table and column names
$result = mysqli_query($conn2, $sql);
?> 

    <form action="create_quote.php" method="post">
        <label for="myDropdown">Choose an option:</label>
        <select name="myDropdown" id="myDropdown">
		<?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                }
            } else {
                echo "<option value=''>No categories found</option>";
            }
			?>
        </select>
        <button type="submit" name="submitButton" >Submit</button>
    </form>
	<?php
    if (isset($_POST['submitButton'])) {
        $selectedValue = $_POST['myDropdown'];
        echo "You selected: " . htmlspecialchars($selectedValue);
    }
	
    ?>

    <?php $sql = "SELECT * FROM quote";
    if ($result = $conn->query($sql)) {
    ?>
        <table class="table" width=50%>
            <thead>
                <td> ID</td>
                <td> Customer</td>
                <td> Address</td>
                <td> Email </td>
				<td> Line Item </td>
				<td> Line Item Price </td>
				<td> Secret Note </td>
				<td> Amount </td>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_row()) {
                ?>
                    <tr>
                    <td><?php printf("%s", $row[0]); ?></td>
                        <td><?php printf("%s", $row[2]); ?></td>
                        <td><?php printf("%s", $row[4]); ?></td>
                        <td><?php printf("%s", $row[5]); ?></td>
						<td><?php printf("%s", $row[6]); ?></td>
						<td><?php printf("%s", $row[7]); ?></td>
						<td><?php printf("%s", $row[8]); ?></td>
						<td><?php printf("%s", $row[9]); ?></td>
                        <td><a href="update_quote_interface.php?quote_id=<?php echo $row[0] ?>">Update</a></td>
                        <td><a href="delete_quote.php?quote_id=<?php echo $row[0] ?>">Delete</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
    <!-- Link to return to Associate_menu-->
    <a href="Associate_menu.php">Back to Associate Menu</a><br>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
mysqli_close($conn2);
?>
