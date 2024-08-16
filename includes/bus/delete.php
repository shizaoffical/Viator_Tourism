<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $bus_id = intval($_GET['id']);
    
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM buses WHERE id = ?");
    $stmt->bind_param("i", $bus_id);
    
    if ($stmt->execute()) {
        echo "Bus record deleted successfully.";
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
