<?php
session_start();
if (!isset($_SESSION['kasir'])) {
    header("Location: login.php");
    exit;
}

$koneksi = mysqli_connect("localhost", "root", "", "db_hotel");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Transaksi</title>
  <style>
    body { font-family: 'Poppins', sans-serif; background: #fafafa; padding: 30px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
    th { background: #17a2b8; color: white; }
  </style>
</head>
<body>
  <h2>Laporan Transaksi Hotel</h2>
  <table>
    <tr><th>ID</th><th>Nama Tamu</th><th>Kamar</th><th>Lama Menginap</th><th>Total Bayar</th><th>Tanggal</th></tr>
    <?php
      $result = mysqli_query($koneksi, "SELECT t.*, k.nama_kamar FROM transaksi t JOIN kamar k ON t.id_kamar=k.id_kamar");
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                <td>{$row['id_transaksi']}</td>
                <td>{$row['nama_tamu']}</td>
                <td>{$row['nama_kamar']}</td>
                <td>{$row['lama_menginap']} hari</td>
                <td>Rp " . number_format($row['total_bayar'], 0, ',', '.') . "</td>
                <td>{$row['tanggal']}</td>
              </tr>";
      }
    ?>
  </table>
  <br>
  <a href="dashboard.php">⬅ Kembali</a>
</body>
</html>
