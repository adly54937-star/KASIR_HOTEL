<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM kasir WHERE username='$username'");
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Kasir Hotel</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            display: flex; justify-content: center; align-items: center;
            height: 100vh;
        }
        form {
            background: white; padding: 30px; border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2); width: 320px;
        }
        h2 { text-align: center; color: #333; }
        input, button {
            width: 100%; padding: 10px; margin: 8px 0;
            border-radius: 8px; border: 1px solid #ccc;
        }
        button {
            background: #2193b0; color: white; border: none; cursor: pointer;
        }
        button:hover { background: #1b7a94; }
        a { text-decoration: none; color: #2193b0; display: block; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <form method="post">
        <h2>Login Kasir</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Masuk</button>
        <a href="register.php">Belum punya akun? Daftar</a>
    </form>
</body>
</html>
