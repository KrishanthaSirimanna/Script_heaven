<?php
// view_script.php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'writer') {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "script_heaven");

// Fetch and display the uploaded scripts of the writer
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM scripts WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Your Uploaded Scripts:</h2>";
    echo '<form action="delete_script.php" method="post">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>Title: " . $row['title'] . "</p>";
        echo "<p>Description: " . $row['description'] . "</p>";
    }
    echo '</form>';
} else {
    echo "<p>No uploaded scripts found.</p>";
}

// Close the connection
mysqli_close($conn);
?>
