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
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #a9b7c6;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            color: #a9b7c6;
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
    </style>
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
