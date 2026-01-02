<?php
/**
 * Database Configuration File
 * Beauty Website - College Project
 */

// ============================================
// INFINITYFREE SETTINGS - Fill your details below
// ============================================
$host = "sql113.infinityfree.com";
$username = "if0_40809836";
$password = "Svkads123";   // Put your InfinityFree login password here
$database = "if0_40809836_GlowBeauty";

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
