<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nik'])) {
    header('Location: index.php');
}

$nik = $_SESSION['nik'];

// Ambil pengaduan masyarakat
$query = "SELECT * FROM pengaduan WHERE nik='$nik'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Spotify-inspired styling */
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h2 {
            color: #1db954;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background-color: #181818;
            color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #282828;
            color: #b3b3b3;
        }

        tr:nth-child(even) {
            background-color: #2a2a2a;
        }

        tr:hover {
            background-color: #333333;
        }

        textarea {
            width: 80%;
            padding: 10px;
            background-color: #333333;
            border: none;
            border-radius: 8px;
            color: #ffffff;
            margin-bottom: 20px;
            resize: none;
            font-size: 16px;
        }

        textarea::placeholder {
            color: #b3b3b3;
        }

        input[type="file"] {
            margin-bottom: 20px;
            color: #b3b3b3;
        }

        button {
            padding: 10px 20px;
            background-color: #1db954;
            color: #ffffff;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1ed760;
        }

        /* Responsive design for mobile */
        @media (max-width: 768px) {
            table, textarea, button {
                width: 95%;
            }
        }
    </style>
    <!-- Optional: Add Spotify-like font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <h2>List Menyulitkan Petugas Saya</h2>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Isi Laporan</th>
            <th>Status</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['tgl_pengaduan'] ?></td>
            <td><?= $row['isi_laporan'] ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <h2>Buat Cerewetan Baru</h2>
    <form action="proses_pengaduan.php" method="POST" enctype="multipart/form-data">
        <textarea name="isi_laporan" placeholder="Isi laporan" required></textarea><br>
        <input type="file" name="foto"><br>
        <button type="submit" name="submit">Minta bagi Bagi kesulitan</button>
    </form>
</body>
</html>
