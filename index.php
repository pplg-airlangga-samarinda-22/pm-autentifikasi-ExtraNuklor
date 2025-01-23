<?php
session_start();
require_once "koneksi.php";
if (empty($_SESSION['nik'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan Pengaduan</title>
    <style>
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
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            font-size: 28px;
            color: #fff;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        nav {
            display: flex;
            gap: 20px;
            margin-top: 1.5rem;
        }

        nav a {
            font-size: 16px;
            color: #4c9bf5;
            text-decoration: none;
            padding: 0.8rem 1.2rem;
            border-radius: 5px;
            background-color: #424242;
            transition: background-color 0.3s, color 0.3s;
        }

        nav a:hover {
            background-color: #0061f2;
            color: #fff;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 24px;
            }

            nav {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <h1>Selamat Datang di Aplikasi Pengaduan Masyarakat</h1>
    <nav>
        <a href="index.php">Dashboard</a>
        <a href="aduan.php">Aduan</a>
        <a href="logout.php">Logout</a>
    </nav>
</body>

</html>
