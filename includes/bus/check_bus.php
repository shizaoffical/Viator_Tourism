<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'get') {
    // Retrieve and sanitize input values
    $from = mysqli_real_escape_string($conn, $_POST['From']);
    $to = mysqli_real_escape_string($conn, $_POST['to']);
    $company_id = mysqli_real_escape_string($conn, $_POST['company_id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $seats = mysqli_real_escape_string($conn, $_POST['remaining-seats']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);

    // Output all the details
    echo "From: " . htmlspecialchars($from) . "<br>";
    echo "To: " . htmlspecialchars($to) . "<br>";
    echo "Company ID: " . htmlspecialchars($company_id) . "<br>";
    echo "Date: " . htmlspecialchars($date) . "<br>";
    echo "Seats: " . htmlspecialchars($seats) . "<br>";
    echo "Price: " . htmlspecialchars($price) . "<br>";

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

        // Fetch and display results
        while ($row = mysqli_fetch_assoc($result)) {
            // Output the results (you can customize this as needed)
            echo "Bus ID: " . htmlspecialchars($row['id']) . "<br>";
            echo "Departure From: " . htmlspecialchars($row['departure_from']) . "<br>";
            echo "Arrival To: " . htmlspecialchars($row['arrival_to']) . "<br>";
            // Add more fields as necessary
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing query: " . mysqli_error($conn);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
