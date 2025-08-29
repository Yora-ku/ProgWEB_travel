<?php

// Konfigurasi database
$servername = "localhost"; // default Laragon
$username = "root";        // default Laragon
$password = "";            // default Laragon
$dbname = "travelhub";     // sesuaikan dengan database kamu

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// set charset
$conn->set_charset("utf8mb4");
