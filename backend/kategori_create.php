<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kategori = $_POST['nama_kategori'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "INSERT INTO kategori (nama_kategori, deskripsi)
            VALUES ('$nama_kategori', '$deskripsi')";

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
    <title>Create Kategori</title>
</head>
<body>
    <h1>Create New Kategori</h1>
    <form method="post" action="kategori_create.php">
        <label>Nama Kategori:</label><br>
        <input type="text" name="nama_kategori" required><br>
        <label>Deskripsi:</label><br>
        <textarea name="deskripsi"></textarea><br><br>
        <input type="submit" value="Create">
    </form>
</body>
</html>
