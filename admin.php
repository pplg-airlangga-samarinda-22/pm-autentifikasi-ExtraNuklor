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
</head>
<body>
    <h2>Daftar Pengaduan</h2>
    <table border="1">
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
</body>
</html>
