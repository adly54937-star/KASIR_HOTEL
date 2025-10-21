<?php
include 'koneksi.php';


$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id='$id'");
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi</title>
</head>
<body>
    <h2>Edit Data Transaksi</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <label>Nama Tamu:</label><br>
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required><br><br>

        <label>Jenis Kamar:</label><br>
        <select name="jenis_kamar" required>
            <option value="Standar" <?php if($data['jenis_kamar']=='Standar') echo 'selected'; ?>>Standar</option>
            <option value="Deluxe" <?php if($data['jenis_kamar']=='Deluxe') echo 'selected'; ?>>Deluxe</option>
            <option value="Suite" <?php if($data['jenis_kamar']=='Suite') echo 'selected'; ?>>Suite</option>
        </select><br><br>

        <label>Lama Menginap (hari):</label><br>
        <input type="number" name="lama" value="<?php echo $data['lama']; ?>" required><br><br>

        <label>Harga per Malam:</label><br>
        <input type="number" name="harga" value="<?php echo $data['harga']; ?>" required><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis_kamar'];
    $lama = $_POST['lama'];
    $harga = $_POST['harga'];
    $total = $lama * $harga;

    $query = mysqli_query($koneksi, "UPDATE transaksi SET nama='$nama', jenis_kamar='$jenis', lama='$lama', harga='$harga', total='$total' WHERE id='$id'");

    if ($query) {
        echo "<script>alert('Data berhasil diupdate'); window.location='tampil.php';</script>";
    } else {
        echo "<script>alert('Gagal update data');</script>";
    }
}
?>
