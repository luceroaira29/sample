<?php include 'initialize.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Logout</title>
    <style type="text/css">
        .center { margin-left: auto; margin-right: auto;}
    </style>
</head>
<body>
    <div align = "center">
        <h4>Welcome</h4>
        <?php
            if (isset($_SESSION['alert_message'])) {
                echo'<div align="center"><b><i>'.$_SESSION['alert_message'].'</i></b></div>';
                unset($_SESSION['alert_message']);
            }
         ?>   
         <br>
         <?php if(isset($_SESSION['is_login'])) : ?>

            <h3>Congratulations! You are now login. Click <a href="logout.php">here</a>to logout</h3>

            <?php else: ?>
                <table border="1" width="20%">
                    <tr>
                        <td align="center"><a href="login.php">Login</a></td>
                    </tr>
                    <tr>
                        <td align="center"><a href="register.php">Register</a></td>
                    </tr>
                </table>

                <br><br>

                <?php endif; ?>
    </div>
</body>
</html>