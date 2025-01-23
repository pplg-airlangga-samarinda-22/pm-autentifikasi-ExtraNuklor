<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pengaduan</title>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'JetBrains Mono', monospace;
            background-color: #1e1e1e;
            /* Dark background */
            color: #f5f5f5;
            /* Light text */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Heading style */
        h1 {
            color: #ff3b30;
            /* JetBrains Red */
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        /* Box container for buttons */
        .button-box {
            display: flex;
            justify-content: center;
            width: 80%;
            margin-bottom: 20px;
            background-color: #2d2d2d;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }

        /* Button styling */
        .button-box a {
            display: inline-block;
            background-color: #ff3b30;
            /* JetBrains Red */
            color: #f5f5f5;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            margin-right: 10px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-box a:hover {
            background-color: #e01b22;
            /* Darker red on hover */
        }

        /* Table styling */
        table {
            width: 80%;
            border-collapse: collapse;
            background-color: #2d2d2d;
            /* Darker background for table */
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        }

        /* Table header styling */
        th {
            background-color: #ff3b30;
            /* Red background */
            color: #f5f5f5;
            /* Light text */
            padding: 10px;
            text-align: left;
        }

        /* Table cell styling */
        td {
            background-color: #333;
            /* Dark background for cells */
            color: #f5f5f5;
            /* Light text */
            padding: 10px;
            border-bottom: 1px solid #444;
            /* Border between rows */
        }

        /* Table row on hover */
        tr:hover {
            background-color: #444;
            /* Darker row color on hover */
        }

        /* Table action column (Edit) link */
        td a {
            color: #ff3b30;
            text-decoration: none;
        }

        td a:hover {
            color: #e01b22;
            /* Darker red on hover */
        }
    </style>
</head>

<body>
<?php
    session_start();
    require "koneksi.php";
?>

    <h1>Halaman Pengaduan</h1>

    <!-- Box for "Tambah" and "Kembali" buttons -->
    <div class="button-box">
        <a href="form-aduan.php">Tambah</a>
        <a href="index.php">Kembali</a>
    </div>

    <!-- Table displaying pengaduan data -->
    <table>
        <thead>
            <th>No</th>
            <th>Tanggal</th>                                                                                                                                                                                                                                                                                                                                                                                                                                                            
            <th>Laporan</th>
            <th>Status</th>
            <th>Aksi</th>
        </thead>

        <tbody>
            <?php 
                $nik = $_SESSION['nik'];
                $no = 0;
                $sql = "SELECT * FROM pengaduan WHERE nik=? ORDER BY id_pengaduan DESC";
                $pengaduan = $koneksi->execute_query($sql, [$nik])->fetch_all(MYSQLI_ASSOC);
                foreach ($pengaduan as $item) {
            ?>        
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $item['tgl_pengaduan']; ?></td>
                <td><?= $item['isi_laporan']; ?></td>
                <td><?= ($item['status'] == '0')?'menunggu':(($item['status'] == 'proses')?'diproses':'selesai') ?></td>
                <td><a href='edit-aduan.php?id=<?=$item['id_pengaduan']?>'>Edit</a></td>
            </tr>
            <?php    
                }
            ?>
        </tbody>
    </table>
</body>

</html>