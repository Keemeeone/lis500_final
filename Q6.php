<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Question 6</title>
    <link rel="stylesheet" href="styles.css"> 

    <!-- Import the Google Fonts: -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@500&family=IBM+Plex+Serif&display=swap"
        rel="stylesheet">

</head>
<?php

// Created by: Reginold Royston and Mariah Knowles
// Based on: index.php
// Last Modified on: Nov 30, 2023
// Last Modified by: Fara Faisal

// Grab the user id from the data sent to us from the previous page
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

// Store the answer to the previous question, if applicable
include "store-answer.php";

// Specify the question text to be displayed on this page
$question_text = "Q6. Do you think that there are enough resources available to support people of color and women in their pursuit of education and career goals?";

// Use the question text and the user id to create a form for this question that will take us to the next question OR the results page, whichever should come next:

?>

<body>
    <!-- Main content container -->
    <div class="card">
        <!-- Content inside the card -->
        <div class="container">
            <form method="post" action="Q7.php">
                <?php echo '<h1>'.$question_text.'</h1>'; ?>
                <?php echo '<p><input type="hidden" name="user_id" value="'.$user_id.'" /></p>'; ?>
                <?php echo '<p><input type="hidden" name="question" value="'.$question_text.'" /></p>'; ?>
                <p><input type="radio" name="answer" value="5" /> I Strongly Agree</p>
                <p><input type="radio" name="answer" value="4" /> I Agree</p>
                <p><input type="radio" name="answer" value="3" /> Neutral</p>
                <p><input type="radio" name="answer" value="2" /> I Disagree</p>
                <p><input type="radio" name="answer" value="1" /> I Strongly Disagree</p>
                <p><input type="submit" value="Continue" /></p>
            </form>
        </div>
    </div>
    <footer>
        <p>
            When you participate in this survey, information about your answers is submitted to the website and stored
            in a database. Your responses to individual questions are associated with one another via a random id that
            was generated when you visited the first survey page. This id is not generated based on any of your personal
            information and to our knowledge there is no way to associate this random id with you or any other of your
            personal information.
        </p>
        <p>
            Once you leave the survey, no further information is collected by this website. While we appreciate everyone
            completing all of the survey questions, you are welcome to leave at any time. Because your user id is randomly
            generated every time that you visit the survey starting page, there is no way to return to your in-progress
            responses at a later time.
        </p>
        <br />
        &copy;
        <?php echo date('Y');?> <br />
        All Rights Reserved
    </footer>
</body>

</html>