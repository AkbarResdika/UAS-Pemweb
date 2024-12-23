<?php
$servername = "localhost"; // Nama host database Anda
$usernameDB = "root"; // Username database Anda
$passwordDB = ""; // Password database Anda
$dbname = "userr"; // Nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
