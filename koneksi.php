<?php
$host = 'localhost';  // Sesuaikan dengan konfigurasi host
$user = 'root';       // Sesuaikan dengan user MySQL Anda
$pass = '';           // Jika ada password, masukkan di sini
$db   = 'pengaduan_masyarakat';  // Sesuaikan dengan nama database Anda

try {
    // Membuat koneksi
    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        throw new Exception("Koneksi database gagal: " . mysqli_connect_error());
    }

} catch (Exception $e) {
    // Menangkap dan menampilkan pesan kesalahan
    echo "Error: " . $e->getMessage();
    exit();
}
