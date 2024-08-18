<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $bus_id = intval($_GET['id']);
    
    // Retrieve the image path
    $stmt = $conn->prepare("SELECT image_path FROM buses WHERE id = ?");
    $stmt->bind_param("i", $bus_id);
    $stmt->execute();
    $stmt->bind_result($image_path);
    $stmt->fetch();
    $stmt->close();
    
    // Check if the image path exists and delete the file
    if ($image_path && file_exists($image_path)) {
        unlink($image_path); // Delete the file from the server
    }

    // Prepare the SQL statement to delete the bus record
    $stmt = $conn->prepare("DELETE FROM buses WHERE id = ?");
    $stmt->bind_param("i", $bus_id);
    
    if ($stmt->execute()) {
        echo "Bus record and associated image deleted successfully.";
        header("Location: ../../pages/admin/dashboard.php"); // Redirect after deletion
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
