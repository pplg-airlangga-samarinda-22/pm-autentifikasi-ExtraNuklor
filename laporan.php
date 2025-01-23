<?php
session_start();
require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f8;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 2rem;
            color: #004085;
            flex: 1;    
            text-align: center;
        }
        .header a {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }
        .header a:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table thead {
            background-color: #004085;
            color: white;
        }
        table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table tbody tr:nth-child(odd) {
            background-color: #e9ecef;
        }
        table tbody tr:hover {
            background-color: #d1ecf1;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
        }
        .btn-back:hover {
            background-color: #218838;
        }

        @media print {
            body {
                background-color: white;
                color: black;
            }
            .header a {
                display: none;
            }
            table thead {
                background-color: #004085 !important;
                color: white !important;
                -webkit-print-color-adjust: exact; /* Maintain colors during printing */
            }
            table tbody tr:nth-child(even),
            table tbody tr:nth-child(odd),
            table tbody tr:hover {
                -webkit-print-color-adjust: exact;
            }
            .btn-back {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Pengaduan</h1>
            <a href="javascript:window.print();">Cetak</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>NIK Pelapor</th>
                    <th>Isi Laporan</th>
                    <th>Petugas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 0;
                $sql = "SELECT 
                            p.tgl_pengaduan, 
                            p.nik, 
                            p.isi_laporan, 
                            p.status, 
                            m.nama AS nama_pelapor, 
                            pt.nama_petugas
                        FROM pengaduan p
                        INNER JOIN masyarakat m ON p.nik = m.nik
                        LEFT JOIN tanggapan t ON p.id_pengaduan = t.id_pengaduan
                        LEFT JOIN petugas pt ON t.id_petugas = pt.id_petugas";
                $rows = $koneksi->execute_query($sql)->fetch_all(MYSQLI_ASSOC);
                foreach($rows as $row) {
                    ?>
                    <tr>
                        <td><?= ++$no ?></td>
                        <td><?= $row['nama_pelapor'] ?></td>
                        <td><?= $row['tgl_pengaduan'] ?></td>
                        <td><?= $row['nik'] ?></td>
                        <td><?= $row['isi_laporan'] ?></td>
                        <td><?= $row['nama_petugas'] ?></td>
                        <td>
                            <?= ($row['status'] == 0) ? 'Menunggu' : (($row['status'] == 'proses') ? 'Diproses' : 'Selesai') ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="admin/index.php" class="btn-back">Kembali</a>
    </div>
</body>
</html>
