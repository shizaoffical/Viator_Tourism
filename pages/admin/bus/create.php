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
          <h2 class="form-title">Add Bus</h2>
          <form action="../../../includes/bus/add.php" method="POST">
            <div class="form-row">
              <div class="form-group">
                <label for="bus_number">Bus Number:</label>
                <input type="text" id="bus_number" name="bus_number" required />
              </div>
              <div class="form-group">
                <label for="driver-name">Driver Name:</label>
                <input
                  type="text"
                  id="driver-name"
                  name="driver-name"
                  required />
              </div>
              <div class="form-group">
                <label for="company">Company Name:</label>
                <select id="company" name="company_id" required>
                  <option value="">Select Company</option>
                  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['id']; ?>">
                      <?php echo htmlspecialchars($row['name']); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="total-seats">Total Seats:</label>
                <input
                  type="number"
                  id="total-seats"
                  name="total-seats"
                  required />
              </div>
              <div class="form-group">
                <label for="remaining-seats">Remaining Seats:</label>
                <input
                  type="number"
                  id="remaining-seats"
                  name="remaining-seats"
                  required />
              </div>
              <div class="form-group">
                <label for="Price">Price:</label>
                <input type="number" id="Price" name="Price" required />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="discount">Discount:</label>
                <input type="number" id="discount" name="discount" required />
              </div>
              <div class="form-group">
                <label for="departure_time">Departure Time:</label>
                <input
                  type="datetime-local"
                  id="departure_time"
                  name="departure_time"
                  required />
              </div>
              <div class="form-group">
                <label for="arrival_time">arrival time:</label>
                <input
                  type="datetime-local"
                  id="arrival_time"
                  name="arrival_time"
                  required />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="departure_from">departure from:</label>
                <input
                  type="text"
                  id="departure_from"
                  name="departure_from"
                  required />
              </div>
              <div class="form-group">
                <label for="arrival_to">arrival to:</label>
                <input
                  type="text"
                  id="arrival_to"
                  name="arrival_to"
                  required />
              </div>
              <div class="form-group">
                <label>Status:</label>
                <div class="radio-group">
                  <label>
                    <input
                      type="radio"
                      name="status"
                      value="active"
                      required />
                    Active
                  </label>
                  <label>
                    <input type="radio" name="status" value="inactive" />
                    Inactive
                  </label>
                </div>
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