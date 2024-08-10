<?php
// Database connection parameters
$host = 'localhost'; // Change as needed
$dbname = 'vital_traveller'; // Change as needed
$dbuser = 'root'; // Change as needed
$dbpass = ''; // Change as needed

// Create a database connection
$conn = mysqli_connect($host, $dbuser, $dbpass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Connected successfully";

}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js"></script>