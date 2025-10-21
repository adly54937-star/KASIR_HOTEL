<?php
include 'koneksi.php';

if (isset($_GET['id_kamar'])) {
    $id_kamar = $_GET['id_kamar'];
    $query = mysqli_query($koneksi, "SELECT harga_per_malam FROM kamar WHERE id_kamar='$id_kamar'");
    $data = mysqli_fetch_assoc($query);
    echo $data ? $data['harga_per_malam'] : 0;
}
?>