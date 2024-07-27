<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori_id = $_POST['kategori_id'];
    $gambar_url = $_POST['gambar_url']; // Menambahkan URL gambar

    $sql = "UPDATE produk SET 
                nama_produk='$nama_produk', 
                deskripsi='$deskripsi', 
                harga='$harga', 
                stok='$stok', 
                kategori_id='$kategori_id', 
                gambar_url='$gambar_url' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: produk_index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

$sql = "SELECT * FROM produk WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No product found";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Produk</title>
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
        img {
            max-width: 150px;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Update Produk</h1>
    <form method="post" action="produk_update.php?id=<?php echo $id; ?>">
        <label>Nama Produk:</label>
        <input type="text" name="nama_produk" value="<?php echo $row['nama_produk']; ?>" required>
        
        <label>Deskripsi:</label>
        <textarea name="deskripsi"><?php echo $row['deskripsi']; ?></textarea>
        
        <label>Harga:</label>
        <input type="number" name="harga" value="<?php echo $row['harga']; ?>" step="0.01" required>
        
        <label>Stok:</label>
        <input type="number" name="stok" value="<?php echo $row['stok']; ?>" required>
        
        <label>Kategori ID:</label>
        <input type="number" name="kategori_id" value="<?php echo $row['kategori_id']; ?>" required>
        
        <label>URL Gambar:</label>
        <input type="text" name="gambar_url" value="<?php echo $row['gambar_url']; ?>" placeholder="Masukkan URL gambar">

        <?php if (!empty($row['gambar_url'])): ?>
            <label>Gambar Saat Ini:</label>
            <img src="<?php echo $row['gambar_url']; ?>" alt="Gambar Produk">
        <?php endif; ?>

        <input type="submit" value="Update">
    </form>
</body>
</html>
