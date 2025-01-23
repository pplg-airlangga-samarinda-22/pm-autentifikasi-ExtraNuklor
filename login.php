<?php
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Menggunakan prepare statement untuk keamanan
    $sql = "SELECT * FROM masyarakat WHERE nik = ? AND username = ? AND password = ?";
    $row = $koneksi->execute_query($sql, [$nik, $username, $password]);
    

    if (mysqli_num_rows($row) == 1) {
        session_start();
        $_SESSION['nik'] = $nik;
        header("Location:index.php");
    } else {
        echo "<script>alert('Gagal Login!')</script>";
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
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'JetBrains Mono', monospace;
            background-color: #2b2b2b;
            color: #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-login {
            background-color: #424242;
            padding: 2rem;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-login p {
            font-size: 24px;
            color: #fff;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-item {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            font-size: 14px;
            color: #a1a1a1;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            font-size: 16px;
            border: 1px solid #555;
            border-radius: 4px;
            background-color: #333;
            color: #ccc;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #8d8d8d;
        }

        button {
            width: 100%;
            padding: 0.8rem;
            font-size: 16px;
            color: #fff;
            background-color: #0061f2;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #004bb5;
        }

        a {
            display: block;
            color: #4c9bf5;
            text-decoration: none;
            margin-top: 1rem;
            text-align: center;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Mobile Optimization */
        @media (max-width: 600px) {
            .form-login {
                padding: 1.5rem;
            }

            .form-login p {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <form action="" method="post" class="form-login">
        <p>Silahkan Login</p>
        <div class="form-item">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" required>
        </div>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Login</button>
        <a href="register.php">Register</a>
        <a href="./admin/login.php">Login Sebagai Administrator / Petugas</a>     
    </form>
</body>

</html>
