<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style type = "text/css">
        .center{ margin-left: auto; margin-right: auto;}
    </style>
</head>
<body>
    <div class="center">
        <form method="POST" action="auth.php">
            <br>
            <h3 align="center">Welcome! Please Login</h3>
            <?php
                if (isset($_SESSION['alert_message'])) {
                    echo '<div align="center">'.$_SESSION['alert_message'].'</div>';

                    unset($_SESSION['alert_message']);
                }
            ?>

            <table class="center" border="1">
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name = "password"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button name="login" type="submit">Submit</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>