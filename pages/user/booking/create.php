<?php include('../../../includes/db.php'); ?>


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
<?php
        // Assuming you have already connected to the database
        $query = "SELECT * FROM bus_company";
        $result = mysqli_query($conn, $query);

        if (!$result) {
          echo "Error fetching companies: " . mysqli_error($conn);
          exit;
        }
        ?>
<body>
  <div class="dashboard">
    <?php include('../layout/sidebar.php'); ?>
    <div class="main-content">
      <div class="content-body">
      <div id="add-bus-form" class="form-container">
          <h2 class="form-title">Add Booking</h2>
          <form action="check_bus.php" method="POST">
    <div class="form-row">
    <div class="form-group">
    <label for="departure_from">From:</label>
    <select id="departure_from" name="From" required>
        <option value="">Select City</option>
        <option value="Karachi">Karachi</option>
        <option value="Lahore">Lahore</option>
        <option value="Islamabad">Islamabad</option>
        <option value="Faisalabad">Faisalabad</option>
        <option value="Rawalpindi">Rawalpindi</option>
        <option value="Multan">Multan</option>
        <option value="Peshawar">Peshawar</option>
        <option value="Quetta">Quetta</option>
        <option value="Sialkot">Sialkot</option>
        <option value="Gujranwala">Gujranwala</option>
        <option value="Hyderabad">Hyderabad</option>
        <option value="Sukkur">Sukkur</option>
        <option value="Larkana">Larkana</option>
        <option value="Bahawalpur">Bahawalpur</option>
        <option value="Rahim Yar Khan">Rahim Yar Khan</option>
        <option value="Sargodha">Sargodha</option>
        <option value="Sheikhupura">Sheikhupura</option>
        <option value="Kasur">Kasur</option>
        <option value="Jhelum">Jhelum</option>
        <option value="Nawabshah">Nawabshah</option>
        <option value="Mardan">Mardan</option>
    </select>
</div>
<div class="form-group">
    <label for="arrival_to">To:</label>
    <select id="arrival_to" name="to" required>
        <option value="">Select City</option>
        <option value="Karachi">Karachi</option>
        <option value="Lahore">Lahore</option>
        <option value="Islamabad">Islamabad</option>
        <option value="Faisalabad">Faisalabad</option>
        <option value="Rawalpindi">Rawalpindi</option>
        <option value="Multan">Multan</option>
        <option value="Peshawar">Peshawar</option>
        <option value="Quetta">Quetta</option>
        <option value="Sialkot">Sialkot</option>
        <option value="Gujranwala">Gujranwala</option>
        <option value="Hyderabad">Hyderabad</option>
        <option value="Sukkur">Sukkur</option>
        <option value="Larkana">Larkana</option>
        <option value="Bahawalpur">Bahawalpur</option>
        <option value="Rahim Yar Khan">Rahim Yar Khan</option>
        <option value="Sargodha">Sargodha</option>
        <option value="Sheikhupura">Sheikhupura</option>
        <option value="Kasur">Kasur</option>
        <option value="Jhelum">Jhelum</option>
        <option value="Nawabshah">Nawabshah</option>
        <option value="Mardan">Mardan</option>
    </select>
</div>

        <div class="form-group">
            <label for="company">Company Name:</label>
            <select id="company" name="company_id" required>
                <option value="">Select Company</option>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo htmlspecialchars($row['id']); ?>">
                        <?php echo htmlspecialchars($row['name']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="departure_time">Date:</label>
            <input type="date" id="departure_time" name="date" required />
        </div>
        <div class="form-group">
            <label for="remaining-seats">Seats:</label>
            <input type="number" id="remaining-seats" name="seats" required />
        </div>
       
    </div>
    <button type="submit" class="btn-primary">Add Bus</button>
</form>

        </div>

      </div>
    </div>
  </div>


  </div>

  <script src="../../assets/admin/script.js"></script>
</body>

</html>