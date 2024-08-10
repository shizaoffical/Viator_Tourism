<?php
session_start(); // Ensure session is started

// Retrieve user details from session
$userId = isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : 'Guest';
$userName = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Guest';
$userEmail = isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : 'Not Logged In';
$userRole = isset($_SESSION['user_role']) ? htmlspecialchars($_SESSION['user_role']) : 'Unknown Role';
?>
<div class="navbar">
    <div class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>
    <div class="logo">Hi <?php echo $userName; ?>..</div>
    <div class="user-settings">
        <i class="fas fa-user-cog" onclick="toggleUserDropdown()"></i>
        <div id="user-dropdown" class="user-dropdown">
            <p><?php echo $userName; ?></p>
            <p><?php echo $userEmail; ?></p>
            <p>Role: <?php echo $userRole; ?></p>
            <a href="../../includes/auth/logout.php">Logout</a> <!-- Link to logout script -->
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