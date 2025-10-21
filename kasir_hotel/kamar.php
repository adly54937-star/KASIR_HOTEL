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
  <title>Data Kamar</title>
  <style>
    body { font-family: 'Poppins', sans-serif; background: #f1f1f1; padding: 30px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
    th { background: #007bff; color: white; }
    a { text-decoration: none; color: white; background: #007bff; padding: 6px 12px; border-radius: 5px; }
    a:hover { background: #0056b3; }
  </style>
</head>
<body>
  <h2>Data Kamar Hotel</h2>
  <p>Kasir: <?php echo $_SESSION['kasir']; ?></p>
  <table>
    <tr><th>ID</th><th>Nama Kamar</th><th>Tipe</th><th>Harga</th><th>Status</th></tr>
    <?php
      $result = mysqli_query($koneksi, "SELECT * FROM kamar");
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                <td>{$row['id_kamar']}</td>
                <td>{$row['nama_kamar']}</td>
                <td>{$row['tipe']}</td>
                <td>Rp " . number_format($row['harga_per_malam'], 0, ',', '.') . "</td>
                <td>{$row['status']}</td>
              </tr>";
      }
    ?>
  </table>
  <br>
  <a href="dashboard.php">⬅ Kembali</a>
</body>
</html>
