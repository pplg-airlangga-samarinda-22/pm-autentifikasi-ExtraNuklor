<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nik'])) {
    header('Location: index.php');
}

$nik = $_SESSION['nik'];

if (isset($_GET['id_pengaduan'])) {
    $id_pengaduan = $_GET['id_pengaduan'];
    
    // Fetch the specific pengaduan
    $query = "SELECT * FROM pengaduan WHERE id_pengaduan='$id_pengaduan' AND nik='$nik'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $isi_laporan = $row['isi_laporan'];
        $foto = $row['foto'];
    } else {
        echo "Pengaduan not found.";
        exit;
    }
} else {
    header('Location: dashboard.php');
}

if (isset($_POST['update'])) {
    $isi_laporan = $_POST['isi_laporan'];
    
    // Handle file upload if a new image is uploaded
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
    }
    
    // Update query
    $update_query = "UPDATE pengaduan SET isi_laporan='$isi_laporan', foto='$foto' WHERE id_pengaduan='$id_pengaduan' AND nik='$nik'";
    mysqli_query($conn, $update_query);
    
    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaduan</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
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
    </style>
</head>
<body>
    <h2>Edit Laporan</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <textarea name="isi_laporan" required><?= $isi_laporan ?></textarea><br>
        <input type="file" name="foto"><br>
        <button type="submit" name="update">Update Pengaduan</button>
    </form>
</body>
</html>
