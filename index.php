<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- NEED TO ADD STYLES HERE -->

        
    <title>Survey</title>
    <!-- Refference: https://stackoverflow.com/questions/6320113/how-to-prevent-form-resubmission-when-page-is-refreshed-f5-ctrlr -->
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</head>
<?php
        
// Database settings
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

// Prepare our second query: get all the average results for all questions
$query = $conn->prepare("SELECT * FROM Final_Survey");

// Run our query to get the results from the database
$query->execute();
$results = $query->get_result();

// Close the query
$query->close();

//checks to make sure the generated user_id is unique
function checkDuplicates($user_id, $results) {
    while ($result = $results->fetch_assoc()) {
        if($user_id == $result['user_id']){
            $user_id = rand(1, 9999999);
            checkDuplicates($user_id, $results);
        }
    }
    return $user_id;
}

// Generate a random number to use to identify the visitor throughout the survey
$user_id = rand(1, 9999999);

$user_id = checkDuplicates($user_id, $results);

?>

<body>

    <!-- Main content container -->
    <div class="container">
        <!-- Page title -->
        <h1>What did Harvard's IBT get wrong? Here's your chance to innovate.</h1>
        <!-- Start Survey button with a unique ID for styling -->
        <form action="Q1.php" method="post">
            <?php echo '<h1><input type="hidden" name="user_id" value="'.$user_id.'" /></h1>'; ?>
            <input type="submit" value="Start Survey">
        </form>
    </div>

</body>

</html>