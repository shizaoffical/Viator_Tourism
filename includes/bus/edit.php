<?php
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $bus_id = intval($_GET['id']);
    
    // Fetch the current details of the bus
    $sql = "SELECT * FROM buses WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bus_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bus = $result->fetch_assoc();

    if (!$bus) {
        echo "Bus not found.";
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $bus_id = intval($_POST['id']);
    $bus_number = $_POST['bus_number'];
    $driver_name = $_POST['driver_name'];
    $company = $_POST['company'];
    $total_seats = $_POST['total_seats'];
    $remaining_seats = $_POST['remaining_seats'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $departure_from = $_POST['departure_from'];
    $arrival_to = $_POST['arrival_to'];
    $status = $_POST['status'];

    // Update the bus details in the database
    $sql = "UPDATE buses SET bus_number=?, driver_name=?, company=?, total_seats=?, remaining_seats=?, price=?, discount=?, departure_time=?, arrival_time=?, departure_from=?, arrival_to=?, status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiiiisssssi", $bus_number, $driver_name, $company, $total_seats, $remaining_seats, $price, $discount, $departure_time, $arrival_time, $departure_from, $arrival_to, $status, $bus_id);
    
    if ($stmt->execute()) {
        echo "Bus record updated successfully.";
        header("Location: ../../pages/admin/dashboard.php"); // Redirect after update
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
      :root {
    --primary-color: #3f36c3;
    --secondary-color: #f7f7f7;
    --dark-color: #181c27;
    --light-color: #ffffff;
    --sidebar-width: 250px;
    --transition-duration: 0.3s;
    --button-hover-color: #2a259a;
  }


  .update-form {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: var(--secondary-color);
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: var(--dark-color);
}

input[type="text"],
input[type="number"],
input[type="date"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid var(--dark-color);
    border-radius: 5px;
    box-sizing: border-box;
    transition: border-color var(--transition-duration) ease;
}

input[type="text"]:focus,
input[type="number"]:focus,
input[type="date"]:focus {
    border-color: var(--primary-color);
    outline: none;
}

.btn-submit {
    width: 100%;
    padding: 12px;
    background-color: var(--primary-color);
    border: none;
    border-radius: 5px;
    color: var(--light-color);
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color var(--transition-duration) ease;
}

.btn-submit:hover {
    background-color: var(--button-hover-color);
}

</style>
<body>
<?php
        // Assuming you have already connected to the database
        $query = "SELECT * FROM bus_company";
        $result = mysqli_query($conn, $query);

        if (!$result) {
          echo "Error fetching companies: " . mysqli_error($conn);
          exit;
        }
        ?>
<form action="edit.php" method="POST" class="update-form">
    <input type="hidden" name="id" value="<?php echo $bus['id']; ?>">

    <div class="form-group">
        <label for="bus_number">Bus Number:</label>
        <input type="text" id="bus_number" name="bus_number" value="<?php echo htmlspecialchars($bus['bus_number']); ?>" required>
    </div>

    <div class="form-group">
        <label for="driver_name">Driver Name:</label>
        <input type="text" id="driver_name" name="driver_name" value="<?php echo htmlspecialchars($bus['driver_name']); ?>" required>
    </div>

    <div class="form-group">
        <label for="company">Company:</label>
        <select id="company" name="company_id" required>
        <option value="">Select Company</option>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <option value="<?php echo htmlspecialchars($row['id']); ?>"
                <?php echo (isset($bus['company_id']) && $row['id'] == htmlspecialchars($bus['company_id'])) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($row['name']); ?>
            </option>
        <?php } ?>
    </select>
    </div>

    <div class="form-group">
        <label for="total_seats">Total Seats:</label>
        <input type="number" id="total_seats" name="total_seats" value="<?php echo htmlspecialchars($bus['total_seats']); ?>" required>
    </div>

    <div class="form-group">
        <label for="remaining_seats">Remaining Seats:</label>
        <input type="number" id="remaining_seats" name="remaining_seats" value="<?php echo htmlspecialchars($bus['remaining_seats']); ?>" required>
    </div>

    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($bus['price']); ?>" required>
    </div>

    <div class="form-group">
        <label for="discount">Discount:</label>
        <input type="text" id="discount" name="discount" value="<?php echo htmlspecialchars($bus['discount']); ?>">
    </div>

    <div class="form-group">
        <label for="departure_time">Departure Time:</label>
        <input type="text" id="departure_time" name="departure_time" value="<?php echo htmlspecialchars($bus['departure_time']); ?>" required>
    </div>

    <div class="form-group">
        <label for="arrival_time">Arrival Time:</label>
        <input type="text" id="arrival_time" name="arrival_time" value="<?php echo htmlspecialchars($bus['arrival_time']); ?>" required>
    </div>

    <div class="form-group">
        <label for="departure_from">Departure From:</label>
        <input type="text" id="departure_from" name="departure_from" value="<?php echo htmlspecialchars($bus['departure_from']); ?>" required>
    </div>

    <div class="form-group">
        <label for="arrival_to">Arrival To:</label>
        <input type="text" id="arrival_to" name="arrival_to" value="<?php echo htmlspecialchars($bus['arrival_to']); ?>" required>
    </div>
  
    <div class="form-group">
    <label>Status:</label>
    <div class="radio-group">
        <label>
            <input
                type="radio"
                name="status"
                value="active"
                <?php echo (isset($bus['status']) && htmlspecialchars($bus['status']) == 'active') ? 'checked' : ''; ?>
                required />
            Active
        </label>
        <label>
            <input
                type="radio"
                name="status"
                value="inactive"
                <?php echo (isset($bus['status']) && htmlspecialchars($bus['status']) == 'inactive') ? 'checked' : ''; ?>
                required />
            Inactive
        </label>
    </div>
</div>

    <button type="submit" class="btn-submit">Update Bus</button>
</form>
</body>
</html>
<!-- Display the edit form -->


