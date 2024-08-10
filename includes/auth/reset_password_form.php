<?php


// Check if token is provided
if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Validate the token
    $query = "SELECT id FROM users WHERE reset_token = '$token'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            // Hash the new password
            $hashedPassword = md5($password);

            // Update the user's password and clear the reset token
            $query = "UPDATE users SET password = '$hashedPassword', reset_token = NULL WHERE reset_token = '$token'";
            if (mysqli_query($conn, $query)) {
                echo '<script>
                    Toastify({
                        text: "Password reset successfully. You can now log in.",
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        duration: 3000
                    }).showToast();
                    setTimeout(function() { window.location.href = "index.php"; }, 1000);
                </script>';
            } else {
                echo '<script>
                    Toastify({
                        text: "An error occurred while resetting the password.",
                        backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                        duration: 3000
                    }).showToast();
                </script>';
            }
        }
    } else {
        echo '<script>
            Toastify({
                text: "Invalid token.",
                backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                duration: 3000
            }).showToast();
        </script>';
    }
}
?>


