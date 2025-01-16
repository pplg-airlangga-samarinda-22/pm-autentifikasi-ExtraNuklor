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
    <style>
        /* JetBrains-inspired styling */
        body {
            background-color: #2b2b2b;
            font-family: 'JetBrains Mono', monospace;
            color: #dcdcdc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #3c3f41;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #a9b7c6;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #2b2b2b;
            border: 1px solid #616161;
            border-radius: 4px;
            color: #dcdcdc;
            box-sizing: border-box;
        }

        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: #7e8e91;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #6897bb;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4e94ce;
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #3e82b0;
        }

        a {
            color: #a9b7c6;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin-top: 15px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #6897bb;
        }

        /* Icon styling (optional, for a JetBrains-like visual aesthetic) */
        button::before {
            content: url('https://img.icons8.com/ios-filled/20/ffffff/login-rounded-right.png');
            margin-right: 8px;
        }
    </style>
    <!-- Optional: Adding JetBrains Mono Font -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <form method="POST">
        <h2>Login Dulu Le</h2>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Menuju Dimensi Berbeda</button>
        <br><br>
        <a href="register_masyarakat.php">Belum punya Skibidi? Daftar di sini</a>
    </form>
</body>
</html>
