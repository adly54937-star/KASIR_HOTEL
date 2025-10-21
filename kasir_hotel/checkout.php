<?php
include 'koneksi.php';


if (isset($_GET['id_tamu'])) {
    $id_tamu = $_GET['id_tamu'];


    $q = mysqli_query($koneksi, "SELECT id_kamar FROM transaksi WHERE id_tamu='$id_tamu' ORDER BY id_transaksi DESC LIMIT 1");
    $d = mysqli_fetch_assoc($q);
    $id_kamar = $d['id_kamar'];

    // Ubah status kamar jadi tersedia
    mysqli_query($koneksi, "UPDATE kamar SET status='Tersedia' WHERE id_kamar='$id_kamar'");

    // Ubah status tamu jadi selesai
    mysqli_query($koneksi, "UPDATE tamu SET status='Selesai' WHERE id_tamu='$id_tamu'");

    echo "<script>alert('Tamu berhasil checkout!'); window.location='checkout.php';</script>";
}


$tamu = mysqli_query($koneksi, "SELECT * FROM tamu WHERE status='Menginap'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout Tamu</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Checkout Tamu</h1>
    <p>Daftar tamu yang sedang menginap</p>
  </header>

  <table border="1" cellspacing="0" cellpadding="8" align="center">
    <tr>
      <th>No</th>
      <th>Nama Tamu</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    while ($t = mysqli_fetch_assoc($tamu)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $t['nama_tamu']; ?></td>
        <td><a href="checkout.php?id_tamu=<?= $t['id_tamu']; ?>" onclick="return confirm('Yakin checkout tamu ini?')">Checkout</a></td>
      </tr>
    <?php } ?>
  </table>

  <div class="menu">
    <a href="dashboard.php"><button>Kembali ke Dashboard</button></a>
  </div>
</body>
</html>
