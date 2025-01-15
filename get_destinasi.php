<?php
$connection = new mysqli("localhost", "root", "", "tiket_pesawat");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipe = $_POST['tipe'];
    $query = "";

    if ($tipe === "domestik") {
        $query = "SELECT DISTINCT destinasi FROM penerbangan WHERE tipe = 'domestik'";
    } else if ($tipe === "international") {
        $query = "SELECT DISTINCT destinasi FROM penerbangan WHERE tipe = 'international'";
    }

    $result = $connection->query($query);
    $options = "<option value=''>Pilih Destinasi</option>";

    while ($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row['destinasi'] . "'>" . $row['destinasi'] . "</option>";
    }

    echo $options;
}
?>
