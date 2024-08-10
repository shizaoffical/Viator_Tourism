<?php include('includes/db.php'); ?>
<?php
session_start(); // Start the session

include('includes/auth/reset_request_process.php');
include('includes/auth/reset_password_form.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Viator Tourism</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js"></script>

    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/general.css" />
    <link rel="stylesheet" href="./assets/css/responsive.css" />
    <script src="../script/script.js"></script>
    <script>
        // Function to show alerts based on URL parameters
        function showAlert(status, message) {
            if (status === 'success') {
                alert(message);
            } else if (status === 'error') {
                alert(message);
            }
        }

        // Get URL parameters
        function getQueryParam(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Execute on page load
        window.onload = function() {
            const status = getQueryParam('status');
            const message = getQueryParam('message');
            const newUser = getQueryParam('new_user');

            if (newUser === 'true') {
                alert("Welcome! Your account has been created successfully.");
            }

            if (status && message) {
                showAlert(status, decodeURIComponent(message));
            }
        };
    </script>
  <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Check if the URL has a token parameter
            const urlParams = new URLSearchParams(window.location.search);
            const token = urlParams.get('token');
          
            if (token) {
                // Show the form if token is present
                document.getElementById('ResetPasswordForm').style.display = 'block';
                // Set the token in the form
                document.getElementById('token').value = token;
            } 
        });
    </script>

</head>

<body>

    <nav class="navbar">
        <div class="navbar-header">
            <a href="/" class="logo">
                <img src="./assets/images/logo.png" alt="Logo" />
                <h1>Viator Tourism</h1>
            </a>
            <button class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="./pages/about.php">About</a></li>
            <li class="dropdown">
                <a href="#">Buses <i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                        <a href="#">Deawoo<i class="fas fa-chevron-right"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Bus 1</a></li>
                            <li><a href="#">Bus 2</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#">Sky Ways<i class="fas fa-chevron-right"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Bus 3</a></li>
                            <li><a href="#">Bus 4</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#">Faisal Movers <i class="fas fa-chevron-right"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Bus 3</a></li>
                            <li><a href="#">Bus 4</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#">Road Master<i class="fas fa-chevron-right"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Bus 3</a></li>
                            <li><a href="#">Bus 4</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Tour <i class="fas fa-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                        <a href="#">Couple Tour</a>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#">Family Tour</a>
                    </li>
                    <li class="dropdown-submenu">
                        <a href="#">Group Tour</a>
                    </li>
                </ul>
            </li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Gallery</a></li>
            <button class="main-button navbar-btn" style="margin-left: 5px;"> <a href="/pages/booking.php">Booking</a></button>

            <?php
            if (isset($_SESSION['user_role'])) {
                $user_role = $_SESSION['user_role'];
                // Display content based on role
                if ($user_role == 'admin' || $user_role == 'user') {
            ?>
                    <a href="includes/auth/logout.php">Logout</a>
                <?php
                }
            } else {
                ?>
                <button type="button" id="loginBtn" style="margin-left: 10px !important;"><i class="fas fa-user icon"></i>
                </button>
            <?php
            }


            ?>


            <!-- <div id="loginPopup" class="popup">
                <div class="popup-content">
                    <span class="close-popup">&times;</span>
                    <div id="loginForm">
                        <h2>Login</h2>
                        <form action="includes/auth/login.php" method="post">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" required>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                            <div class="register-link">
                                Don't have an account? <a href="#" id="showforgetpassword">Forget Password</a>
                            </div>
                            <button type="submit">Login</button>
                        </form>
                        <div class="register-link">
                            Don't have an account? <a href="#" id="showSignup">Register here</a>
                        </div>
                    </div>
                    <div id="signupForm" style="display:none;">
                        <h2>Sign Up</h2>
                        <form action="includes/auth/signup.php" method="post">
                            <label for="newUsername">Username:</label>
                            <input type="text" id="newUsername" name="newUsername" required>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                            <label for="newPassword">Password:</label>
                            <input type="password" id="newPassword" name="newPassword" required>
                            <button type="submit">Sign Up</button>
                        </form>
                        <div class="login-link">
                            Already have an account? <a href="#" id="showLogin">Login here</a>
                        </div>
                    </div>
                    <div id="signupForm" style="display:none;">
                        <h2>Sign Up</h2>
                        <form action="reset_request_process.php" method="post">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                            <button type="submit">Send Reset Link</button>
                        </form>
                        <div class="login-link">
                            Already have an account? <a href="#" id="showLogin">Login here</a>
                        </div>
                    </div>
                </div>
            </div> -->
            <div id="loginPopup" class="popup">
                <div class="popup-content">
                    <span class="close-popup">&times;</span>
                    <div id="loginForm">
                        <h2>Login</h2>
                        <form action="includes/auth/login.php" method="post">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" required>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                            <div class="remember-forgot">
                                <a href="#" id="showForgetPassword">Forgot Password?</a>
                            </div>
                            <button type="submit">Login</button>
                        </form>
                        <div class="register-link">
                            Don't have an account? <a href="#" id="showSignup">Register here</a>
                        </div>
                    </div>

                    <div id="signupForm" style="display:none;">
                        <h2>Sign Up</h2>
                        <form action="includes/auth/signup.php" method="post">
                            <label for="newUsername">Username:</label>
                            <input type="text" id="newUsername" name="newUsername" required>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                            <label for="newPassword">Password:</label>
                            <input type="password" id="newPassword" name="newPassword" required>
                            <button type="submit">Sign Up</button>
                        </form>
                        <div class="login-link">
                            Already have an account? <a href="#" id="showLogin">Login here</a>
                        </div>
                    </div>

                    <div id="forgetPasswordForm" style="display:none;">
                        <h2>Reset Password</h2>
                        <form action="" method="post">
                            <label for="email">Email:</label>
                            <input type="email" id="resetEmail" name="email" required>
                            <button type="submit">Send Reset Link</button>
                        </form>

                    </div>
                    <div id="ResetPasswordForm" style="display:none;">
                        <h2>Reset Password</h2>
                        <form method="post" action="">
                            <label for="password">New Password:</label>
                            <input type="password" id="password" name="password" required>
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
                            <button type="submit" name="resetpassword">Reset Password</button>
                        </form>
                    </div>


                </div>
            </div>

        </ul>
    </nav>