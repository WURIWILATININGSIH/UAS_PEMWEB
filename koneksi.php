<?php
$host = 'localhost'; // Ganti jika menggunakan host selain localhost
$user = 'root'; // Username database Anda
$password = ''; // Password database Anda
$dbname = 'mahasiswa2'; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
