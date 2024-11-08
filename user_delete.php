<?php include 'initialize.php'; ?>

<?php
    $user_id = $_GET['user-id'];
    $sql = "DELETE FROM users WHERE id=".$user_id;

    if ($connection->query($sql) === TRUE) {
        $_SESSION['alert_message'] = "Record has been deleted!";
        header('Location:user_records.php');
    } else {
        echo "Error deleting record: ". $connection->error;
    }

?>