<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location: login.php');
}

// Check if the form is submitted
if (isset($_POST['submit-btn'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $courses = mysqli_real_escape_string($connection, $_POST['courses']);
    $experience = mysqli_real_escape_string($connection, $_POST['experience']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $linked_in = mysqli_real_escape_string($connection, $_POST['linked_in']);
    $video_link = mysqli_real_escape_string($connection, $_POST['video_link']);

    mysqli_query($connection, "INSERT INTO `requests`(`user_id`, `name`,`email`,`courses`, `experience`, `description`, `linked_in`, `video_link`) 
    VALUES ('$user_id', '$name', '$email', '$courses', '$experience', '$description', '$linked_in', '$video_link')") or die('query failed2');

    // Redirect to the result page to prevent form resubmission on page refresh
    header('location: tutor_request.php?submitted=true');
    exit();
}

// Get the status of the requests
$select_request = mysqli_query($connection, "SELECT * FROM `requests` WHERE `user_id`='$user_id' LIMIT 1");
$requests = mysqli_fetch_assoc($select_request);
$status = isset($requests) ? $requests['status'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <?php if ($status != 'pending'): ?>
        <h1 class="result">Status</h1>
        <?php else: ?>
        <h1>Tutor Request Form</h1>
        <?php endif; ?>
    </div>
    <div class="form-container">
        <?php if (!isset($requests)): ?>
        <div class="form-section">
            <?php if (isset($_GET['submitted'])): ?>
            <p>Your request has been submitted. Thank you!</p>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="courses">Courses:</label>
                    <input type="text" id="courses" name="courses">
                </div>
                <div class="form-group">
                    <label for="experience">Experience:</label>
                    <textarea id="experience" name="experience" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="linked_in">LinkedIn Profile:</label>
                    <input type="text" id="linked_in" name="linked_in">
                </div>
                <div class="form-group">
                    <label for="video_link">Video Introduction Link:</label>
                    <input type="text" id="video_link" name="video_link">
                </div>
                <button type="submit" name="submit-btn" class="btn btn-primary">Submit Request</button>
            </form>
        </div>
        <?php else: ?>
        <div class="form-section">
            <?php if ($status == 'approved'): ?>
            <h1>Your tutor request has been approved. Thank you!</h1>
            <?php elseif ($status == 'rejected'): ?>
            <h1>Your tutor request has been rejected. Please try again later.</h1>
            <?php else: ?>
            <h1>Your tutor request is still pending. Please wait for the approval.</h1>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>

</body>

</html>