<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_petugas'])) {
    header('Location: index.php');
}

if (isset($_GET['id_pengaduan'])) {
    $id_pengaduan = $_GET['id_pengaduan'];
    $id_petugas = $_SESSION['id_petugas'];
    $tgl_tanggapan = date('Y-m-d');
    $tanggapan = $_POST['tanggapan'];

    // Insert tanggapan
    $query = "INSERT INTO tanggapan (id_pengaduan, id_petugas, tgl_tanggapan, tanggapan) 
              VALUES ('$id_pengaduan', '$id_petugas', '$tgl_tanggapan', '$tanggapan')";
    mysqli_query($conn, $query);

    // Update status pengaduan
    $query = "UPDATE pengaduan SET status='proses' WHERE id_pengaduan='$id_pengaduan'";
    mysqli_query($conn, $query);

    header('Location: admin.php');
}
?>
