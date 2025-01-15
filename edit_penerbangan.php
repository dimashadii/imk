<?php
$connection = new mysqli("localhost", "root", "", "tiket_pesawat");

// Periksa apakah ID ada
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data berdasarkan ID
    $query = "SELECT * FROM penerbangan WHERE id = $id";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penerbangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Data Penerbangan</h2>
    <form action="update_penerbangan.php" method="post">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Penerbangan</label>
            <select class="form-select" id="tipe" name="tipe" required>
                <option value="domestik" <?= $data['tipe'] === 'domestik' ? 'selected' : '' ?>>Domestik</option>
                <option value="international" <?= $data['tipe'] === 'international' ? 'selected' : '' ?>>International</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="destinasi" class="form-label">Destinasi</label>
            <input type="text" class="form-control" id="destinasi" name="destinasi" value="<?= $data['destinasi'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $data['tanggal'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="pesawat" class="form-label">Pesawat</label>
            <input type="text" class="form-control" id="pesawat" name="pesawat" value="<?= $data['pesawat'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?= $data['harga'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="admin.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
