<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nik = $_SESSION['nik'];
    $isi_laporan = $_POST['isi_laporan'];
    $foto = $_FILES['foto']['name'];
    $tgl_pengaduan = date('Y-m-d');

    // Upload foto jika ada
    if ($foto) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
    }

    // Insert ke database
    $query = "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status) 
              VALUES ('$tgl_pengaduan', '$nik', '$isi_laporan', '$foto', '0')";
    mysqli_query($conn, $query);

    header('Location: dashboard.php');
}
?>
