<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_hotel");
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['simpan'])) {
    $nama_tamu = $_POST['nama_tamu'];
    $id_kamar = $_POST['id_kamar'];
    $lama_menginap = $_POST['lama_menginap'];

    // Ambil harga kamar dari tabel kamar
    $result = mysqli_query($koneksi, "SELECT harga_per_malam FROM kamar WHERE id_kamar='$id_kamar'");
    $row = mysqli_fetch_assoc($result);
    $harga_per_malam = $row['harga_per_malam'];

    // Hitung total bayar
    $total_bayar = $lama_menginap * $harga_per_malam;

    // Simpan ke tabel transaksi
    mysqli_query($koneksi, "INSERT INTO transaksi (nama_tamu, id_kamar, lama_menginap, total_bayar) 
                            VALUES ('$nama_tamu', '$id_kamar', '$lama_menginap', '$total_bayar')");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kasir Hotel</title>
</head>
<body>
    <h1>Kasir Hotel</h1>

     <center>
      <img src="image/hotel.jpg" alt="Hotel" width="600">
    </center>
    <br>

    <form method="POST">
        <label>Nama Tamu:</label><br>
        <input type="text" name="nama_tamu" required><br><br>

        <label>Pilih Kamar:</label><br>
        <select name="id_kamar" required>
            <option value="">-- Pilih Kamar --</option>
            <?php
            $kamar = mysqli_query($koneksi, "SELECT * FROM kamar");
            while ($row = mysqli_fetch_assoc($kamar)) {
                echo "<option value='{$row['id_kamar']}'>{$row['nama_kamar']} - Rp{$row['harga_per_malam']}/malam</option>";
            }
            ?>
        </select><br><br>

        <label>Lama Menginap (malam):</label><br>
        <input type="number" name="lama_menginap" required><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>

    <h2>Daftar Transaksi</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nama Tamu</th>
            <th>Kamar</th>
            <th>Lama Menginap</th>
            <th>Total Bayar</th>
            <th>Tanggal</th>
        </tr>
        <?php
        $transaksi = mysqli_query($koneksi, "SELECT t.*, k.nama_kamar FROM transaksi t JOIN kamar k ON t.id_kamar = k.id_kamar ORDER BY t.id_transaksi DESC");
        while ($row = mysqli_fetch_assoc($transaksi)) {
            echo "<tr>
                    <td>{$row['id_transaksi']}</td>
                    <td>{$row['nama_tamu']}</td>
                    <td>{$row['nama_kamar']}</td>
                    <td>{$row['lama_menginap']}</td>
                    <td>Rp{$row['total_bayar']}</td>
                    <td>{$row['tanggal']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>

