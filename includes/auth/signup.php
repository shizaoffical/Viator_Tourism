<?php
 include ('../../includes/db.php');

// Retrieve form data
$newUsername = isset($_POST['newUsername']) ? trim($_POST['newUsername']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$newPassword = isset($_POST['newPassword']) ? trim($_POST['newPassword']) : '';

// Validate form data
if (empty($newUsername) || empty($email) || empty($newPassword)) {
    header("Location: http://localhost/traveller/index.php?status=error&message=" . urlencode("Please fill in all required fields."));
    exit();
}

// Hash the password using MD5
$hashedPassword = md5($newPassword);

// Prepare an SQL statement
$sql = "INSERT INTO users (name, email, password) VALUES ('$newUsername', '$email', '$hashedPassword')";

// Execute the statement
if (mysqli_query($conn, $sql)) {
    // Redirect to login page with a success message
    header("Location: http://localhost/traveller/index.php?status=success&message=" . urlencode("Sign-up successful! You can now log in."));
    exit();
} else {
    // Redirect to login page with an error message
    header("Location: http://localhost/traveller/index.php?status=error&message=" . urlencode(mysqli_error($conn)));
    exit();
}

// Close the connection
mysqli_close($conn);
?>