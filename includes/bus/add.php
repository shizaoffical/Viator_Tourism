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

   // Correct directory path
$target_dir = "../../assets/bus_images/";
$bus_image = $_FILES['bus_image']['name'];
$target_file = $target_dir . basename($bus_image);

// Ensure the directory exists before moving the file
if (!is_dir($target_dir)) {
    echo "Error: The directory $target_dir does not exist.";
    exit();
}

// Move the uploaded file to the target directory
if (!move_uploaded_file($_FILES['bus_image']['tmp_name'], $target_file)) {
    echo "Failed to move file to $target_file.<br>";
    echo "Error code: " . $_FILES['bus_image']['error'] . "<br>";
    echo "Check if directory exists and has correct permissions.<br>";
    exit();
}


    // Check file size (5MB max)
    if ($_FILES['bus_image']['size'] > 5000000) {
        header("Location: http://localhost/shiza/Viator_Tourism/pages/admin/bus/index.php?error=" . urlencode("Sorry, your file is too large."));
        exit();
    }

    // Allow certain file formats
    // if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
    //     header("Location: http://localhost/shiza/Viator_Tourism/pages/admin/bus/index.php?error=" . urlencode("Sorry, only JPG, JPEG, PNG & GIF files are allowed."));
    //     exit();
    // }

   

    // Insert bus details into the database, including the image path
    $sql = "INSERT INTO buses (bus_number, company_id, driver_name, total_seats, remaining_seats, price, discount, departure_time, arrival_time, departure_from, arrival_to, status, image_path) 
            VALUES ('$bus_number', '$company_id', '$driver_name', '$total_seats', '$remaining_seats', '$price', '$discount', '$departure_time', '$arrival_time', '$departure_from', '$arrival_to', '$status', '$target_file')";
echo $sql;
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
