<?php
/**
 * Database Configuration - InfinityFree
 * Beautybar - Beauty Products Website
 */

$host = "sql113.infinityfree.com";
$username = "if0_40809836";
$password = "Svkads123";
$database = "if0_40809836_GlowBeauty";

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
