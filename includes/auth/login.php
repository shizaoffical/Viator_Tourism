
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js"></script>
<?php
include('../../includes/db.php');
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

    // Store user data in session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_role'] = $user['roll'];

    if ($user['roll'] == 'admin') {
        // Redirect to admin dashboard
        echo '<script>
            Toastify({
                text: "Login successful! Redirecting to admin dashboard...",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                duration: 3000
            }).showToast();
            setTimeout(function() {
                window.location.href = "http://localhost/shiza/Viator_Tourism/pages/admin/dashboard.php";
            }, 3000);
        </script>';
    } 
    elseif ($user['roll'] == 'user') {
        // Redirect to user dashboard
        echo '<script>
            Toastify({
                text: "Login successful! Redirecting to user dashboard...",
                backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                duration: 3000
            }).showToast();
            setTimeout(function() {
                window.location.href = "http://localhost/shiza/Viator_Tourism/pages/user/booking/index.php";
            }, 3000);
        </script>';
    } 
      
    
} else {
    // Output error message and redirect after a delay
    echo '<script>
        Toastify({
            text: "Invalid email or password. Please try again.",
            backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
            duration: 3000
        }).showToast();
        setTimeout(function() {
            window.location.href = "../../index.php";
        }, 3000);
    </script>';
}

// Close the connection
mysqli_close($conn);
?>
