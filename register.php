<?php
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nik = $_POST['nik'];

    $sql = "SELECT * FROM masyarakat WHERE nik=?";
    $cek = $koneksi->execute_query($sql,[$nik]);

    if (mysqli_num_rows($cek) == 1) {
        echo "<script>alert('NIK Sudah Digunakan!')</script>";
    } else {
        $nama = $_POST['nama'];
        $telepon = $_POST['telepon'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "INSERT INTO masyarakat SET nik=?,nama=?, telp=?,username=?,password=?";
        $koneksi->execute_query($sql,[$nik,$nama,$telepon,$username,$password]);
        echo "<script>alert('Pendaftaran Berhasil)</script>";
        header("location:login.php");
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h1>Registrasi Pengguna baru</h1>
    <form action="" method="post">
        <div class="form-item">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik">
        </div>
        <div class="form-item">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama">
        </div>
        <div class="form-item">
            <label for="nik">Telepon</label>
            <input type="text" name="telepon" id="telepon">
        </div>
        <div class="form-item">
            <label for="nik">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form-item">
            <label for="password">Password</label>
            <input type="text" name="password" id="password">
        </div>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Batal</a>
</body>
</html>