<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kategori = $_POST['nama_kategori'];
    $deskripsi = $_POST['deskripsi'];

    $sql = "UPDATE kategori SET nama_kategori='$nama_kategori', deskripsi='$deskripsi' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

$sql = "SELECT * FROM kategori WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No category found";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Kategori</title>
</head>
<body>
    <h1>Update Kategori</h1>
    <form method="post" action="kategori_update.php?id=<?php echo $id; ?>">
        <label>Nama Kategori:</label><br>
        <input type="text" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>" required><br>
        <label>Deskripsi:</label><br>
        <textarea name="deskripsi"><?php echo $row['deskripsi']; ?></textarea><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
