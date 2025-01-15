<?php
$connection = new mysqli("localhost", "root", "", "tiket_pesawat");

// Fetch data
$penerbangan = $connection->query("SELECT * FROM penerbangan");
$pemesanan = $connection->query("SELECT * FROM pemesanan");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Data Penerbangan</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tipe</th>
            <th>Destinasi</th>
            <th>Tanggal</th>
            <th>Pesawat</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $penerbangan->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['tipe'] ?></td>
                <td><?= $row['destinasi'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['pesawat'] ?></td>
                <td><?= $row['harga'] ?></td>
                <td>
                <a href="edit_penerbangan.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_penerbangan.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <h2>Data Pemesanan</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor HP</th>
            <th>Tipe</th>
            <th>Destinasi</th>
            <th>Tanggal</th>
            <th>Pesawat</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $pemesanan->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nama_pemesan'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['nomor_hp'] ?></td>
                <td><?= $row['tipe_penerbangan'] ?></td>
                <td><?= $row['destinasi'] ?></td>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['pesawat'] ?></td>
                <td>
                    <a href="delete_pemesanan.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
