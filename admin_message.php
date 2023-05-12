<?php
include 'connection.php';
session_start();

$admin_id = $_SESSION['admin_id'];
// Check if the admin ID is not set
if (!isset($admin_id)) {
    // Redirect the admin to the login page
    header('location: login.php');
}

// Check if the 'logout' form has been submitted
if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();
    // Redirect the admin to the login page
    header('location: login.php');
}

// Check if the 'delete' parameter is present in the URL
if (isset($_GET['delete'])) {
    // Retrieve the delete ID from the URL parameter
    $delete_id = $_GET['delete'];
    // Execute the delete query on the 'messages' table
    mysqli_query($connection, "DELETE FROM `messages` WHERE id = '$delete_id'") or die('Query Failed');
    // Redirect the admin to the 'admin_message.php' page
    header('location: admin_message.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Panel</title>
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php
    if (isset($message)) {
        foreach ($message as $message) { //loop over them 

            echo '
                    <div class="message">
                    <span>' . $message . '</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div> ';
        }
    }
    ?> 
   <section class="user-container">
        <h1 class="title">Messages</h1>
        <div class="box-container">
        <?php
        $select_message = mysqli_query($connection, "SELECT * FROM `messages`") or die('query failed');
        // Execute a SELECT query on the 'messages' table and store the result in $select_message
    // If the query fails, terminate the script and display the message 'query failed'
        if (mysqli_num_rows($select_message) > 0) {
            while ($fetch_message = mysqli_fetch_assoc($select_message)) {
                        // Fetch each row from the result set and assign it to $fetch_message

                ?>
                <div class="box">
                <p>user id: <span><?php echo $fetch_message['user_id']; ?></span></p>
                <p>user name: <span><?php echo $fetch_message['name']; ?></span></p>
                <p>email: <span><?php echo $fetch_message['email']; ?></span></p>
                <p>message: <span><?php echo $fetch_message['message']; ?></span></p>
                <a href="admin_message.php?delete=<?php echo $fetch_message['id']; ?>" class="delete" onclick="return
                confirm('delete this')">Delete</a>
                </div>
                <?php
            }
        } else {
            echo '<p  style= "text-align:center; text-transform: capitalize; font-size:20px"> No Messages Yet</p>';
        }
        ?>
        </div>
</section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html> 