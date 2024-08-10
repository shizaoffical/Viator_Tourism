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
    <link rel="stylesheet" href="styles.css" />
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

    body,
    html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: var(--secondary-color);
      overflow-x: hidden; /* Prevent horizontal scroll */
    }

    .dashboard {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    .navbar {
      background-color: var(--primary-color);
      color: var(--light-color);
      padding: 20px 20px;
      display: flex;
      justify-content: space-between;

      align-items: center;
      position: fixed;
      width: calc(96.8% - var(--sidebar-width));
      left: var(--sidebar-width);
      z-index: 1000;
    }

   
    .form-group input:focus,
    .form-group select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 8px var(--primary-color);
    }

  
    .user-settings {
      position: relative;
    }

    .user-settings i {
      font-size: 20px;
      cursor: pointer;
      margin-right: 3rem;
    }

    .user-dropdown {
      display: none;
      position: absolute;
      top: 35px;
      right: 20px;
      background-color: var(--light-color);
      color: var(--dark-color);
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      z-index: 1001;
      width: 200px;
      padding: 10px 0;
    }

    .user-dropdown.open {
      display: block;
    }

    .user-dropdown p,
    .user-dropdown a {
      padding: 10px;
      margin: 0;
      text-align: center;
    }

    .user-dropdown a {
      display: block;
      color: var(--dark-color);
      text-decoration: none;
      border-top: 1px solid #ccc;
    }

    .user-dropdown a:hover {
      background-color: var(--primary-color);
      color: var(--light-color);
    }
  

    .sidebar {
      background-color: var(--dark-color);
      width: 250px;
      padding-top: 20px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      overflow-y: auto;
      z-index: 1000;
      transition: transform 0.3s ease;
    }
    .sidebar-toggle {
      font-size: 20px;
      cursor: pointer;
      display: none;
      color: var(--light-color);
    }
    .sidebar .close-btn {
      display: none;
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      background: none;
      border: none;
      color: var(--light-color);
      cursor: pointer;
    }
  

    .sidebar.open {
      transform: translateX(0);
    }

    .sidebar .sidebar-logo {
      text-align: center;
      display: flex;
      gap: 10px;
      color: var(--light-color);
      justify-content: center !important;
      align-items: center !important;
    }

    .sidebar .sidebar-logo img {
      max-width: 70px;
    }
    .sidebar .sidebar-logo p {
      text-transform: capitalize;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }

    .sidebar ul li {
      padding: 15px;
      color: var(--light-color);
      cursor: pointer;
      position: relative;
    }

    .sidebar ul li a {
      color: inherit;
      text-decoration: none;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .sidebar ul li ul {
      list-style-type: none;
      padding-left: 20px;
      display: none;
      transition: max-height var(--transition-duration) ease-out;
    }

    .sidebar ul li ul li {
      padding: 10px 0;
      color: #ccc;
    }

    .sidebar ul li:hover {
      background-color: #333;
    }

    .sidebar ul li.open > ul {
      display: block;
    }
    .sidebar ul li a .fas {
      transition: transform var(--transition-duration);
    }

    .sidebar ul li.open > a .fas {
      transform: rotate(180deg);
    }
    .main-content {
      margin-left: var(--sidebar-width);
      padding: 80px 20px 20px 20px;
      flex-grow: 1;
      transition: margin-left 0.3s ease;
    }

    .content-header {
      background-color: var(--light-color);
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .content-body {
      margin-top: 20px;
      background-color: var(--light-color);
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .content-body table {
      width: 100%;
      border-collapse: collapse;
    }

    .content-body table,
    .content-body th,
    .content-body td {
      border: 1px solid #ddd;
    }

    .content-body th,
    .content-body td {
      padding: 12px;
      text-align: left;
    }

    .content-body th {
      background-color: var(--primary-color);
      color: var(--light-color);
    }

    .content-body tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .hidden {
      display: none;
    }

    .form-container {
      font-family: "Roboto", sans-serif;
      color: var(--light-color);
    }

    .form-title {
      color: var(--primary-color);
      text-align: center;
      margin-bottom: 25px;
      font-size: 28px;
      font-weight: bold;
      border-bottom: 2px solid var(--primary-color);
      padding-bottom: 10px;
    }

    .form-row {
      display: flex;
      justify-content: space-between;
    }

    .form-group {
      flex: 0 0 32%;
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      color: var(--dark-color);
      margin-bottom: 6px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 6px 4px;
      font-size: 13px;
      border: 1px solid var(--dark-color);
      border-radius: 6px;
      box-sizing: border-box;
      outline: none;
      transition: all var(--transition-duration);
    }

    .form-group input:focus,
    .form-group select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 5px var(--primary-color);
    }

    .radio-group {
      display: flex;
      justify-content: flex-start;
      gap: 20px;
      align-items: center;
    }

    .radio-group label {
      font-size: 13px;
      display: flex;
      align-items: center;
      gap: 5px;
      color: var(--dark-color);
    }

    .btn-primary {
      width: 100%;
      background-color: var(--primary-color);
      color: var(--light-color);
      padding: 14px;
      font-size: 18px;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color var(--transition-duration),
        transform var(--transition-duration);
    }

    .btn-primary:hover {
      background-color: var(--button-hover-color);
      transform: scale(1.02);
    }

    @media (max-width: 768px) {
      .navbar .sidebar-toggle {
        display: block;
      }
      .navbar {
        width: 100%;
        left: 0;
      }

      .sidebar {
        width: 100%;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
      }

      .sidebar.open {
        transform: translateX(0);
      }

      .sidebar .close-btn {
        display: block;
      }
      .sidebar {
        width: 100%;
        height: 100vh;
        position: absolute;
        transform: translateX(-100%);
      }
      .form-row {
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .form-group {
      flex: 0 0 100%;
      margin-bottom: 20px;
    }
      .main-content {
        margin-left: 0;
      padding: 80px 20px 20px 20px;
      flex-grow: 1;
      transition: margin-left 0.3s ease;
      }
    }
    @media (max-width: 480px) {
  
      .user-settings i {
        font-size: 18px;
      }

      .user-dropdown {
        width: 150px;
        top: 40px;
        right: 10px;
      }

      .user-dropdown p,
      .user-dropdown a {
        padding: 8px;
      }

      .sidebar ul li {
        padding: 10px;
      }

      .sidebar ul li ul li {
        padding: 8px 0;
      }

      .content-body {
        padding: 15px;
      }

      .content-body table th,
      .content-body table td {
        font-size: 14px;
        padding: 10px;
      }
    }
  </style>
  <body>
    <div class="dashboard">

      <div class="navbar">
        <div class="sidebar-toggle" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </div>
        <div class="logo">My Dashboard</div>
        <div class="user-settings">
          <i class="fas fa-user-cog" onclick="toggleUserDropdown()"></i>
          <div id="user-dropdown" class="user-dropdown">
            <p>User Name</p>
            <p>Email@example.com</p>
            <a href="#logout">Logout</a>
          </div>
        </div>
      </div>

      <div class="sidebar">
        <!-- <button class="close-btn">&times;</button> -->
        <button class="close-btn" onclick="closeSidebar()">&times;</button>
        <div class="sidebar-logo">
          <img src="./assets/images/logo.png" alt="Logo" />
          <p>vital Traveller</p>
        </div>
        <ul>
          <li>
            <a href="#buses" onclick="toggleSection('buses-submenu')">
              Buses <i class="fas fa-chevron-down"></i>
            </a>
            <ul id="buses-submenu" class="submenu">
              <li>
                <a
                  href="javascript:void(0)"
                  onclick="toggleForm('add-bus-form')"
                  >Add Bus</a
                >
              </li>
              <li>
                <a
                  href="javascript:void(0)"
                  onclick="toggleForm('manage-bus-form')"
                  >Manage Bus</a
                >
              </li>
            </ul>
          </li>
          <li>
            <a href="#packages" onclick="toggleSection('packages-submenu')">
              Packages <i class="fas fa-chevron-down"></i>
            </a>
            <ul id="packages-submenu" class="submenu">
              <li>
                <a
                  href="javascript:void(0)"
                  onclick="toggleForm('add-package-form')"
                  >Add Package</a
                >
              </li>
              <li>
                <a
                  href="javascript:void(0)"
                  onclick="toggleForm('manage-package-form')"
                  >Manage Package</a
                >
              </li>
            </ul>
          </li>
          <li>
            <a href="#tours" onclick="toggleSection('tours-submenu')">
              Tours <i class="fas fa-chevron-down"></i>
            </a>
            <ul id="tours-submenu" class="submenu">
              <li>
                <a
                  href="javascript:void(0)"
                  onclick="toggleForm('add-tour-form')"
                  >Add Tour</a
                >
              </li>
              <li>
                <a
                  href="javascript:void(0)"
                  onclick="toggleForm('manage-tour-form')"
                  >Manage Tour</a
                >
              </li>
            </ul>
          </li>
        </ul>
      </div>

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
    <script>
      function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        const parentLi = section.parentElement;

        if (parentLi.classList.contains("open")) {
          parentLi.classList.remove("open");
        } else {
          document
            .querySelectorAll(".sidebar ul li")
            .forEach((li) => li.classList.remove("open"));
          parentLi.classList.add("open");
        }
      }

      function toggleUserDropdown() {
        const dropdown = document.getElementById("user-dropdown");
        dropdown.classList.toggle("open");
      }

      function toggleForm(formId) {
        const forms = document.querySelectorAll(".content-body > div");
        forms.forEach((form) => {
          if (form.id === formId) {
            form.classList.remove("hidden");
          } else {
            form.classList.add("hidden");
          }
        });
      }

      // Render all records by default
      document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("buses-table").classList.remove("hidden");
        document.getElementById("packages-table").classList.remove("hidden");
        document.getElementById("tours-table").classList.remove("hidden");
      });
      function toggleSidebar() {
        const sidebar = document.querySelector(".sidebar");
        sidebar.classList.toggle("open");
      }

      // Function to toggle the sidebar
      function toggleSidebar() {
        const sidebar = document.querySelector(".sidebar");
        const isSidebarOpen = sidebar.classList.contains("open");

        if (isSidebarOpen) {
          sidebar.classList.remove("open");
          localStorage.setItem("sidebarState", "closed");
        } else {
          sidebar.classList.add("open");
          localStorage.setItem("sidebarState", "open");
        }
      }

      // Function to close the sidebar
      function closeSidebar() {
        const sidebar = document.querySelector(".sidebar");
        sidebar.classList.remove("open");
        localStorage.setItem("sidebarState", "closed");
      }

      // Load the sidebar state from localStorage when the page loads
      document.addEventListener("DOMContentLoaded", () => {
        const sidebarState = localStorage.getItem("sidebarState");
        const sidebar = document.querySelector(".sidebar");

        if (sidebarState === "open") {
          sidebar.classList.add("open");
        } else {
          sidebar.classList.remove("open");
        }
      });
    </script>
  </body>
</html>
