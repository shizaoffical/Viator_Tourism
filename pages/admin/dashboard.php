<?php include('../../includes/db.php'); ?>

<?php include '../../includes/bus/add.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="../../assets/admin/style.css" />
</head>

<body>
  <div class="dashboard">
    <?php include('layout/sidebar.php'); ?>
    <div class="main-content">
      <!-- <div class="content-header">
          <h1>Dashboard</h1>
        </div> -->

      <div class="content-body">
        <div id="buses-table">
          <h2>Buses</h2>
          <table>
            <thead>
              <tr>
                <th>Bus Number</th>
                <th>Driver Name</th>
                <th>Company</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Fetch and display buses
              $sql = "SELECT buses.*, bus_company.name  FROM buses 
        INNER JOIN bus_company ON buses.company_id = bus_company.id";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {


                  $bus_id = htmlspecialchars($row["id"]);
                  $bus_number = htmlspecialchars($row["bus_number"]);
                  $driver_name = htmlspecialchars($row["driver_name"]);
                  $company = htmlspecialchars($row["name"]); // Fetch company name
                  $total_seats = htmlspecialchars($row["total_seats"]);
                  $remaining_seats = htmlspecialchars($row["remaining_seats"]);
                  $price = htmlspecialchars($row["price"]);
                  $discount = htmlspecialchars($row["discount"]);
                  $departure_time = htmlspecialchars($row["departure_time"]);
                  $arrival_time = htmlspecialchars($row["arrival_time"]);
                  $departure_from = htmlspecialchars($row["departure_from"]);
                  $arrival_to = htmlspecialchars($row["arrival_to"]);
                  $status = htmlspecialchars($row["status"]);


                  // Display table row
                  echo "<tr>
                <td>$bus_number</td>
                <td>$driver_name</td>
                <td>$company</td>
                <td>$status</td>
                <td>
                    <button class='btn btn-view' data-modal-id='modal-$bus_id'>View</button>
                    <a href='../../includes/bus/edit.php?id=$bus_id' class='btn btn-edit'>Edit</a>
                    <a href='../../includes/bus/delete.php?id=$bus_id' class='btn btn-delete'>Delete</a>
                </td>
              </tr>";

                  // Display modal for each bus
                  echo "<div id='modal-$bus_id' class='modal hidden'>
                    <div class='modal-content'>
                      <span class='close' data-modal-id='modal-$bus_id'>&times;</span>
                      <h2>Bus Details</h2>
                      <div class='modal-body'>
                        <div class='modal-column'>
                          <p><strong>Bus Number:</strong> $bus_number</p>
                          <p><strong>Driver Name:</strong> $driver_name</p>
                          <p><strong>Company:</strong> $company</p>
                          <p><strong>Total Seats:</strong> $total_seats</p>
                          <p><strong>Remaining Seats:</strong> $remaining_seats</p>
                          <p><strong>Price:</strong> $price</p>
                        </div>
                        <div class='modal-column'>
                          <p><strong>Discount:</strong> $discount</p>
                          <p><strong>Status:</strong> $status</p>
                          <p><strong>Departure Time:</strong> $departure_time</p>
                          <p><strong>Arrival Time:</strong> $arrival_time</p>
                          <p><strong>Departure From:</strong> $departure_from</p>
                          <p><strong>Arrival To:</strong> $arrival_to</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  ";
                }
              } else {
                echo "<tr><td colspan='5'>No results found</td></tr>";
              }
              ?>

            </tbody>
          </table>
        </div>

        <div id="packages-table">
          <h2>Packages</h2>
          <table>
            <thead>
              <tr>
                <th>Package Name</th>
                <th>Duration</th>
                <th>Price</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Package 1</td>
                <td>5 Days</td>
                <td>$500</td>
                <td>Description of Package 1</td>
              </tr>
              <tr>
                <td>Package 2</td>
                <td>7 Days</td>
                <td>$700</td>
                <td>Description of Package 2</td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php
        // Assuming you have already connected to the database
        $query = "SELECT * FROM bus_company";
        $result = mysqli_query($conn, $query);

        if (!$result) {
          echo "Error fetching companies: " . mysqli_error($conn);
          exit;
        }
        ?>

        <div id="add-bus-form" class="form-container hidden">
          <h2 class="form-title">Add Bus</h2>
          <form action="./dashboard.php" method="POST">
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

        <div id="manage-bus-form" class="form hidden">
          <h2>Buses</h2>
          <table>
            <thead>
              <tr>
                <th>Bus Number</th>
                <th>Driver Name</th>
                <th>Company</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Fetch and display buses
              $sql = "SELECT * FROM buses";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $bus_id = htmlspecialchars($row["id"]);
                  $bus_number = htmlspecialchars($row["bus_number"]);
                  $driver_name = htmlspecialchars($row["driver_name"]);
                  $company = htmlspecialchars($row["company"]);
                  $total_seats = htmlspecialchars($row["total_seats"]);
                  $remaining_seats = htmlspecialchars($row["remaining_seats"]);
                  $price = htmlspecialchars($row["price"]);
                  $discount = htmlspecialchars($row["discount"]);
                  $departure_time = htmlspecialchars($row["departure_time"]);
                  $arrival_time = htmlspecialchars($row["arrival_time"]);
                  $departure_from = htmlspecialchars($row["departure_from"]);
                  $arrival_to = htmlspecialchars($row["arrival_to"]);
                  $status = htmlspecialchars($row["status"]);
                  // Display table row
                  echo "<tr>
                <td>$bus_number</td>
                <td>$driver_name</td>
                <td>$company</td>
                <td>$status</td>
                <td>
                    <button class='btn btn-view' data-modal-id='modal-$bus_id'>View</button>
                    <a href='../../includes/bus/edit.php?id=$bus_id' class='btn btn-edit'>Edit</a>
                    <a href='../../includes/bus/delete.php?id=$bus_id' class='btn btn-delete'>Delete</a>
                </td>
              </tr>";

                  // Display modal for each bus
                  echo "<div id='modal-$bus_id' class='modal hidden'>
                <div class='modal-content'>
                  <span class='close' data-modal-id='modal-$bus_id'>&times;</span>
                  <h2>Bus Details</h2>
                  <div class='modal-body'>
                    <div class='modal-column'>
                      <p><strong>Bus Number:</strong> $bus_number</p>
                      <p><strong>Driver Name:</strong> $driver_name</p>
                      <p><strong>Company:</strong> $company</p>
                      <p><strong>Total Seats:</strong> $total_seats</p>
                      <p><strong>Remaining Seats:</strong> $remaining_seats</p>
                      <p><strong>Price:</strong> $price</p>
                    </div>
                    <div class='modal-column'>
                      <p><strong>Discount:</strong> $discount</p>
                      <p><strong>Status:</strong> $status</p>
                      <p><strong>Departure Time:</strong> $departure_time</p>
                      <p><strong>Arrival Time:</strong> $arrival_time</p>
                      <p><strong>Departure From:</strong> $departure_from</p>
                      <p><strong>Arrival To:</strong> $arrival_to</p>
                    </div>
                  </div>
                </div>
              </div>
              ";
                }
              } else {
                echo "<tr><td colspan='5'>No results found</td></tr>";
              }
              ?>

            </tbody>
          </table>
        </div>








      </div>

      <div id="manage-package-form" class="form hidden">
        <h2>Manage Package</h2>
        <!-- Form content for managing package -->
      </div>

    </div>
  </div>


  </div>

  <script src="../../assets/admin/script.js"></script>
</body>

</html>