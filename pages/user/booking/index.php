<?php include('../../../includes/db.php');

$userId = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../../../assets/admin/style.css" />

</head>

<body>

    <div class="dashboard">
        <?php include('../layout/sidebar.php'); ?>
        <div class="main-content">
            <div class="content-body">
                <?php

                // Enhanced query to include user and bus details
                $query = "
    SELECT
        b.id,
        b.user_id,
        b.bus_id,
        b.booking_date,
        b.seats_booked,
        b.total_amount,
        b.discount_amount,
        b.paid_amount,
        b.status,
        u.name AS user_name,
        bus.bus_number,
        bus.departure_from,
        bus.arrival_to
    FROM
        bookings b
    JOIN
        users u ON b.user_id = u.id
    JOIN
        buses bus ON b.bus_id = bus.id
    WHERE
        b.user_id = ?
";

                if ($stmt = mysqli_prepare($conn, $query)) {
                    // Bind the user_id parameter to the query
                    mysqli_stmt_bind_param($stmt, 'i', $userId);

                    // Execute the query
                    mysqli_stmt_execute($stmt);

                    // Get the result set
                    $result = mysqli_stmt_get_result($stmt);

                    if ($result && mysqli_num_rows($result) > 0) {
                        // Output the results in a table
                ?>
                        <div id="buses-table">
                            <h2>Booking Details</h2>

                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Bus ID</th>
                                        <th>Travel</th>
                                        <th>Booking Date</th>
                                        <th>Seats Booked</th>
                                        <th>Total Amount</th>
                                        <th>Discount Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                                            <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['bus_number']); ?></td>
                                            <td><?php echo htmlspecialchars($row['departure_from']);  ?>=><?php echo htmlspecialchars($row['arrival_to']); ?></td> <!-- Departure location -->
                                            <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                                            <td><?php echo htmlspecialchars($row['seats_booked']); ?></td>
                                            <td><?php echo htmlspecialchars($row['total_amount']); ?></td>
                                            <td><?php echo htmlspecialchars($row['discount_amount']); ?></td>
                                            <td><?php echo htmlspecialchars($row['paid_amount']); ?></td>
                                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>

                            </table>
                        </div>
                <?php
                    } else {
                        echo "<p>No bookings found for your account.</p>";
                    }

                    // Close the prepared statement
                    mysqli_stmt_close($stmt);
                } else {
                    echo "<p>Error preparing the query: " . mysqli_error($conn) . "</p>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>


    </div>

    <script src="../../assets/admin/script.js"></script>
</body>

</html>