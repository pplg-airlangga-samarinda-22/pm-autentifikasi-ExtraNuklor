<?php

session_start();
require "../koneksi.php";
if (empty($_SESSION['level'])) {
    header("location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan Pengaduan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            /* Light background */
            color: #333;
            /* Darker text for contrast */
            line-height: 1.6;
        }

        header {
            background-color: #4CAF50;
            /* Green header */
            color: white;
            padding: 20px 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0;
            font-size: 2rem;
        }

        /* Navigation Bar */
        nav {
            background-color: #ffffff;
            /* White background for the navbar */
            border-top: 3px solid #4CAF50;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .nav-links {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-links li {
            margin: 0 15px;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            /* Dark text for links */
            font-size: 1rem;
            padding: 10px 15px;
            transition: color 0.3s, background-color 0.3s;
            border-radius: 5px;
        }

        .nav-links a:hover {
            color: white;
            background-color: #4CAF50;
            /* Green background on hover */
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
            background-color: #f1f1f1;
            /* Light gray footer */
            color: #666;
            font-size: 0.9rem;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <header>
        <h1>Selamat Datang di Sistem Pengaduan Masyarakat</h1>
    </header>

    <nav>
        <ul class="nav-links">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="../pengaduan/pengaduan.php">Pengaduan</a></li>
            <li><a href="../masyarakat/masyarakat.php">Masyarakat</a></li>

            <?php if ($_SESSION['level'] === 'admin') { ?>
                <li><a href="../petugas/petugas.php">Petugas</a></li>
            <?php } ?>

            <li><a href="../laporan.php">Laporan</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <footer>
        <p>&copy; 2025 Sistem Pengaduan Masyarakat. All rights reserved.</p>
    </footer>
</body>

</html>