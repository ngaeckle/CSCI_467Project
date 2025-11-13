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

<header><b>List of Sanctioned quotes:</b></header>

    <?php $sql = "SELECT * FROM quote WHERE status='(Sanctioned)'";
	$sql2 = "SELECT COUNT(*) AS numOfSanctioned FROM quote WHERE status='(Sanctioned)'";
	$result2 = $conn->query($sql2);
    if ($result = $conn->query($sql)) {
    ?>
        <table class="table" width=50%>
            <thead>
                <td> ID</td>
                <td> Date</td>
                <td> Customer</td>
                <td> Associate</td>
				<td> Amount</td>
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
						<td><?php printf("%s", $row[9]); ?></td>
                        <td><a href="process.php?quote_id=<?php echo $row[0] ?>">Process Order</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
	<b>Number of Sanctioned quotes:</b>
	<?php
	$row=$result2->fetch_assoc();
	$num = $row["numOfSanctioned"];
	echo $num;
	
	?>
    <!-- Link to return to Associate_menu-->
    <br><a href="hq_menu.php">Back to HQ Menu</a><br>
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
?>