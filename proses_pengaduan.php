<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nik = $_SESSION['nik'];
    $isi_laporan = $_POST['isi_laporan'];
    $foto = $_FILES['foto']['name'];
    
    if ($foto) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
    }
    
    // Insert the new pengaduan
    $query = "INSERT INTO pengaduan (nik, isi_laporan, foto, status, tgl_pengaduan) VALUES ('$nik', '$isi_laporan', '$foto', 'pending', NOW())";
    mysqli_query($conn, $query);
    
    header('Location: dashboard.php');
}
?>
