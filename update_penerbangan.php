<?php
$connection = new mysqli("localhost", "root", "", "tiket_pesawat");

// Periksa apakah data di-submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $tipe = $_POST['tipe'];
    $destinasi = $_POST['destinasi'];
    $tanggal = $_POST['tanggal'];
    $pesawat = $_POST['pesawat'];
    $harga = $_POST['harga'];

    // Query untuk update data
    $query = "UPDATE penerbangan SET 
                tipe = '$tipe', 
                destinasi = '$destinasi', 
                tanggal = '$tanggal', 
                pesawat = '$pesawat', 
                harga = '$harga' 
              WHERE id = $id";

    if ($connection->query($query) === TRUE) {
        header("Location: admin.php?message=Data berhasil diperbarui");
        exit();
    } else {
        echo "Error: " . $connection->error;
    }
}
?>
