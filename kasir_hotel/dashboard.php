<?php
session_start();
if (!isset($_SESSION['kasir'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Kasir</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #89f7fe, #66a6ff);
      text-align: center;
      padding: 50px;
    }
    h1 { color: #333; }
    .menu {
      margin-top: 30px;
    }
    a {
      text-decoration: none;
      background: #0066ff;
      color: white;
      padding: 12px 25px;
      border-radius: 10px;
      margin: 8px;
      display: inline-block;
      transition: 0.3s;
    }
    a:hover {
      background: #0044cc;
    }
  </style>
</head>
<body>
  <h1>Selamat Datang, <?php echo $_SESSION['kasir']; ?>!</h1>
  <p>Pilih menu di bawah:</p>
  <div class="menu">
    <a href="kasir.php">🧾 Kasir</a>
    <a href="kamar.php">🏨 Data Kamar</a>
    <a href="laporan.php">📊 Laporan</a>
    <a href="logout.php">🚪 Logout</a>
  </div>
</body>
</html>
