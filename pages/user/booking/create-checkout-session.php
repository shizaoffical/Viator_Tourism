<?php
require_once('../../../vendor/autoload.php');
include '../../../includes/db.php';

\Stripe\Stripe::setApiKey('sk_test_51MVCGyFaWK1ZSTpIwdpvyYmGIx08scQtfnHIQeW8l3GypXv1T97vK1oWphfs9vOhyRnRP4kTrDNxYKNljJideU1500MEnA2w9S'); // Replace with your Stripe secret key

header('Content-Type: application/json');
session_start();

// Retrieve POST data
$bus_id = isset($_POST['bus_id']) ? (int)$_POST['bus_id'] : null;
$seats_requested = isset($_POST['seats']) ? (int)$_POST['seats'] : null;
$amount = isset($_POST['amount']) ? (float)$_POST['amount'] : null;
$booking_date = isset($_POST['booking_date']) ? $_POST['booking_date'] : null;

// Step 1: Fetch the bus details
$sql = "SELECT * FROM buses WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $bus_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $bus = mysqli_fetch_assoc($result);
        $bus_price = (float)$bus['price']; // Assuming the column name for the price is 'price'
        $total_amount = $bus_price * $seats_requested; // Calculate total amount
        
        // Return the details and calculated amount
        echo json_encode([
            'bus' => $bus,
            'total_amount' => $total_amount
        ]);
    } else {
        echo json_encode(['error' => 'Bus not found']);
        exit;
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['error' => 'Query preparation failed']);
    exit;
}

$user_id = (int)$_SESSION['user_id']; // Replace this with the actual logged-in user ID

// Step 2: Insert the booking into the bookings table
$insertQuery = "INSERT INTO bookings (user_id, bus_id, booking_date, seats_booked, total_amount, discount_amount, paid_amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$insertStmt = mysqli_prepare($conn, $insertQuery);

if ($insertStmt) {
    $discount_amount = 0.0; // Assuming no discount
    $paid_amount = $total_amount; // The amount to be paid
    $status = 'confirmed'; // Set initial status as 'pending'

    mysqli_stmt_bind_param($insertStmt, 'iisiidss', $user_id, $bus_id, $booking_date, $seats_requested, $total_amount, $discount_amount, $paid_amount, $status);
    
    if (mysqli_stmt_execute($insertStmt)) {
        // Step 3: Get the last inserted booking ID
        $booking_id = mysqli_insert_id($conn);

        // Step 4: Update remaining seats in the buses table
        $updateSeatsQuery = "UPDATE buses SET remaining_seats = remaining_seats - ? WHERE id = ?";
        $updateStmt = mysqli_prepare($conn, $updateSeatsQuery);

        if ($updateStmt) {
            mysqli_stmt_bind_param($updateStmt, 'ii', $seats_requested, $bus_id);
            mysqli_stmt_execute($updateStmt);
            mysqli_stmt_close($updateStmt);
        }

        // Step 5: Create a new Checkout Session with Stripe
        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Bus Booking from '. $bus['departure_from']  .' to ' . $bus['arrival_to'] .' bus number'. $bus['bus_number'] ,
                            ],
                            'unit_amount' => $total_amount * 100, // Amount in cents
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => 'http://localhost/shiza/Viator_Tourism/pages/user/booking/success.php?session_id={CHECKOUT_SESSION_ID}&booking_id=' . $booking_id,
                'cancel_url' => 'http://localhost/shiza/Viator_Tourism/pages/user/booking/cancel.php',
            ]);

            // Redirect to Stripe Checkout page
            header("Location: " . $session->url);
            exit;

        } catch (Exception $e) {
            echo json_encode(['error' => 'Payment failed: ' . $e->getMessage()]);
            exit;
        }

    } else {
        echo json_encode(['error' => 'Error booking the bus: ' . mysqli_error($conn)]);
        exit;
    }

    mysqli_stmt_close($insertStmt);
} else {
    echo json_encode(['error' => 'Error preparing the booking statement: ' . mysqli_error($conn)]);
    exit;
}

// Close the connection
mysqli_close($conn);
?>
