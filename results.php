<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Perceptions of the Harvard Implicit Bias test | LIS 500 Assignment 4</title>
    <link rel="stylesheet" type="text/css" href="resultStyles.css">

    <!-- Import the Google Fonts: -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@500&family=IBM+Plex+Serif&display=swap"
        rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Function to draw a bar chart
    // Function to draw a bar chart
function drawBarChart(labels, userData, avgData, containerId) {
    var ctx = document.getElementById(containerId).getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Your Results',
                data: userData,
                backgroundColor: '#DDE0E0', // Set your desired color here
                borderColor: '#FFF',
                borderWidth: 1
            }, {
                label: 'Average Results',
                data: avgData,
                backgroundColor: '#E76C86', // Adjust color as needed
                borderColor: '#FFF',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    display: false,
                    beginAtZero: true,
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
</script>
</head>

<body>
    <h1>🎉 Results 🎉</h1>

    <p>Below you will the results for all questions displayed in their Likert numerals and an average of all current
        test takers.
        <br>Since no personal IP address data is taken in this form, if you take again the average will shift. <br>This is nothing like a statistically accurate survey, but it is a good model for your final projects.
    </p>

    <h2> As a reminder, here's your Likert scale:</h2>
    <ul>
        <li> 5 - I Strongly Agree </li>
        <li> 4 - I Agree </li>
        <li> 3 - Neutral </li>
        <li> 2 - I Disagree </li>
        <li> 1 - I Strongly Disagree </li>
    </ul>
</body>
<?php

// Created by: Reginold Royston and Mariah Knowles
// Based on:
// Last Modified on: Oct 28, 2021
// Last Modified by: Reginold Royston
// This is a results page for database queries using PHP forms //


// To display results of all questions, Grab the user id from the POST data sent to us from previous page i.e. last form page edited e.g. q-royston.php  

$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

// Store the answer to the previous question, if applicable
include "store-answer.php";

// Time to retreive from the database all data we've collected for this visitor throughout the survey

// Database settings
// (copy these as necessary for your own projects)
$mysql_server="fdb1032.awardspace.net";
$mysql_db="4404232_kimsdatabase";
$mysql_port="3306";
$mysql_user="4404232_kimsdatabase";  
$mysql_password="Dnjs5223!!";

// Connect to the database
$conn = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);

// Whoops. This shouldn't happen, but if we can't connect to the database "blow up" and stop here
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare our first query: get all the results for this particular user
$query = $conn->prepare("SELECT question, answer FROM Final_Survey WHERE user_id = ? ORDER BY question");
$query->bind_param("i", $user_id);

// Run our query to get the results from the database
$query->execute();
$results = $query->get_result();
        
$chartUserLabels = [];
$chartUserData = [];
while ($result = $results->fetch_assoc()) {
	$chartUserLabels[]= $result["question"];
    $chartUserData[]= $result["answer"];
}
echo '</div>';
        
// Close the query
$query->close();

// Prepare our second query: get all the average results for all questions
$query = $conn->prepare("SELECT question, avg(answer) as answer FROM Final_Survey GROUP BY question ORDER BY question");

// Run our query to get the results from the database
$query->execute();
$results = $query->get_result();

// Fetch data for the bar chart
$chartLabels = [];
$chartData = [];

while ($result = $results->fetch_assoc()) {
    $chartLabels[] = $result["question"];
    $chartData[] = $result["answer"];
}
echo '</div>';

echo '</div>';


// Close the query
$query->close();

// Close the connection
$conn->close();

?>

<body>
        <h2>Results Chart</h2>
    <canvas id="comparisonChart" width="100" height="50"></canvas>

    <script>
        // Call the drawBarChart function to display the bar chart
		drawBarChart(
        <?php echo json_encode($chartLabels); ?>,
        <?php echo json_encode($chartUserData); ?>,
        <?php echo json_encode($chartData); ?>,
        'comparisonChart'
    	);    
    </script>
        
        
    <h2>Feedback</h2>
    <form action="submit_feedback.php" method="post">
        <label for="feedback"></label>
        <textarea id="feedback" name="feedback" rows="4" cols="50" required></textarea>
        <br>
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="submit" value="Submit Feedback">
    </form>

    </p>
    <form action="index.php">
        <input type="submit"  value="Back to Home!">
    </form>
</body>
