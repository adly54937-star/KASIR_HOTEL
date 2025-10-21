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

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_tamu'];
    $id_kamar = $_POST['id_kamar'];
    $lama = $_POST['lama_menginap'];

    $getHarga = mysqli_query($koneksi, "SELECT harga_per_malam FROM kamar WHERE id_kamar='$id_kamar'");
    $harga = mysqli_fetch_assoc($getHarga)['harga_per_malam'];
    $total = $harga * $lama;

    mysqli_query($koneksi, "INSERT INTO transaksi (nama_tamu, id_kamar, lama_menginap, total_bayar, tanggal) VALUES ('$nama','$id_kamar','$lama','$total', NOW())");

    mysqli_query($koneksi, "UPDATE kamar SET status='Terisi' WHERE id_kamar='$id_kamar'");
    echo "<script>alert('Transaksi berhasil disimpan!');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kasir Hotel</title>
  <style>
    body { font-family: 'Poppins'; background: #f5f5f5; padding: 30px; }
    form { background: white; padding: 20px; border-radius: 10px; width: 400px; margin: auto; box-shadow: 0 3px 8px rgba(0,0,0,0.2); }
    input, select, button { width: 100%; padding: 10px; margin-top: 10px; border-radius: 8px; border: 1px solid #ccc; }
    button { background: #28a745; color: white; border: none; cursor: pointer; }
    button:hover { background: #218838; }
  </style>
</head>
<body>
  <h2 align="center">🧾 Pendaftaran / Transaksi Hotel</h2>
  <form method="post">
    <label>Nama Tamu:</label>
    <input type="text" name="nama_tamu" required>

    <label>Pilih Kamar:</label>
    <select name="id_kamar" required>
      <option value="">-- Pilih Kamar --</option>
      <?php
        $result = mysqli_query($koneksi, "SELECT * FROM kamar WHERE status='Tersedia'");
        while ($r = mysqli_fetch_assoc($result)) {
            echo "<option value='{$r['id_kamar']}'>{$r['nama_kamar']} - Rp " . number_format($r['harga_per_malam'], 0, ',', '.') . "</option>";
        }
      ?>
    </select>

    <label>Lama Menginap (hari):</label>
    <input type="number" name="lama_menginap" required>

    <button type="submit" name="simpan">Simpan Transaksi</button>
  </form>

  <div style="text-align:center; margin-top:20px;">
    <a href="dashboard.php">⬅ Kembali</a>
  </div>
</body>
</html>
