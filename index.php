<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <!-- Navigation bar -->
	<div class="navbar">
  		<a href="index.php">Home</a>
  		<a href="analysis.php">Analysis</a>
  		<div class="dropdown">
    		<button class="dropbtn">Individual Essay 
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="heewon.php">Heewon Kim</a>
              <a href="fara.php">Nurfara Amirah Mohd Faisal</a>
              <a href="tiya.php">Satiya Samlal</a>
              <a href="hongfei.php">Hongfei Zhang</a>
            </div>
         </div> 
     </div>
    <!-- Main content container -->
    <div class="container">
        <!-- Welcome -->
        <h1>Welcome to this survey on Race and Gender in the Technology Industry!</h1>
        <!-- Explanation about Survey -->
        <h2>We invite you to participate in this survey to gather valuable insights 
            into your perspectives on race and gender representation in the tech industry. 
            Your responses will help us understand how individuals perceive and 
            experience these issues in the tech sector.</h2>
        <!-- What survey is covered -->
        <h2>The survey covers three main areas:</h2>
        <!-- List of survey areas -->
        <ul>
            <li>
                <h3>Understanding Race:</h3>
                    <h4>
                        This section delves into your understanding of racial diversity and equality in society,
                        particularly within the context of the tech industry.
                        Your responses will aid in assessing your comprehension of racial
                        experiences and your perception of fairness and equity in the tech realm.
                    </h4>
            </li>
            <li>
                <h3>Understanding Gender:</h3>
                    <h4> 
                        This section focuses on your perspectives on gender equality and representation in society,
                        with a particular emphasis on the tech industry. Your responses will help us
                        gauge your assessment of gender balance in leadership roles, pay equity,
                        and support systems for women and people of color.
                    </h4>
            </li>
            <li>
                <h3>Race and Gender in Tech Companies:</h3>
                    <h4>
                        This section explores your views on the role of tech companies in addressing
                        racial and gender disparities. Your responses will help us understand your
                        expectations regarding transparency in hiring and promotion practices,
                        corporate responsibility for diversity initiatives, and investments
                        in mitigating biases in technology.
                    </h4>
            </li>
        </ul>
        <!-- Start Survey button with a unique ID for styling -->
        <form action="Q1.php" method="post">
            <?php echo '<h1><input type="hidden" name="user_id" value="'.$user_id.'" /></h1>'; ?>
            <input type="submit" value="Start Survey">
        </form>
    </div>

</body>

</html>