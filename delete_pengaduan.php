<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nik'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id_pengaduan'])) {
    $id_pengaduan = $_GET['id_pengaduan'];
    $nik = $_SESSION['nik'];

    // Check if the pengaduan exists and belongs to the current user
    $check_query = "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan' AND status = '0'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // If the pengaduan exists, delete it
        $delete_query = "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'";
        if (mysqli_query($conn, $delete_query)) {
            echo "<script>alert('Pengaduan berhasil dihapus.'); window.location.href = 'dashboard.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menghapus pengaduan.'); window.location.href = 'dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('Pengaduan Yang Sudah Diproses Tidak bisa dihapus'); window.location.href = 'dashboard.php';</script>";
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>
