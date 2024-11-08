<?php include 'initialize.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style type="text/css">
        .center { margin-left: auto; margin-right: auto; }
    </style>
</head>
<body>
    <?php
        // Check if the user ID is provided and valid
        if (isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
            $user_id = intval($_GET['user-id']);
            $query = "SELECT * FROM users WHERE id = $user_id";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
            } else {
                echo "User not found.";
                exit();
            }
        } else {
            echo "Invalid user ID.";
            exit();
        }
    ?>

    <div align="center">
        <h3>Update User</h3>
        <?php
            if (isset($_SESSION['alert_message'])) {
                echo '<div align="center">'. $_SESSION['alert_message'].'</div>';
                unset($_SESSION['alert_message']);
            }
        ?>

        <br>
        <form method="post" action="">
            <table class="center" border="1">
                <tr>
                    <td>Firstname</td>
                    <td><input type="text" name="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>"></td>
                </tr>
                <tr>
                    <td>Lastname</td>
                    <td><input type="text" name="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button name="update" type="submit">Update</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php
        // Process the form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Validation
            if (empty($firstname)) {
                $error_message = "Firstname is required!";
            } elseif (empty($lastname)) {
                $error_message = "Lastname is required!";
            } elseif (empty($username)) {
                $error_message = "Username is required!";
            } elseif (!empty($password) && $password !== $confirm_password) {
                $error_message = "Passwords do not match!";
            } else {
                $error_message = null;
            }

            if ($error_message) {
                $_SESSION['alert_message'] = $error_message;
                header("Location: user_edit.php?user-id=$user_id");
                exit();
            } else {
                // Hash password if it is set; otherwise keep the existing password
                $hashed_password = empty($password) ? $row['password'] : password_hash($password, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET 
                            firstname = '$firstname', 
                            lastname = '$lastname', 
                            username = '$username', 
                            password = '$hashed_password' 
                        WHERE id = $user_id";

                if ($connection->query($sql) === TRUE) {
                    $_SESSION['alert_message'] = "Record updated successfully!";
                    header('Location: user_records.php');
                    exit();
                } else {
                    echo "Error updating record: " . $connection->error;
                }
            }
        }
    ?>
</body>
</html>
