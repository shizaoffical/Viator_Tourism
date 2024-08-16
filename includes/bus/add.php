<?php

include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bus_number = $_POST['bus_number'];
    $company_id = $_POST['company_id'];
    $driver_name = $_POST['driver-name'];
    $total_seats = $_POST['total-seats'];
    $remaining_seats = $_POST['remaining-seats'];
    $price = $_POST['Price'];
    $discount = $_POST['discount'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $departure_from = $_POST['departure_from'];
    $arrival_to = $_POST['arrival_to'];
    $status = $_POST['status'];

    // Debugging line to check if company_id is set
    echo "Company ID: " . htmlspecialchars($company_id) . "<br>";

    $sql = "INSERT INTO buses (bus_number, company_id, driver_name, total_seats, remaining_seats, price, discount, departure_time, arrival_time, departure_from, arrival_to, status) 
            VALUES ('$bus_number', '$company_id', '$driver_name', '$total_seats', '$remaining_seats', '$price', '$discount', '$departure_time', '$arrival_time', '$departure_from', '$arrival_to', '$status')";

if (mysqli_query($conn, $sql)) {
    // Redirect with success message
    header("Location: http://localhost/shiza/Viator_Tourism/pages/admin/bus/index.php?success=" . urlencode("Bus added successfully"));
    exit();
} else {
    // Redirect with error message
    header("Location: http://localhost/shiza/Viator_Tourism/pages/admin/bus/index.php?error=" . urlencode("Error adding bus: " . mysqli_error($conn)));
    exit();
}
}
