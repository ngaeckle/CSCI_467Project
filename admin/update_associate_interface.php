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

if (isset($_GET['user_id'])) {
    $userid = $_GET['user_id'];
    $sql = "SELECT * FROM User where user_id = $userid";
    $result = $conn->query($sql);
    $row = mysqli_fetch_array($result);
}
else {
    echo "No user id received on request at update_student_interface get";
    die();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CSCI 467 Admin Update</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div style="margin-top: 20px" class="container">
        <h1>Update User</h1>
        <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->

        <form action="update_associate.php" method="post">
            <input type="hidden" name="user_id" id="userid" value="<?php echo $row['user_id'] ?>">
            <div class="form-group">
                <label for="first_name">User</label>
                <input class="form-control" type="text" id="username" name="username" value="<?php echo $row['Uusername'] ?>">
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input class="form-control" type="text" id="new_pass" name="new_pass">
            </div>
            <div class="form-group">
                <label for="last_name">Address</label>
                <input class="form-control" type="text" id="address" name="address" value="<?php echo $row['address'] ?>">
            </div>
	       <div class="form-group">
                <label for="last_name">Commission</label>
                <input class="form-control" type="text" id="commission" name="commission" value="<?php echo $row['commission'] ?>">
            </div>
            <div class="form-group">
                <input class="btn btn-primary" name='Submit' type="submit" value="Update">
            </div>
        </form>
        <div>
            <br>
            <a href="admin_menu.php">Back to Admin Menu</a></br>
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