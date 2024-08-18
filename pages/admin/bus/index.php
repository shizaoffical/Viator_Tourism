<?php include('../../../includes/db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="../../../assets/admin/style.css" />
  <?php if (isset($_GET['error'])) { ?>
    <script>
        alert("<?php echo htmlspecialchars(urldecode($_GET['error'])); ?>");
    </script>
  <?php } ?>
</head>

<body>

  <div class="dashboard">
    <?php include('../layout/sidebar.php'); ?>
    <div class="main-content">
      <div class="content-body">
        <div id="buses-table">
          <h2>Buses</h2>
          <a href='create.php' class='btn btn-edit'>Add bus</a>

          <?php
          // Pagination setup
          $records_per_page = 10; // Number of records per page
          $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
          $offset = ($current_page - 1) * $records_per_page;

          // Count the total number of records
          $sql_count = "SELECT COUNT(*) as total FROM buses";
          $result_count = $conn->query($sql_count);
          $total_rows = $result_count->fetch_assoc()['total'];
          $total_pages = ceil($total_rows / $records_per_page);

          // Fetch and display buses with pagination
          $sql = "SELECT buses.*, bus_company.name FROM buses 
                  INNER JOIN bus_company ON buses.company_id = bus_company.id
                  LIMIT $offset, $records_per_page";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            echo "<table>
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Bus Number</th>
                        <th>Driver Name</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
              $bus_id = htmlspecialchars($row["id"]);
              $bus_number = htmlspecialchars($row["bus_number"]);
              $driver_name = htmlspecialchars($row["driver_name"]);
              $company = htmlspecialchars($row["name"]);
              $status = htmlspecialchars($row["status"]);
              $image = htmlspecialchars($row["image_path"]); // Assuming `image` is the column name for the image URL

              echo "<tr>
                      <td><img src='../../../uploads/buses/$image' alt='$bus_number' width='100' /></td>
                      <td>$bus_number</td>
                      <td>$driver_name</td>
                      <td>$company</td>
                      <td>$status</td>
                      <td>
                          <button class='btn btn-view' data-modal-id='modal-$bus_id'>View</button>
                          <a href='../../../includes/bus/edit.php?id=$bus_id' class='btn btn-edit'>Edit</a>
                          <a href='../../../includes/bus/delete.php?id=$bus_id' class='btn btn-delete'>Delete</a>
                      </td>
                    </tr>";

              // Modal for each bus
              echo "<div id='modal-$bus_id' class='modal hidden'>
                      <div class='modal-content'>
                        <span class='close' data-modal-id='modal-$bus_id'>&times;</span>
                        <h2>Bus Details</h2>
                        <div class='modal-body'>
                          <div class='modal-column'>
                            <p><strong>Bus Number:</strong> $bus_number</p>
                            <p><strong>Driver Name:</strong> $driver_name</p>
                            <p><strong>Company:</strong> $company</p>
                            <p><strong>Total Seats:</strong> {$row['total_seats']}</p>
                            <p><strong>Remaining Seats:</strong> {$row['remaining_seats']}</p>
                            <p><strong>Price:</strong> {$row['price']}</p>
                          </div>
                          <div class='modal-column'>
                            <p><strong>Discount:</strong> {$row['discount']}</p>
                            <p><strong>Status:</strong> $status</p>
                            <p><strong>Departure Time:</strong> {$row['departure_time']}</p>
                            <p><strong>Arrival Time:</strong> {$row['arrival_time']}</p>
                            <p><strong>Departure From:</strong> {$row['departure_from']}</p>
                            <p><strong>Arrival To:</strong> {$row['arrival_to']}</p>
                          </div>
                        </div>
                      </div>
                    </div>";
            }

            echo "</tbody></table>";

            // Pagination links
            echo "<div class='pagination'>";
            if ($current_page > 1) {
              echo "<a href='?page=" . ($current_page - 1) . "' class='btn btn-prev'>Previous</a>";
            }

            for ($page = 1; $page <= $total_pages; $page++) {
              echo "<a href='?page=$page' class='btn " . ($page == $current_page ? "active" : "") . "'>$page</a>";
            }

            if ($current_page < $total_pages) {
              echo "<a href='?page=" . ($current_page + 1) . "' class='btn btn-next'>Next</a>";
            }
            echo "</div>";
          } else {
            echo "<p>No buses found.</p>";
          }
          ?>

        </div>
      </div>
    </div>
  </div>

  <script>
    <?php
    if (isset($_GET['success'])) {
        echo "<script type='text/javascript'>
                alert('" . htmlspecialchars($_GET['success']) . "');
              </script>";
    }

    if (isset($_GET['error'])) {
        echo "<script type='text/javascript'>
                alert('" . htmlspecialchars($_GET['error']) . "');
              </script>";
    }
    ?>
  </script>
  <script src="../../assets/admin/script.js"></script>
</body>

</html>
