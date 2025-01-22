<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: index.php');
}

// Ambil daftar pengaduan
$query = "SELECT * FROM pengaduan WHERE status='0'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            background-color: #1c1c1e;
            color: #fff;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #fff;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            align-items: flex-start;
        }

        .box {
            padding: 20px;
            background-color: #2c2c2e;
            border-radius: 10px;
            margin-right: 20px;
        }

        .box a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            background-color: #1db954;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .box a:hover {
            background-color: #1ed760;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            background-color: #2c2c2e;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            color: #fff;
            border-bottom: 1px solid #444;
        }

        th {
            background-color: #323232;
            color: #b3b3b3;
        }

        td img {
            border-radius: 8px;
            border: 2px solid #444;
        }

        tr:hover {
            background-color: #3e3e40;
        }

        a {
            text-decoration: none;
            background-color: #1db954;
            color: #fff;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #1ed760;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            table, th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h2>Daftar Permintaan Masyarakat Beban</h2>

    <div class="container">
        <!-- Box on the left with buttons -->
        <div class="box">
            <a href="register_petugas.php">Tambah Petugas</a>
            <a href="register_masyarakat.php">Tambah Masyarakat</a>
        </div>

        <!-- Table of pengaduan -->
        <table>
            <tr>
                <th>NIK</th>
                <th>Isi Laporan</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['nik'] ?></td>
                <td><?= $row['isi_laporan'] ?></td>
                <td><img src="uploads/<?= $row['foto'] ?>" width="100"></td>
                <td><?= $row['status'] ?></td>
                <td><a href="proses_tanggapan.php?id_pengaduan=<?= $row['id_pengaduan'] ?>">Tanggapi</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
