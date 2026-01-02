<?php
/**
 * Database Configuration File
 * Beauty Website - College Project
 *
 * INSTRUCTIONS:
 * - For XAMPP (localhost): Use the LOCAL settings
 * - For InfinityFree: Use the INFINITYFREE settings
 *
 * Just comment/uncomment the appropriate section below
 */

// ============================================
// OPTION 1: LOCAL (XAMPP) - For testing
// ============================================
// Uncomment below for localhost testing

$host = "localhost";
$username = "root";
$password = "";
$database = "beauty_website";


// ============================================
// OPTION 2: INFINITYFREE - For live deployment
// ============================================
// Get these details from InfinityFree Control Panel > MySQL Databases
// Comment out OPTION 1 above, then uncomment below:

// $host = "sql.infinityfree.com";        // Replace with your MySQL host (e.g., sql123.infinityfree.com)
// $username = "if0_12345678";             // Replace with your MySQL username
// $password = "your_password_here";       // Replace with your MySQL password
// $database = "if0_12345678_beauty";      // Replace with your database name

// ============================================
// DATABASE CONNECTION (Don't change below)
// ============================================

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    // Show user-friendly error on live site
    die("<div style='text-align:center; padding:50px; font-family:Arial;'>
            <h2 style='color:#d81b60;'>Database Connection Error</h2>
            <p>Unable to connect to database. Please check your configuration.</p>
         </div>");
}

// Set charset to handle special characters
mysqli_set_charset($conn, "utf8");
?>
