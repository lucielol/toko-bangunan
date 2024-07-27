<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori_id = $_POST['kategori_id'];
    $gambar_url = $_POST['gambar_url']; // Menambahkan URL gambar

    $sql = "INSERT INTO produk (nama_produk, deskripsi, harga, stok, kategori_id, gambar_url)
            VALUES ('$nama_produk', '$deskripsi', '$harga', '$stok', '$kategori_id', '$gambar_url')";

    if ($conn->query($sql) === TRUE) {
        header("Location: produk_index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Produk</title>
    <style>
        form {
            max-width: 600px;
            margin: auto;
        }
        label, input, textarea {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Create New Produk</h1>
    <form method="post" action="produk_create.php">
        <label>Nama Produk:</label>
        <input type="text" name="nama_produk" required>
        
        <label>Deskripsi:</label>
        <textarea name="deskripsi"></textarea>
        
        <label>Harga:</label>
        <input type="number" name="harga" step="0.01" required>
        
        <label>Stok:</label>
        <input type="number" name="stok" required>
        
        <label>Kategori ID:</label>
        <input type="number" name="kategori_id" required>
        
        <label>URL Gambar:</label> <!-- Input URL gambar -->
        <input type="text" name="gambar_url" placeholder="Masukkan URL gambar">

        <input type="submit" value="Create">
    </form>
</body>
</html>

