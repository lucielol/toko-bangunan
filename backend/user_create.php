<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO user (username, password, email, nama_lengkap, nomor_telepon, alamat)
            VALUES ('$username', '$password', '$email', '$nama_lengkap', '$nomor_telepon', '$alamat')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>
    <h1>Create New User</h1>
    <form method="post" action="user_create.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap"><br>
        <label>Nomor Telepon:</label><br>
        <input type="text" name="nomor_telepon"><br>
        <label>Alamat:</label><br>
        <textarea name="alamat"></textarea><br><br>
        <input type="submit" value="Create">
    </form>
</body>
</html>
