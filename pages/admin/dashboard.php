<?php include('../../includes/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="../../assets/admin/style.css" />
  </head>

  <body>
    <div class="dashboard">
      <?php include('layout/sidebar.php'); ?>
      

      <div class="main-content">
        <div class="content-header">
          <h1>Dashboard</h1>
        </div>

        <div class="content-body">
          <div id="buses-table">
            <h2>Buses</h2>
            <table>
              <thead>
                <tr>
                  <th>Bus Name</th>
                  <th>Company Name</th>
                  <th>Capacity</th>
                  <th>Route</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Bus 1</td>
                  <td>Company A</td>
                  <td>50</td>
                  <td>Route 1</td>
                  <td>Active</td>
                </tr>
                <tr>
                  <td>Bus 2</td>
                  <td>Company B</td>
                  <td>40</td>
                  <td>Route 2</td>
                  <td>Inactive</td>
                </tr>
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

          <div id="tours-table">
            <h2>Tours</h2>
            <table>
              <thead>
                <tr>
                  <th>Tour Name</th>
                  <th>Location</th>
                  <th>Duration</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Tour 1</td>
                  <td>Location A</td>
                  <td>3 Days</td>
                  <td>$300</td>
                </tr>
                <tr>
                  <td>Tour 2</td>
                  <td>Location B</td>
                  <td>5 Days</td>
                  <td>$500</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- <div id="add-bus-form" class="form hidden">
            <h2>Add Bus</h2>
            <form>
              <label for="bus-name">Bus Name:</label>
              <input type="text" id="bus-name" name="bus-name" required />
              <label for="company-name">Company Name:</label>
              <input
                type="text"
                id="company-name"
                name="company-name"
                required
              />
              <label for="capacity">Capacity:</label>
              <input type="number" id="capacity" name="capacity" required />
              <label for="route">Route:</label>
              <input type="text" id="route" name="route" required />
              <label for="status">Status:</label>
              <select id="status" name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
              <button type="submit">Add Bus</button>
            </form>
          </div> -->
          <div id="add-bus-form" class="form-container hidden">
            <h2 class="form-title">Add Bus</h2>
            <form>
              <div class="form-row">
                <div class="form-group">
                  <label for="bus-name">Bus Name:</label>
                  <input type="text" id="bus-name" name="bus-name" required />
                </div>
                <div class="form-group">
                  <label for="driver-name">Driver Name:</label>
                  <input
                    type="text"
                    id="driver-name"
                    name="driver-name"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="company">Company Name:</label>
                  <input type="text" id="company" name="company" required />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="total-seats">Total Seats:</label>
                  <input
                    type="number"
                    id="total-seats"
                    name="total-seats"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="remaining-seats">Remaining Seats:</label>
                  <input
                    type="number"
                    id="remaining-seats"
                    name="remaining-seats"
                    required
                  />
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
                    type="text"
                    id="departure_time"
                    name="departure_time"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="arrival_time">arrival time:</label>
                  <input
                    type="text"
                    id="arrival_time"
                    name="arrival_time"
                    required
                  />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group">
                  <label for="departure_from">departure from:</label>
                  <input
                    type="text"
                    id="departure_from"
                    name="departure_from"
                    required
                  />
                </div>
                <div class="form-group">
                  <label for="arrival_to">arrival to:</label>
                  <input
                    type="text"
                    id="arrival_to"
                    name="arrival_to"
                    required
                  />
                </div>
                <div class="form-group">
                  <label>Status:</label>
                  <div class="radio-group">
                    <label>
                      <input
                        type="radio"
                        name="status"
                        value="active"
                        required
                      />
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
            <h2>Manage Bus</h2>
            <!-- Form content for managing bus -->
          </div>

          <div id="add-package-form" class="form hidden">
            <h2>Add Package</h2>
            <!-- Form content for adding a package -->
          </div>

          <div id="manage-package-form" class="form hidden">
            <h2>Manage Package</h2>
            <!-- Form content for managing package -->
          </div>

          <div id="add-tour-form" class="form hidden">
            <h2>Add Tour</h2>
            <!-- Form content for adding a tour -->
          </div>

          <div id="manage-tour-form" class="form hidden">
            <h2>Manage Tour</h2>
            <!-- Form content for managing tour -->
          </div>
        </div>
      </div>
    </div>
  
    <script src="../../assets/admin/script.js"></script>
  </body>
</html>
