<?php
/**
 * Database Configuration
 * Beautybar - Beauty Products Website
 *
 * FOR LOCALHOST: Use settings below
 * FOR INFINITYFREE: Use the DEPLOY folder
 */

// LOCALHOST (XAMPP)
$host = "localhost";
$username = "root";
$password = "";
$database = "beauty_website";

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("<div style='text-align:center; padding:50px; font-family:Arial;'>
            <h2 style='color:#d81b60;'>Database Connection Error</h2>
            <p>Unable to connect to database.</p>
         </div>");
}

mysqli_set_charset($conn, "utf8");
?>
