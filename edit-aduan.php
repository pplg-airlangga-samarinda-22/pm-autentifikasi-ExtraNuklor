<?php
session_start();
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id_pengaduan = $_GET["id"];

    $sql = "SELECT * FROM pengaduan where id_pengaduan=?";
    $row = $koneksi->execute_query($sql, [$id_pengaduan])->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] = "POST") {
    $tanggal = date('Y-m-d');
    $id_pengaduan = $_GET["id"];
    $laporan = $_POST["laporan"];
    $foto = (isset($_FILES['foto'])) ? $_FILES['foto']['name'] : "";

    $sql = "UPDATE pengaduan SET tgl_pengaduan=?, isi_laporan=?, foto=? WHERE id_pengaduan=?";
    $row = $koneksi->execute_query($sql, [$tanggal, $laporan, $foto, $id_pengaduan]);

    if (!empty($foto)) {
        move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/' . $_FILES['foto']['name']);
    }
    if ($row) {
        echo "<script>alert('Pengaduan baru telah berhasil disimpan!')</script>";
        header("location:aduan.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #121212;
            /* Spotify's dark background */
            color: #FFFFFF;
            /* White text for contrast */
        }

        h1 {
            text-align: center;
            color: #1DB954;
            /* Spotify's signature green */
            margin-top: 20px;
            font-size: 2.5rem;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            background-color: #1E1E1E;
            /* Slightly lighter background for forms */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.7);
        }

        .form-item {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #BBBBBB;
            /* Subtle text for labels */
        }

        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #333333;
            /* Input background */
            color: #FFFFFF;
            /* Input text color */
            font-size: 1rem;
        }

        textarea {
            height: 100px;
            resize: none;
            /* Disable resizing */
        }

        button {
            background-color: #1DB954;
            /* Spotify green */
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #14833B;
            /* Darker green on hover */
        }

        a {
            color: #1DB954;
            text-decoration: none;
            font-size: 1rem;
        }

        a:hover {
            text-decoration: underline;
        }

        img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <h1>Edit Aduan</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-item">
            <label for="laporan">Isi laporan</label>
            <textarea name="laporan" id="laporan"><?= $row["isi_laporan"] ?></textarea>
        </div>
        <div class="form-item">
            <label for="foto">Foto Pendukung</label>
            <img src="gambar/<?= $row["foto"] ?>" alt=""><br>
            <input type="file" name="foto" id="foto"><br><br>
        </div>
        <button type="submit">Kirim Laporan</button>
        <a href="aduan.php">Batal</a>
    </form>
</body>

</html>