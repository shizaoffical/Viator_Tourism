<?php
 include ('../../includes/db.php');
session_start(); // Start the session

// Retrieve form data
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validate form data
if (empty($email) || empty($password)) {
    header("Location: ../../index.php");
    exit();
}

// Hash the password using MD5
$hashedPassword = md5($password);

// Prepare and execute the query
$sql = "SELECT id, name, email, roll FROM users WHERE email = '$email' AND password = '$hashedPassword'";
$result = mysqli_query($conn, $sql);

// Check if a user was found
if (mysqli_num_rows($result) > 0) {
    // Fetch user data
    $user = mysqli_fetch_assoc($result);
    
    // Store user ID and role in session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['roll'];
    
    // Redirect to a dashboard or home page
    header("Location: ../../index.php");
    exit();
} else {
    // Redirect back to login with an error message
    header("Location: ../../index.php");
    exit();
}

// Close the connection
mysqli_close($conn);
?>
