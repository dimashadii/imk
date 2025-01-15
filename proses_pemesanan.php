<?php
$connection = new mysqli("localhost", "root", "", "tiket_pesawat");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nomor_hp = $_POST['nomor_hp'];
    $tipe = $_POST['tipe'];
    $destinasi = $_POST['destinasi'];
    $tanggal = $_POST['tanggal'];
    $pesawat = $_POST['pesawat'];

    $query = "INSERT INTO pemesanan (nama_pemesan, email, nomor_hp, tipe_penerbangan, destinasi, tanggal, pesawat) 
              VALUES ('$nama', '$email', '$nomor_hp', '$tipe', '$destinasi', '$tanggal', '$pesawat')";

    if ($connection->query($query)) {
        echo "Pemesanan berhasil!";
        echo "<br><a href='index.php'>Kembali ke halaman utama</a>";
    } else {
        echo "Error: " . $connection->error;
    }
}
?>
