<?php include 'initialize.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <style type="text/css">
        .center { margin-left: auto; margin-right: auto;}
    </style>
</head>
<body>
    <div align="center">
        <h3>User's Record List</h3>

        <?php
            if (isset($_SESSION['alert_message'])) {
                echo '<div align="center">'.$_SESSION['alert_message'].'</div>';
                unset($_SESSION['alert_message']);
            }
        ?>
        <br>

        <form action="user_add.php" method="post">
            <table class="center" border="1">
                <tr>
                    <td>Firstname</td>
                    <td><input type="text" name="firstname"></td>
                </tr>
                <tr>
                    <td>Lastname</td>
                    <td><input type="text" name="lastname"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
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
                        <button name="register" type="submit">Add</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if (empty($firstname)) {
                $error_message = "Firstname is required!";
            } elseif (empty($lastname)) {
                $error_message = "Lastname is required!";
            } elseif (empty($username)) {
                $error_message = "Username is required!";
            } elseif (empty($password)) {
                $error_message = "Password is required!";
            } elseif (empty($confirm_password)) {
                $error_message = "Confirm Password is required!";
            } elseif ($password !== $confirm_password) {
                $error_message = "Passwords do not match!";
            } else {
                $error_message = null;
            }

            if (!empty($error_message)) {
                $_SESSION['alert_message'] = $error_message;
                header('Location: user_add.php');
                exit();
            } else {
                // Hash password for security
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (firstname, lastname, username, password) VALUES ('$firstname', '$lastname', '$username', '$hashed_password')";

                if ($connection->query($sql) === TRUE) {
                    $_SESSION['alert_message'] = "New record has been created!";
                    header('Location: user_records.php');
                    exit();
                } else {
                    die("Error: " . $connection->error);
                }
            }
        }
    ?> 
</body>
</html>
