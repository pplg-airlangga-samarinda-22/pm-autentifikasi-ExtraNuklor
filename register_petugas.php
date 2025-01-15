<?php
session_start();
include 'koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    echo "Hanya admin yang dapat mendaftarkan petugas.";
    exit();
}

if (isset($_POST['register'])) {
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password
    $telp = $_POST['telp'];
    $level = $_POST['level'];

    // Cek apakah username sudah digunakan
    $check_query = "SELECT * FROM petugas WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Username sudah digunakan!";
    } else {
        // Insert data petugas baru
        $query = "INSERT INTO petugas (nama_petugas, username, password, telp, level) 
                  VALUES ('$nama_petugas', '$username', '$password', '$telp', '$level')";
        if (mysqli_query($conn, $query)) {
            echo "Petugas berhasil didaftarkan!";
            header('Location: admin.php');
        } else {
            echo "Gagal mendaftarkan petugas. Kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Petugas</title>
</head>
<body>
    <h2>Register Petugas</h2>
    <form action="" method="POST">
        <label>Nama Petugas:</label><br>
        <input type="text" name="nama_petugas" maxlength="35" required><br>

        <label>Username:</label><br>
        <input type="text" name="username" maxlength="25" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br>

        <label>Telp:</label><br>
        <input type="text" name="telp" maxlength="13" required><br>

        <label>Level:</label><br>
        <select name="level" required>
            <option value="admin">Admin</option>
            <option value="petugas">Petugas</option>
        </select><br>

        <button type="submit" name="register">Register Petugas</button>
    </form>
</body>
</html>
