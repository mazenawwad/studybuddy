<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location: login.php');
}

/* send message */
if (isset($_POST['submit-btn'])) {
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    $user_query = mysqli_query($connection, "SELECT * FROM `users` WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($user_query);
    $name = $user_data['name'];
    $email = $user_data['email'];
    $select_message = mysqli_query($connection, "SELECT * FROM `messages` WHERE name = '$name' AND email= '$email' AND 
    message='$message'") or die('query failed1');

    if (mysqli_num_rows($select_message) > 0) {
        $message[] = 'message already sent';
    } else {
        mysqli_query($connection, "INSERT INTO `messages`(`user_id`, `name`,`email`, `message`) 
        VALUES ('$user_id', '$name', '$email', '$message')") or die('query failed2');
        $message[] = 'message sent successfully';
    }
}
?>

<style type="text/css">
<?php include 'main.css';
?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <title>Study Buddy</title>
</head>

<body>
 <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message">
                        <span>'. $message .'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>';
        }
    }
    ?> 
    <?php include 'header.php'; ?> 
    <div class="banner">
        <h1>contact us</h1>
        <p>Always here for you! </p>
    </div>
    <div class="help">
        <h1 class="title">need help</h1>
        <div class="box-container">
            <div class="box">
                <div>
                    <img src="image/subjs.webp" class="contactpics">
                    <h2>Various Subjects</h2>
                </div>
                <p>All what you need, we got you covered</p>
            </div>
            <div class="box">
                <div>
                    <img src="image/teachers.jpg" class="contactpics">
                    <h2>Professional Tutors</h2>
                </div>
                <p>Only the best of the best</p>
            </div>
            <div class="box">
                <div>
                    <img src="image/teamwork.webp" class="contactpics">
                    <h2>Responsive Team</h2>
                </div>
                <p>Always at your service</p>
            </div>
            <div class="box">
                <div>
                    <img src="image/aplus.webp" class="contactpics">
                    <h2>Our Goal</h2>
                </div>
                <p>We need this both here and irl</p>
            </div>
        </div>
    </div>
    <div class="form-container">
        <div class="form-section">
            <form method="post">
                <h1>Ask Away!</h1>
                <p style="color: black; font-size: 18px;">Expect an answer soon!</p>
                <div class="form-group">
                    <label for="message"></label>
                    <textarea name="message" id="message" rows="5" required placeholder="What's on your mind?"></textarea>
                </div>
                <button type="submit" name="submit-btn" class="btn">Send</button>
            </form>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>