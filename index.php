<?php
// Koneksi ke database
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "nama_database";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }
}

// Kelas Mahasiswa
class Mahasiswa {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Metode untuk menyimpan data mahasiswa
    public function simpanData($nim, $nama, $prodi, $deskripsi, $browser, $ip_address) {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (nim, nama, prodi, deskripsi, browser, ip_address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nim, $nama, $prodi, $deskripsi, $browser, $ip_address);

        if ($stmt->execute()) {
            return "Data berhasil disimpan.";
        } else {
            return "Gagal menyimpan data: " . $this->db->error;
        }
    }

    // Metode untuk menampilkan semua data mahasiswa
    public function tampilkanData() {
        $result = $this->db->query("SELECT * FROM mahasiswa");
        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }
}

// Inisialisasi koneksi database dan objek Mahasiswa
$db = (new Database())->conn;
$mahasiswa = new Mahasiswa($db);

// Contoh penggunaan:
// Simpan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $deskripsi = $_POST['deskripsi'];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    echo $mahasiswa->simpanData($nim, $nama, $prodi, $deskripsi, $browser, $ip_address);
}

// Tampilkan data
$dataMahasiswa = $mahasiswa->tampilkanData();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Deskripsi</th>
            <th>Browser</th>
            <th>IP Address</th>
        </tr>
        <?php foreach ($dataMahasiswa as $mhs): ?>
        <tr>
            <td><?= htmlspecialchars($mhs['nim']); ?></td>
            <td><?= htmlspecialchars($mhs['nama']); ?></td>
            <td><?= htmlspecialchars($mhs['prodi']); ?></td>
            <td><?= htmlspecialchars($mhs['deskripsi']); ?></td>
            <td><?= htmlspecialchars($mhs['browser']); ?></td>
            <td><?= htmlspecialchars($mhs['ip_address']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
