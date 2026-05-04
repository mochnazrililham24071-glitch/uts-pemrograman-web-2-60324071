<?php
$conn = new mysqli("localhost", "root", "", "uts_perpustakaan_60324071");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>