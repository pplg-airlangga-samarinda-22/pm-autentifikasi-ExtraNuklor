<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pengaduan</title>
</head>
<body>
<?php
    session_start();
    require "koneksi.php";
?>

    <h1>Halaman Pengaduan</h1>
    <a href="form-aduan.php">tambah</a>
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
                $no=0;
                $sql = "SELECT * FROM pengaduan WHERE nik=? order by id_pengaduan desc";
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
    <a href="index.php">Kembali</a>
</body>
</html>
