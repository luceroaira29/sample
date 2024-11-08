<?php include 'initialize.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record List</title>
</head>
<body>
    <div style="float: right; margin-right: 10%">
    </div>
    <div align="center">
        <h3 style="position:relative">User's Record List</h3>

        <?php
            if (isset($_SESSION['alert_message'])) {
                echo '<div align="center">'. $_SESSION['alert_message'].'</div>';
                unset($_SESSION['alert_message']);
            }
        ?>

        <table border="1" width="50%" cellpadding="5">
            <tr>
                <td colspan="5">
                    <a href="user_add.php">
                        <button>Add User</button>
                    </a>
                    <span style="float:right; margin-right: 10%">
                        Hello, <?php echo isset($_SESSION['user_firstname']) ? $_SESSION['user_firstname'] : 'Guest'; ?> 
                        (<a href="logout.php">logout</a>)
                    </span>
                </td>
            </tr>
            <tr>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Action</th>
            </tr>
            <?php
                $sql = "SELECT * FROM users";
                $result = $connection->query($sql);
            ?>
           <?php if($result->num_rows>0):?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['firstname']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td align="center" width="100px">
                            <button>
                                <a href="user_edit.php?user-id=<?php echo $row['id']; ?>">
                                    Edit
                                </a>
                            </button>
                            <a href="user_delete.php?user-id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">
                                <button>Delete</button>
                            </a>
                        </td>
                    </tr>

                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No records found</td>
                </tr>
            <?php endif; ?>    
        </table>
    </div>
</body>
</html>
