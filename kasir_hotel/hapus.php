<?php
include 'koneksi.php';
$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id='$id'");

if ($query) {
    echo "<script>alert('Data berhasil dihapus'); window.location='tampil.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data');</script>";
}
?>
