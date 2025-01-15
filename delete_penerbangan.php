<?php
// Koneksi ke database
$connection = new mysqli("localhost", "root", "", "tiket_pesawat");

// Periksa apakah ada parameter ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $query = "DELETE FROM penerbangan WHERE id = $id";

    if ($connection->query($query) === TRUE) {
        header("Location: admin.php?message=Data berhasil dihapus");
        exit();
    } else {
        echo "Error: " . $connection->error;
    }
}
?>
