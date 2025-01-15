<?php
$connection = new mysqli("localhost", "root", "", "tiket_pesawat");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tanggal = $_POST['tanggal'];
    $query = "SELECT DISTINCT pesawat FROM penerbangan WHERE tanggal = '$tanggal'";

    $result = $connection->query($query);
    $options = "<option value=''>Pilih Pesawat</option>";

    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['pesawat'] . "'>" . $row['pesawat'] . "</option>";
    }

    echo $options;
}
?>
