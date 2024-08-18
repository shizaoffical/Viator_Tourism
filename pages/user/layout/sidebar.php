<?php
session_start(); // Ensure session is started

// Retrieve user details from session
$userId = isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id']) : 'Guest';
$userName = isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Guest';
$userEmail = isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : 'Not Logged In';
$userRole = isset($_SESSION['user_role']) ? htmlspecialchars($_SESSION['user_role']) : 'Unknown Role';

// Function to get base URL
function getBaseUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']); // Directory of the current script

    return $protocol . '://' . $host . '/' . ltrim($scriptName, '/');
}

// Example usage:
$baseUrl = getBaseUrl();

// Check if user role is not admin
if ($userRole !== 'user') {
    header("Location: " . $baseUrl . "../../../includes/auth/logout.php");
    exit();
}

// If the role is 'admin', continue with the rest of your page logic
// ...

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
  <button class="close-btn" onclick="closeSidebar()">&times;</button>
  <div class="sidebar-logo">
    <img src="./assets/images/logo.png" alt="Logo" />
    <p>Vital Traveller</p>
  </div>
 
      <ul id="buses-submenu" class="submenu">
        <li>
          <a href="../../user/booking/create.php">New Booking</a>
        </li>
        <li>
          <a href="../../user/booking/index.php">My Booking</a>
        </li>
        <li>
          <a href="../../../includes/auth/logout.php">Logout</a>
        </li>
        <!-- <li>
          <a href="javascript:void(0)" onclick="toggleForm('manage-bus-form')">Manage Bus</a>
        </li> -->
      </ul>

</div>
