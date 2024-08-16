<?php
// Include the database connection file
include '../../includes/db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $package_name = mysqli_real_escape_string($conn, $_POST['package_name']);
    $package_description = mysqli_real_escape_string($conn, $_POST['package_description']);
    $package_price = mysqli_real_escape_string($conn, $_POST['package_price']);
    $image_url = ''; // Default to empty if no image is uploaded

    // Handle file upload if image is provided
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $target_dir = "uploads/"; // Directory to save uploaded files
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an actual image
        $check = getimagesize($_FILES["image_url"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (limit to 5MB)
        if ($_FILES["image_url"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
                $image_url = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $package_type = mysqli_real_escape_string($conn, $_POST['package_type']);
    $package_duration = mysqli_real_escape_string($conn, $_POST['package_duration']);
    $total_person = mysqli_real_escape_string($conn, $_POST['total_person']);
    $days = mysqli_real_escape_string($conn, $_POST['days']);
    $nights = mysqli_real_escape_string($conn, $_POST['nights']);
    $packages_departure_time = mysqli_real_escape_string($conn, $_POST['departure_time']);
    $packages_arrival_time = mysqli_real_escape_string($conn, $_POST['arrival_time']);
    $packages_start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $packages_end_time = mysqli_real_escape_string($conn, $_POST['end_time']);

    // Insert the data into the database
    $sql = "INSERT INTO packages (package_name, package_description, package_price, image_url, destination, package_type, package_duration, total_person, days, nights, departure_time, arrival_time, start_time, end_time) 
            VALUES ('$package_name', '$package_description', '$package_price', '$image_url', '$destination', '$package_type', '$package_duration', '$total_person', '$days', '$nights', '$packages_departure_time', '$packages_arrival_time', '$packages_start_time', '$packages_end_time')";

    if (mysqli_query($conn, $sql)) {
        echo "New package added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
