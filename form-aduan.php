<?php
session_start();
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    var_dump($_POST);
    $tanggal = date('Y-m-d');
    $nik = $_SESSION['nik'];
    $laporan = $_POST['laporan'];
    $foto = (isset($_FILES['foto'])) ? $_FILES['foto']['name'] : "";
    $status = 0;

    $sql = "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status) values (?, ?, ?, ?, ?)";
    $row = $koneksi->execute_query($sql, [$tanggal, $nik, $laporan, $foto, $status]);

    if (!empty($foto)) {
        move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/' . $_FILES['foto']['name']);
    }

    if ($koneksi) {
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
    <title>Tambah Aduan</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #121212;
            /* Spotify's dark background */
            color: #FFFFFF;
            /* White text for contrast */
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            color: #1DB954;
            /* Spotify's signature green */
            margin-top: 20px;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1E1E1E;
            /* Slightly lighter background for forms */
            border-radius: 10px;
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
            width: 90%;
            padding: 12px;
            border: 1px solid #444444;
            /* Subtle border for inputs */
            border-radius: 5px;
            background-color: #333333;
            /* Input background */
            color: #FFFFFF;
            /* Input text color */
            font-size: 1rem;
            outline: none;
            transition: border 0.3s;
        }

        textarea {
            height: 120px;
            resize: none;
            /* Disable resizing */
        }

        textarea:focus,
        input[type="file"]:focus {
            border-color: #1DB954;
            /* Spotify green focus */
        }

        button {
            background-color: #1DB954;
            /* Spotify green */
            color: #FFFFFF;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s, transform 0.2s;
            display: block;
            margin: 20px auto;
            width: 100%;
        }

        button:hover {
            background-color: #14833B;
            /* Darker green on hover */
            transform: scale(1.03);
            /* Slight zoom effect */
        }

        a {
            color: #1DB954;
            text-decoration: none;
            font-size: 1rem;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            form {
                padding: 15px;
            }

            button {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <h1>Tambah Aduan</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-item">
            <label for="laporan">Isi Laporan</label>
            <textarea name="laporan" id="laporan"></textarea>
        </div>
        <div class="form-item">
            <label for="foto">Foto Pendukung</label>
            <input type="file" name="foto" id="foto">
        </div>
        <button type="submit">Kirim Laporan</button>
        <br>
        <a href="index.php">Kembali</a>
    </form>
</body>

</html>