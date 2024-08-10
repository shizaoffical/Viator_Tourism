

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';


// Get the referring URL
$redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'your_form_page.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['email']) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Find user by email
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $userId = $user['id'];

        // Generate a reset token
        $resetToken = bin2hex(random_bytes(32));

        // Update user record with the reset token
        $query = "UPDATE users SET reset_token = '$resetToken' WHERE id = $userId";
        mysqli_query($conn, $query);

        // Send the reset email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io'; // Mailtrap SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = '9ddf4eacfe254b'; // Mailtrap SMTP username
            $mail->Password = '785fbb15f01c9c'; // Mailtrap SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('no-reply@travel.com', 'Travel');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = 'Please use the following link to reset your password: <a href="http://localhost/shiza/Viator_Tourism/index.php?token=' . $resetToken . '">Reset Password</a>';

            $mail->send();
            echo '<script>
                Toastify({
                    text: "Reset link sent to your email.",
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    duration: 3000
                }).showToast();
               
            </script>';
        } catch (Exception $e) {
            echo '<script>
                Toastify({
                    text: "Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '",
                    backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                    duration: 3000
                }).showToast();
               
            </script>';
        }
    } else {
        echo '<script>
            Toastify({
                text: "No user found with that email address.",
                backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                duration: 3000
            }).showToast();
           
        </script>';
    }
}


?>
