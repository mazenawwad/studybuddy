<?php
include 'connection.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location: login.php');
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('location: login.php');
}
if (isset($_GET['delete'])) {
    // Check if the 'delete' parameter is present in the URL query string

    $delete_id = $_GET['delete'];
    // Retrieve the value of the 'delete' parameter from the URL query string

    $select_review = mysqli_query($connection, "SELECT * FROM `reviews` WHERE id = '$delete_id'");
    // Execute a SELECT query on the 'reviews' table to retrieve the review with the specified ID

    if (mysqli_num_rows($select_review) > 0) {
        // Check if a review with the specified ID exists

        $fetch_review = mysqli_fetch_assoc($select_review);
        // Fetch the data of the review from the result of the SELECT query

        $tutor_id = $fetch_review['tutor_id'];
        $rating = $fetch_review['rating'];
        // Retrieve the tutor ID and rating from the fetched review data

        $select_tutor = mysqli_query($connection, "SELECT * FROM `tutors` WHERE id = '$tutor_id'");
        // Execute a SELECT query on the 'tutors' table to retrieve the tutor with the specified ID

        if (mysqli_num_rows($select_tutor) > 0) {
            // Check if a tutor with the specified ID exists

            $fetch_tutor = mysqli_fetch_assoc($select_tutor);
            // Fetch the data of the tutor from the result of the SELECT query

            $total_ratings = $fetch_tutor['total_ratings'];
            $raters = $fetch_tutor['raters'];
            // Retrieve the total ratings and raters count from the fetched tutor data

            if ($raters > 0) {
                // Check if there are existing raters for the tutor

                $new_total_ratings = $total_ratings - $rating;
                $new_raters = $raters - 1;
                // Calculate the new total ratings and raters count by subtracting the rating of the deleted review

                mysqli_query($connection, "UPDATE `tutors` SET total_ratings = '$new_total_ratings', raters = '$new_raters' WHERE id = '$tutor_id'");
                // Execute an UPDATE query on the 'tutors' table to update the total ratings and raters count for the tutor
            }
        }
    }

    mysqli_query($connection, "DELETE FROM `reviews` WHERE id = '$delete_id'") or die('Query Failed');
    // Execute a DELETE query on the 'reviews' table to delete the review with the specified ID

    header('location:admin_reviews.php');
    // Redirect the admin to the 'admin_reviews.php' page after deleting the review
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <h1 class="title">Reviews</h1>
    <div class="search-container">
        <form action="" method="POST">
            <input type="text" placeholder="Search by name or ID" name="search">
            <button type="submit" name="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="box-container">
        <?php
       if (isset($_POST['submit'])) {
        // Check if the form with the name 'submit' is submitted
    
        $search = mysqli_real_escape_string($connection, $_POST['search']);
        // Retrieve the value of the 'search' input field from the submitted form and escape special characters
    
        $select_reviews = mysqli_query($connection, "SELECT * FROM `reviews`") or die('query failed');
        // Execute a SELECT query to retrieve all reviews from the 'reviews' table
    
        if (mysqli_num_rows($select_reviews) > 0) {
            // Check if there are reviews available
    
            while ($fetch_reviews = mysqli_fetch_assoc($select_reviews)) {
                // Fetch each review data from the result of the SELECT query
    
                $tutor_id = $fetch_reviews['tutor_id'];
                // Retrieve the tutor ID from the fetched review data
    
                $select_tutors = mysqli_query($connection, "SELECT * FROM `tutors` WHERE id = '$tutor_id'") or die('query failed');
                // Execute a SELECT query to retrieve the tutor with the specified ID
    
                $fetch_tutors = mysqli_fetch_assoc($select_tutors);
                // Fetch the data of the tutor from the result of the SELECT query
    
                $search = strtolower($search);
                $tutor_name = strtolower($fetch_tutors['name']);
                $tutor_id = strtolower($fetch_reviews['tutor_id']);
                // Convert the search term, tutor name, and tutor ID to lowercase for case-insensitive comparison
    
                if (strpos($tutor_name, $search) !== false || strpos($tutor_id, $search) !== false) {
                    // Check if the search term is present in the lowercase tutor name or tutor ID
    
                    echo '<div class="box">
                    <p>Tutor Name: <span>' . $fetch_tutors['name'] . '</span></p>
                    <p>Tutor ID: <span>' . $fetch_reviews['tutor_id'] . '</span></p>
                    <div class="rating">';
                    // Output the tutor name and ID in an HTML paragraph and display the rating stars
    
                    $rating = $fetch_reviews['rating'];
                    // Retrieve the rating from the fetched review data
    
                    for ($i = 0; $i < 5; $i++) {
                        if ($rating >= $i + 1) {
                            echo '<span class="fa fa-star checked"></span>';
                        } else if ($rating > $i) {
                            echo '<span class="fa fa-star-half-o checked"></span>';
                        } else {
                            echo '<span class="fa fa-star-o"></span>';
                        }
                    }
                    echo '</div>
                  <p>Rated by: ' . $fetch_tutors['raters'] . ' users</p>
                  <p>reviews: <span>' . $fetch_reviews['text'] . '</span></p>
                  <a href="admin_reviews.php?delete=' . $fetch_reviews['id'] . '" class="delete" onclick="return confirm(\'delete this\')">Delete</a>
                </div>';
                // Output the tutor's rating, number of raters, review text, and a delete link for each matched result
                }
            }
        }
        else {
            echo "No results found";
        }
    }
    else {
        // This block is executed when the form with the name 'submit' is not submitted
    
        $select_reviews = mysqli_query($connection, "SELECT * FROM `reviews`") or die('query failed');
        // Execute a SELECT query to retrieve all reviews from the 'reviews' table
    
        if (mysqli_num_rows($select_reviews) > 0) {
            // Check if there are reviews available
    
            while ($fetch_reviews = mysqli_fetch_assoc($select_reviews)) {
                // Fetch each review data from the result of the SELECT query
    
                $tutor_id = $fetch_reviews['tutor_id'];
                // Retrieve the tutor ID from the fetched review data
    
                $select_tutors = mysqli_query($connection, "SELECT * FROM `tutors` WHERE id = '$tutor_id'") or die('query failed');
                // Execute a SELECT query to retrieve the tutor with the specified ID
    
                $fetch_tutors = mysqli_fetch_assoc($select_tutors);
                // Fetch the data of the tutor from the result of the SELECT query
    
                echo '<div class="box">
                <p>Tutor Name: <span>' . $fetch_tutors['name'] . '</span></p>
                <p>Tutor ID: <span>' . $fetch_reviews['tutor_id'] . '</span></p>
                <div class="rating">';
                // Output the tutor name and ID in an HTML paragraph and display the rating stars
    
                $rating = $fetch_reviews['rating'];
                // Retrieve the rating from the fetched review data
    
                for ($i = 0; $i < 5; $i++) {
                    if ($rating >= $i + 1) {
                        echo '<span class="fa fa-star checked"></span>';
                    } else if ($rating > $i) {
                        echo '<span class="fa fa-star-half-o checked"></span>';
                    } else {
                        echo '<span class="fa fa-star-o"></span>';
                    }
                }
                echo '</div>
                <p>reviews: <span>' . $fetch_reviews['text'] . '</span></p>
                <a href="admin_reviews.php?delete=' . $fetch_reviews['id'] . '" class="delete" onclick="return confirm(\'delete this\')">Delete</a>
                </div>';
                // Output the tutor's rating, review text, and a delete link for each review
            }
        } else {
            echo "No reviews found";
        }
    }    
        ?>
    </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>