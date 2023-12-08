<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user_id and feedback from the form
    $user_id = $_POST['user_id'];
    $feedback = $_POST['feedback'];

    // Database settings
    $mysql_server = "fdb1032.awardspace.net";
    $mysql_db = "4404232_kimsdatabase";
    $mysql_port = "3306";
    $mysql_user = "4404232_kimsdatabase";
    $mysql_password = "Dnjs5223!!";

    // Connect to the database
    $conn = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);

    // Whoops. This shouldn't happen, but if we can't connect to the database "blow up" and stop here
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query to insert feedback into the Feedback table
    $query = $conn->prepare("INSERT INTO Feedback (user_id, feedback) VALUES (?, ?)");
    $query->bind_param("is", $user_id, $feedback);
    $query->execute();

    // Close the query
    $query->close();

    // Close the connection
    $conn->close();
}

// Redirect back to the index.php page
header("Location: index.php");
exit();

?>
