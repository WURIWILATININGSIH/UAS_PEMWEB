<?php
include 'koneksi.php'; // 

// Tangkap data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $deskripsi = $_POST['deskripsi'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Validasi data
    if (strlen($nim) < 8 || !is_numeric($nim)) {
        die("NIM harus berupa angka dan minimal 8 karakter.");
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
        die("Nama hanya boleh mengandung huruf dan spasi.");
    }

    // Simpan ke database
    $sql = "INSERT INTO mahasiswa (name, nim, prodi , deskripsi, browser, ip_address)
            VALUES ('$nama', '$nim','$prodi', '$deskripsi', '$browser', '$ip_address')";

    if ($conn->query($sql) === TRUE) {
        header('Location: hasil_input.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Tutup koneksi
}
?>
