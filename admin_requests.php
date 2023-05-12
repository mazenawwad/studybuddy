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
/* delete requests detail from database */
if (isset($_GET['delete'])) {
    // Retrieve the delete ID from the URL parameter
    $delete_id = $_GET['delete'];
    // Execute the delete query on the 'requests' table
    mysqli_query($connection, "DELETE FROM `requests` WHERE id = '$delete_id'") or die('Query Failed');
    // Redirect the admin to the 'admin_requests.php' page
    header('location: admin_requests.php');
}


/* update requests detail */
if (isset($_POST['update_request'])) {
    // Check if the 'update_request' form has been submitted

    $request_id = $_POST['request_id'];
    // Retrieve the request ID from the form data

    $update_status = $_POST['status'];
    // Retrieve the updated status from the form data

    $message = '';
    // Initialize the $message variable to an empty string

    if ($update_status == 'accepted') {
        // If the updated status is 'accepted'

        mysqli_query($connection, "UPDATE `requests` SET status='accepted' WHERE id='$request_id'") or die('query failed');
        // Execute the update query on the 'requests' table to set the status to 'accepted' for the specified request ID

        $message = 'Application accepted and payment ';
        // Set the message indicating that the application was accepted
    } elseif ($update_status == 'rejected') {
        // If the updated status is 'rejected'

        mysqli_query($connection, "UPDATE `requests` SET status='rejected' WHERE id='$request_id'") or die('query failed');
        // Execute the update query on the 'requests' table to set the status to 'rejected' for the specified request ID

        $message = 'Application rejected and payment ';
        // Set the message indicating that the application was rejected
    } elseif ($update_status == 'pending') {
        // If the updated status is 'pending'

        mysqli_query($connection, "UPDATE `requests` SET status='pending' WHERE id='$request_id'") or die('query failed');
        // Execute the update query on the 'requests' table to set the status to 'pending' for the specified request ID

        $message = 'Application status set to pending a';
        // Set the message indicating that the application status was set to pending
    }

    header('location:admin_requests.php?message=' . urlencode($message));
    // Redirect the admin to the 'admin_requests.php' page with a URL parameter 'message' that contains the encoded message
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
        foreach ($message as $message) {
            echo '
                    <div class="message">
                    <span>' . $message . '</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div> ';
        }
    }
    ?>
    <section class="requests-container">
        <h1 class="title">Tutor Applications</h1>
        <div class="box-container">
            <?php
      $select_requests = mysqli_query($connection, "SELECT * FROM `requests` WHERE status='pending' OR status='rejected'") or die('Query Failed1');

       if (mysqli_num_rows($select_requests) > 0) {
           ?>
            <div class="tutor_applications">
                <?php while ($fetch_requests = mysqli_fetch_assoc($select_requests)) { ?>
                <div class="box">
                    <p>User Name: <span><?php echo $fetch_requests['name']; ?></span></p>
                    <p>Email: <span><?php echo $fetch_requests['email']; ?></span></p>
                    <p>Courses: <span><?php echo $fetch_requests['courses']; ?></span></p>
                    <p>Experience: <span><?php echo $fetch_requests['experience']; ?></span></p>
                    <p>Description: <span><?php echo $fetch_requests['description']; ?></span></p>
                    <p>Linked in: <span><?php echo $fetch_requests['linked_in']; ?></span></p>
                    <p>Video Link: <span><?php echo $fetch_requests['video_link']; ?></span></p>
                    <form method="post">
                        <input type="hidden" name="request_id" value="<?php echo $fetch_requests['id']; ?>">
                        <select name="status">
                            <option disabled selected><?php echo $fetch_requests['status']; ?></option>
                            <option value="accepted">Accept</option>
                            <option value="rejected">Reject</option>
                        </select>
                        <input type="submit" name="update_request" value="Update requests" class="btn">
                        <a href="admin_requests.php?delete=<?php echo $fetch_requests['id']; ?>" class="delete"
                            onclick="return confirm('Delete this?')">Delete</a>

                    </form>
                </div>
                <?php } ?>
            </div>
            <?php } ?>

        </div>
    </section>

    <script type="text/javascript" src="script.js"></script>
</body>

</html>