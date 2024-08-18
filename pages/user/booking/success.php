<?php
require_once('../../../vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51MVCGyFaWK1ZSTpIwdpvyYmGIx08scQtfnHIQeW8l3GypXv1T97vK1oWphfs9vOhyRnRP4kTrDNxYKNljJideU1500MEnA2w9S'); // Replace with your Stripe secret key

// Retrieve session_id from the query parameters
$session_id = isset($_GET['session_id']) ? $_GET['session_id'] : null;

if ($session_id === null) {
    echo 'Session ID missing';
    exit;
}

try {
    // Retrieve the Checkout Session from Stripe
    $session = \Stripe\Checkout\Session::retrieve($session_id);

    // Output JavaScript to display an alert and then redirect
    echo '<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            alert("Payment successful! Your booking is complete.");
            window.location.href = "http://localhost/shiza/Viator_Tourism/pages/user/booking/index.php"; // Redirect to the desired page
        });
    </script>
</head>
<body>
    <p>If you are not redirected automatically, <a href="http://localhost/shiza/Viator_Tourism/pages/user/booking/index.php">click here</a>.</p>
</body>
</html>';
} catch (Exception $e) {
    // Output JavaScript to display an error alert
    echo '<!DOCTYPE html>
<html>
<head>
    <title>Payment Error</title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            alert("Error retrieving session: ' . addslashes($e->getMessage()) . '");
            window.location.href = "http://localhost/shiza/Viator_Tourism/pages/user/booking/error-page.php"; // Redirect to an error page
        });
    </script>
</head>
<body>
    <p>If you are not redirected automatically, <a href="http://localhost/shiza/Viator_Tourism/pages/user/booking/error-page.php">click here</a>.</p>
</body>
</html>';
}
?>
