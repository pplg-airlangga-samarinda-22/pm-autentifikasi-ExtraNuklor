<?php
session_start();
require_once "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM petugas WHERE id_petugas=?";
    $row = $koneksi->execute_query($sql, [$id])->fetch_assoc();

    $username = $row['username'];
    $nama = $row['nama_petugas'];
    $password = $row['password'];
    $telepon = $row['telp'];
    $level = $row['level'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $level = $_POST['level'];

    $sql = "UPDATE petugas SET nama_petugas=?, telp=?, level=? WHERE id_petugas=?";
    $row = $koneksi->execute_query($sql, [$nama, $telepon, $level, $id]);

    if ($row) {
        header("location:petugas.php");
    } else {
        echo "<script>alert('Gagal memperbarui petugas');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Petugas</title>
</head>
<body>
    <h1>Edit Petugas</h1>
    <form action="" method="post">
        <div class="form-item">
            <label for="level">Level Akses</label>
            <select name="level" id="level">
                <option value="admin" <?php if ($level == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="petugas" <?php if ($level == 'petugas') echo 'selected'; ?>>Petugas</option>
            </select>
        </div>
        <div class="form-item">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?php echo $nama; ?>">
        </div>
        <div class="form-item">
            <label for="telepon">Telepon</label>
            <input type="tel" name="telepon" id="telepon" value="<?php echo $telepon; ?>">
        </div>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>" disabled>
        </div>
        <button type="submit">Kirim</button>
        <a href="petugas.php">Batal</a>
    </form>
</body>
</html>