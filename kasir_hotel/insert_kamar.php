<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_hotel");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "INSERT INTO kamar (nama_kamar, tipe, harga_per_malam) VALUES
('Deluxe', 'VIP', 500000),
('Standard', 'Reguler', 300000),
('Suite', 'Luxury', 800000)";

if (mysqli_query($koneksi, $query)) {
    echo "Data kamar berhasil dimasukkan ke database!";
} else {
    echo "Gagal menambahkan data: " . mysqli_error($koneksi);
}
?>