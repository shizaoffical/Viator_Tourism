<?php
include '../../../includes/db.php';

/*
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_booking'])) {
    $bus_id = htmlspecialchars($_POST['bus_id']);
    $seats_requested = htmlspecialchars($_POST['seats']);
    $user_id =  $_SESSION['user_id']; // Replace this with the actual logged-in user ID
    $booking_date = date('Y-m-d H:i:s');

    // Check the availability of seats
    $query = "SELECT remaining_seats, price FROM buses WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 'i', $bus_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $bus = mysqli_fetch_assoc($result);

        if ($bus && $bus['remaining_seats'] >= $seats_requested) {
            $total_amount = $bus['price'] * $seats_requested;
            $discount_amount = 0; // Add discount calculation logic if needed
            $paid_amount = $total_amount - $discount_amount;
            $status = 'Booked'; // Or any other status you prefer

            // Insert the booking into the booking table
            $insertQuery = "INSERT INTO bookings (user_id, bus_id, booking_date, seats_booked, total_amount, discount_amount, paid_amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            if ($insertStmt = mysqli_prepare($conn, $insertQuery)) {
                mysqli_stmt_bind_param($insertStmt, 'iisiidss', $user_id, $bus_id, $booking_date, $seats_requested, $total_amount, $discount_amount, $paid_amount, $status);
                mysqli_stmt_execute($insertStmt);

                // Update remaining seats in the buses table
                $updateSeatsQuery = "UPDATE buses SET remaining_seats = remaining_seats - ? WHERE id = ?";
                if ($updateStmt = mysqli_prepare($conn, $updateSeatsQuery)) {
                    mysqli_stmt_bind_param($updateStmt, 'ii', $seats_requested, $bus_id);
                    mysqli_stmt_execute($updateStmt);
                }

                echo "<script>
                        alert('Booking successful! You have booked $seats_requested seats.');
                        window.location.href = 'index.php';
                      </script>";
            } else {
                echo "<script>alert('Error booking the bus: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Not enough seats available.');</script>";
        }
    } else {
        echo "<script>alert('Error retrieving bus details: " . mysqli_error($conn) . "');</script>";
    }
}
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input values
    $from = htmlspecialchars($_POST['From']);
    $to = htmlspecialchars($_POST['to']);
    $company_id = htmlspecialchars($_POST['company_id']);
    $date = htmlspecialchars($_POST['date']);
    $seats = htmlspecialchars($_POST['seats']);
    // Query to fetch the company name
    $companyQuery = "SELECT name FROM bus_company WHERE id = ?";
    $companyName = '';

    if ($stmt = mysqli_prepare($conn, $companyQuery)) {
        // Bind the company_id parameter
        mysqli_stmt_bind_param($stmt, 'i', $company_id);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Bind the result to the companyName variable
        mysqli_stmt_bind_result($stmt, $companyName);

        // Fetch the result
        mysqli_stmt_fetch($stmt);

        // Close the statement
        mysqli_stmt_close($stmt);
    }


    // Example query to check bus availability
    $query = "SELECT * FROM buses WHERE departure_from = ? AND arrival_to = ? AND company_id = ? AND DATE(departure_time) = DATE(?)";

    // Prepare statement
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, 'ssis', $from, $to, $company_id, $date);
        // Execute statement
        mysqli_stmt_execute($stmt);
        // Get result
        $result = mysqli_stmt_get_result($stmt);


?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Dashboard</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
            <link rel="stylesheet" href="../../../assets/admin/style.css" />

        </head>

        <body>

            <div class="dashboard">
                <?php include('../layout/sidebar.php'); ?>
                <div class="main-content">
                    <div class="content-body">
                        <div id="buses-table">
                            <h2>Your Details</h2>
                            <table border='1' cellpadding='10' cellspacing='0' style='width: 100%; border-collapse: collapse;'>
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>From</td>
                                        <td><?php echo htmlspecialchars($from); ?></td>
                                    </tr>
                                    <tr>
                                        <td>To</td>
                                        <td><?php echo htmlspecialchars($to); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Company </td>
                                        <td><?php echo htmlspecialchars($companyName); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>
                                        <td><?php echo htmlspecialchars($date); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Seats</td>
                                        <td><?php echo htmlspecialchars($seats); ?></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="content-body">
                        <div id="buses-table">
                            <h2>Availble Buses</h2>
                            <a href='create.php' class='btn btn-edit'>Add Booking</a>
                            <table border='1' cellpadding='10' cellspacing='0' style='width: 100%; border-collapse: collapse;'>
                                <thead>
                                    <tr>
                                        <th>Bus Number</th>
                                        <th>Departure From</th>
                                        <th>Arrival To</th>
                                        <th>Departure Time</th>
                                        <th>Arrival Time</th>
                                        <th>Seats Available</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($result) > 0): ?>
                                        <?php
                                        $foundBuses = false; // Flag to check if any buses meet the condition
                                        while ($row = mysqli_fetch_assoc($result)):
                                            // Compare remaining seats with the input seats
                                            if ($row['remaining_seats'] >= $seats):
                                                $foundBuses = true;
                                        ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($row['bus_number']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['departure_from']); ?></td>
                                                    <td><?php echo htmlspecialchars($row['arrival_to']); ?></td>
                                                    <td>
                                                        <?php
                                                        $departureTime = new DateTime($row['departure_time']);
                                                        echo $departureTime->format('d-m-Y h:i A');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $arrivalTime = new DateTime($row['arrival_time']);
                                                        echo $arrivalTime->format('d-m-Y h:i A');
                                                        ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($row['remaining_seats']); ?></td>
                                                    <td>Rs.<?php echo htmlspecialchars($row['price']); ?></td>
                                                    <td>
                                                    <form id="payment-form" action="create-checkout-session.php" method="POST">
                                                        <input type="hidden" name="bus_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                                        <input type="hidden" name="seats" value="<?php echo htmlspecialchars($seats); ?>">
                                                       
                                                        <button type="submit">Pay</button>
                                                    </form>



                                                    </td>
                                                </tr>
                                            <?php
                                            endif;
                                        endwhile;

                                        // If no buses met the condition, show a message
                                        if (!$foundBuses):
                                            ?>
                                            <tr>
                                                <td colspan="8">No buses found with the required number of seats available.</td>
                                            </tr>
                                        <?php endif; ?>

                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8">No buses found for the selected criteria.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script src="../../assets/admin/script.js"></script>
        </body>

        </html>

<?php
        // Close statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "Error preparing query: " . mysqli_error($conn);
    }
}
?>
