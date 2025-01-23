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

        .table-container {
            width: 80%;
            margin-bottom: 30px;
        }

        /* The main table */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #181818;
            color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
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


        /* Align the buttons to the right side */
        .button-box {
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        /* Button styles */
        .button-box a {
            text-decoration: none;
            background-color: #1db954;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .button-box a:hover {
            background-color: #1ed760;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .table-container {
                width: 95%;
            }
        }

        .form-container {
            width: 100%;
            max-width: 600px;
            background-color: #181818;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            margin: 20px auto;
        }

        /* Heading */
        h2 {
            color: #1db954;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form elements styling */
        .form-group {
            margin-bottom: 20px;
        }

        /* Textarea */
        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #444444;
            border-radius: 5px;
            background-color: #121212;
            color: #ffffff;
            font-size: 14px;
            resize: vertical;
            min-height: 150px;
            transition: border 0.3s ease;
        }

        .form-input:focus {
            border-color: #1db954;
            outline: none;
        }

        /* File input */
        .form-input-file {
            width: 100%;
            padding: 10px;
            background-color: #121212;
            color: #ffffff;
            border: 1px solid #444444;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-input-file:hover {
            background-color: #1db954;
        }

        /* Button */
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #1db954;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #1ed760;
        }
    </style>
    <!-- Optional: Add Spotify-like font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <h2>List Menyulitkan Petugas Saya</h2>
    <div class="table-container">
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Isi Laporan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['tgl_pengaduan'] ?></td>
                    <td><?= $row['isi_laporan'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <div class="button-box">
                            <a href="edit_pengaduan.php?id_pengaduan=<?= $row['id_pengaduan'] ?>">Edit</a>
                            <a href="delete_pengaduan.php?id_pengaduan=<?= $row['id_pengaduan'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
<h2>Buat Cerewetan Baru</h2>
<form action="proses_pengaduan.php" method="POST" enctype="multipart/form-data" class="form-container">
    <div class="form-group">
        <textarea name="isi_laporan" placeholder="Isi laporan" required class="form-input"></textarea>
    </div>
    
    <div class="form-group">
        <input type="file" name="foto" class="form-input-file">
    </div>

    <button type="submit" name="submit" class="submit-btn">Minta bagi Bagi kesulitan</button>
</form>
</body>

</html>