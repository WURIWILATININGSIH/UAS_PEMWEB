<?php
// Tangkap data dari formulir
$nim = $_POST['nim'] ?? '';
$nama = $_POST['nama'] ?? '';
$prodi = $_POST['prodi'] ?? '';
$deskripsi = $_POST['deskripsi'] ?? '';

// Validasi data
$errors = [];

if (strlen($nim) < 8 || !is_numeric($nim)) {
    $errors[] = "NIM harus berupa angka dan minimal 8 karakter.";
}

if (!preg_match("/^[a-zA-Z\s]+$/", $nama)) {
    $errors[] = "Nama hanya boleh mengandung huruf dan spasi.";
}

if (empty($prodi)) {
    $errors[] = "Program studi harus dipilih.";
}

if (!empty($deskripsi) && strlen($deskripsi) < 10) {
    $errors[] = "Deskripsi harus lebih dari 10 karakter jika diisi.";
}

// Jika ada error, tampilkan pesan
if (!empty($errors)) {
    echo "<h3>Terdapat kesalahan:</h3><ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul><a href='javascript:history.back();'>Kembali ke Form</a>";
    exit;
}

// Jika validasi berhasil, lanjutkan ke penyimpanan database
?>
