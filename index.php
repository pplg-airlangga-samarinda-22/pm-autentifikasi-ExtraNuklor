<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Cek masyarakat
    $query = "SELECT * FROM masyarakat WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['nik'] = $user['nik'];
        $_SESSION['role'] = 'masyarakat';
        header('Location: dashboard.php');
    } else {
        // Cek petugas
        $query = "SELECT * FROM petugas WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);
        $petugas = mysqli_fetch_assoc($result);

        if ($petugas) {
            $_SESSION['id_petugas'] = $petugas['id_petugas'];
            $_SESSION['role'] = $petugas['level']; // admin atau petugas
            header('Location: admin.php');
        } else {
            echo "Login gagal, username atau password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
        <br><br>
        <a href="register_masyarakat.php">Belum punya akun? Daftar di sini</a>
    </form>
</body>
</html>
