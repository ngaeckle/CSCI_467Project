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
<form method="post">
<label for="start">Start Date From:</label>
<input type="date" id="start" name="cal_start"
       value="2025-11-10"
       min="2024-12-31" max="2027-12-31">
	   
<label for="end">To end date:</label>
<input type="date" id="end" name="cal_end"
       value="2025-11-10"
       min="2024-12-31" max="2027-12-31">
	   
    <label for="statusDropdown">Choose an option:</label>
    <select name="statusDropdown" id="statusDropdown">
		<option value="All">All</option>
        <option value="(Open)">(Open)</option>
        <option value="(Finalized)">(Finalized)</option>
        <option value="(Sanctioned)">(Sanctioned)</option>
		<option value="(Ordered)">(Ordered)</option>		
    </select>
	
<?php
$sql = "SELECT Uusername FROM user WHERE Uusername <> 'admin'"; 
$result = mysqli_query($conn, $sql);
?> 

        <label for="userDropdown">Select associate:</label>
        <select name="userDropdown" id="userDropdown">
		<option value="All">All</option>
		<?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row["Uusername"] . "'>" . $row["Uusername"] . "</option>";
                }
            } else {
                echo "<option value=''>No categories found</option>";
            }
			?>
        </select>
		<br>
<?php
$sql = "SELECT name FROM customers";
$result = mysqli_query($conn2, $sql);
?> 
        <label for="myDropdown">Select customer:</label>
        <select name="myDropdown" id="myDropdown">
		<option value="All">All</option>
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
	<input type="submit" name="dropdown_button">
</form>

<?php
if (isset($_POST['dropdown_button'])) {
    // Retrieve the selected values from the dropdown menus
    $value1 = $_POST['statusDropdown'];
    $value2 = $_POST['userDropdown'];
    $value3 = $_POST['myDropdown'];
	$start_date = $_POST['cal_start'];
	$end_date = $_POST['cal_end'];
	
	$selected_items = [];
    // Example: Store in an array
	if($value1 !== 'All'){
	$selected_items['status'] = " status = '$value1'";
	}
	if($value2 !== 'All'){
	$selected_items['user'] = " associate = '$value2'";	
	}
	if($value3 !== 'All'){
	$selected_items['customer'] = " customer = '$value3'";	
	}

    // Example: Further processing or database storage
    // ...
} else {
    echo "Form not submitted.";
}
?>
    <?php $sql = "SELECT * FROM quote";
	if(isset($start_date) && isset($end_date)){ 
		$sql .= " WHERE event_date BETWEEN '$start_date' AND '$end_date'";
		if(!empty($selected_items)){
			$sql .= ' AND ';
			$sql .= implode(" AND ", $selected_items);
		}
	}

    if ($result = $conn->query($sql)) {
    ?>
        <table class="table" width=50%>
            <thead>
                <td> ID</td>
                <td> Date</td>
                <td> Customer</td>
                <td> Associate </td>
				<td> Address </td>
				<td> Amount </td>
				<td> Status </td>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_row()) {
                ?>
                    <tr>
                    <td><?php printf("%s", $row[0]); ?></td>
                        <td><?php printf("%s", $row[1]); ?></td>
                        <td><?php printf("%s", $row[2]); ?></td>
                        <td><?php printf("%s", $row[3]); ?></td>
						<td><?php printf("%s", $row[4]); ?></td>
						<td><?php printf("%s", $row[9]); ?></td>
						<td><?php printf("%s", $row[10]); ?></td>
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
    <a href="admin_menu.php">Back to Admin Menu</a><br>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
mysqli_close($conn2);
?>