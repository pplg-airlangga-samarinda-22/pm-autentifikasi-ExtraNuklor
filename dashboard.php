<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nik'])) {
    header('Location: index.php');
}

$nik = $_SESSION['nik'];

// Ambil pengaduan masyarakat
$query = "SELECT * FROM pengaduan WHERE nik='$nik'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Pengaduan Saya</h2>
    <table border="1">
        <tr>
            <th>Tanggal</th>
            <th>Isi Laporan</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['tgl_pengaduan'] ?></td>
            <td><?= $row['isi_laporan'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <h2>Buat Pengaduan Baru</h2>
    <form action="proses_pengaduan.php" method="POST" enctype="multipart/form-data">
        <textarea name="isi_laporan" placeholder="Isi laporan" required></textarea><br>
        <input type="file" name="foto"><br>
        <button type="submit" name="submit">Kirim Pengaduan</button>
    </form>
</body>
</html>
