<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password
    $telp = $_POST['telp'];

    // Cek apakah username atau NIK sudah digunakan
    $check_query = "SELECT * FROM masyarakat WHERE nik='$nik' OR username='$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "NIK atau Username sudah digunakan!";
    } else {
        // Insert data masyarakat baru
        $query = "INSERT INTO masyarakat (nik, nama, username, password, telp) 
                  VALUES ('$nik', '$nama', '$username', '$password', '$telp')";
        if (mysqli_query($conn, $query)) {
            echo "Pendaftaran berhasil! Silakan login.";
            header('Location: index.php');
        } else {
            echo "Gagal mendaftarkan masyarakat. Kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Masyarakat</title>
</head>
<body>
    <h2>Register Masyarakat</h2>
    <form action="" method="POST">
        <label>NIK:</label><br>
        <input type="text" name="nik" maxlength="16" required><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" maxlength="35" required><br>

        <label>Username:</label><br>
        <input type="text" name="username" maxlength="25" required><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br>

        <label>Telp:</label><br>
        <input type="text" name="telp" maxlength="13" required><br>

        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>
