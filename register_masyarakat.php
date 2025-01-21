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
            display: flex;
            flex-direction: column;
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
    <!-- Optional: Adding JetBrains Mono Font -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h2>Register Masyarakat</h2>
    <form action="" method="POST">
        <label for="nik">NIK:</label>
        <input type="text" id="nik" name="nik" maxlength="16" required>

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" maxlength="35" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" maxlength="25" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="telp">Telp:</label>
        <input type="text" id="telp" name="telp" maxlength="13" required>

        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>
