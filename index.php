<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
        
    <title>Survey</title>
    <!-- Reference: https://stackoverflow.com/questions/6320113/how-to-prevent-form-resubmission-when-page-is-refreshed-f5-ctrlr -->
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
    <div class="card">
        <!-- Content inside the card -->
        <div class="container">
            <h1>Welcome to this survey on Race and Gender in the Technology Industry!</h1>
            <p>We invite you to participate in this survey to gather valuable insights into your perspectives on race and gender representation in the tech industry.</p>
            <h3>The survey covers three main areas:</h3>
            <ul>
                <li>
                    <h4>Understanding Race:</h4>
                    <p>This section delves into your understanding of racial diversity and equality in society, particularly within the context of the tech industry.</p>
                </li>
                <li>
                    <h4>Understanding Gender:</h4>
                    <p>This section focuses on your perspectives on gender equality and representation in society, with a particular emphasis on the tech industry.</p>
                </li>
                <li>
                    <h4>Race and Gender in Tech Companies:</h4>
                    <p>This section explores your views on the role of tech companies in addressing racial and gender disparities.</p>
                </li>
            </ul>
            <form action="Q1.php" method="post">
                <?php echo '<input type="hidden" name="user_id" value="'.$user_id.'" />'; ?>
                <input type="submit" value="Start Survey">
            </form>
        </div>
    </div>
</body>

</html>