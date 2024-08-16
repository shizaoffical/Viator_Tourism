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

<body>
  
  <div class="dashboard">
    <?php include('../layout/sidebar.php'); ?>
    <div class="main-content">
      <div class="content-body">
        <div id="buses-table">
          <h2>Buses</h2>
          <a href='create.php' class='btn btn-edit'>Add bus</a>


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
                    <a href='../../../includes/bus/edit.php?id=$bus_id' class='btn btn-edit'>Edit</a>
                    <a href='../../../includes/bus/delete.php?id=$bus_id' class='btn btn-delete'>Delete</a>
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