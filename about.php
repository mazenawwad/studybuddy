<?php
    //  include 'connection.php';
    session_start();

    //  $user_id = $_SESSION['user_id'];
    //  if (!isset($user_id)) {
    //      header('location: login.php');
    //  }
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
    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>about us</h1>
        <p>Get to know Study Buddy and its Creators!</p>
    </div>
    <div class="about">
        <div class="row">
            <div class="detail">
                <h1>Welcome to Study Buddy!</h1>
                <p> Experience the power of personalized one-on-one sessions and enriching group lessons. Our dedicated tutors are experts in their fields, ready to guide you on your academic journey. Unlock your true potential and conquer complex concepts with us. Join our educational haven today and embark on a transformative learning experience.</p>
                <a href="tutors.php" class="btn2">tutors now</a>
            </div>

        </div>
    </div>
    <div class="banner-2">
        <h1>Let us make your academic journey flawless!</h1>
        <a href="tutors.php" class="btn2">tutors now</a>
    </div>
    <div class="services">
        <h1 class="title">our services</h1>
        <div class="box-container">
            <div class="box">
                <i class="bi bi-alarm"></i>
                <h3>Flexible Time</h3>
                <p>Expand your horizon with tutors available anytime to fit your schedule.</p>
            </div>
            <div class="box">
                <i class="bi bi-book"></i>
                <h3>Exam Preparation</h3>
                <p>Maximize your exam success with our highly qualified tutors, chosen to help you achieve exceptional results.</p>
            </div>
            <div class="box">
                <i class="bi bi-award   "></i>
                <h3>Academic Counceling</h3>
                <p>Navigate your academic journey with personalized counseling from the best of the best</p>
            </div>
        </div>
    </div>
    <div class="stylist">
        <h1 class="title">StudyBuddy</h1>
        <p>Meet the Miracle Team</p>
        <div class="box-container">
            <div class="box">
                <div class="image-box">
                    <img src="image/hammoudcredit.jpg" width="300" height="300">
                    <div class="social-links">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-whatsapp"></i>
                        <i class="bi bi-behance"></i>
                    </div>
                </div>
                <h4>Moe Hammoud</h4>
                <p>developer</p>
            </div>
            <div class="box">
                <div class="image-box">
                    <img src="image/mazencredit.jpg" width="300" height="300">
                    <div class="social-links">
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-whatsapp"></i>
                        <i class="bi bi-behance"></i>
                    </div>
                </div>
                <h4>Mazen Awwad</h4>
                <p>developer</p>
            </div>
        </div>
    </div>
    <!-- <div class="testimonial-container">
        <h1 class="title">what people say</h1>
        <div class="container">
            <div class="testimonial-item active">
                <img src="image/test.jpg" width="100">
                <h3>sara smith</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat.</p>
            </div>
            <div class="testimonial-item">
                <img src="image/test.jpg">
                <h3>joe mama</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat.</p>
            </div>
            <div class="testimonial-item">
                <img src="image/test.jpg">
                <h3>lauren</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat.</p>
            </div>
            <div class="left-arrow" onclick="nextSlide();"><i class="bi bi-arrow-left"></i></div>
            <div class="right-arrow" onclick="prevSlide();"><i class="bi bi-arrow-right"></i></div>
        </div>
    </div> -->
    <section class="home-contact">
        <h1>have any question ?</h1>
        <p style="font-size: 20px;"> If you have any questions or need further clarification, please don't hesitate to reach out.
             Our team is here to assist you and provide the information you need. Feel free to contact us
              and we will get back to you as soon as possible. We value your inquiries and look forward to
               helping you with any concerns you may have.</p>
        <a href="contact.php" class="btn2">contact us</a>
    </section>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>