<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Input Data Mahasiswa</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2b2b2b, #4e4e4e);
            color: #ecf0f1;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 1px;
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            background: #444;
            color: #ecf0f1;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #555;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background: #333;
        }

        tr:hover {
            background: #555;
        }

        td {
            border-bottom: 1px solid #666;
        }

        tr:last-child td {
            border-bottom: none;
        }
    </style>
</head>
<body>

    <h1>Hasil Input Data Mahasiswa</h1>

    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('koneksi.php');

            $sql = "SELECT * FROM mahasiswa";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['prodi']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['deskripsi']) . "</td>";
                    echo "</tr>";
                }
            }else {
                echo "<tr><td colspan='4'>Tidak ada data mahasiswa.</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>

    <script>
        const params = new URLSearchParams(window.location.search);

        document.getElementById('nimOutput').textContent = params.get('nim');
        document.getElementById('namaOutput').textContent = params.get('nama');
        document.getElementById('prodiOutput').textContent = params.get('prodi');
        document.getElementById('deskripsiOutput').textContent = params.get('deskripsi');
    </script>

</body>
</html>
