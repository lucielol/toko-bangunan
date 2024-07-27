<?php
include 'config.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE user SET username='$username', password='$password', email='$email', nama_lengkap='$nama_lengkap', nomor_telepon='$nomor_telepon', alamat='$alamat' WHERE id=$id";
    } else {
        $sql = "UPDATE user SET username='$username', email='$email', nama_lengkap='$nama_lengkap', nomor_telepon='$nomor_telepon', alamat='$alamat' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

$sql = "SELECT * FROM user WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No user found";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h1>Update User</h1>
    <form method="post" action="user_update.php?id=<?php echo $id; ?>">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?php echo $row['username']; ?>" required><br>
        <label>Password (leave blank to keep current password):</label><br>
        <input type="password" name="password"><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama_lengkap" value="<?php echo $row['nama_lengkap']; ?>"><br>
        <label>Nomor Telepon:</label><br>
        <input type="text" name="nomor_telepon" value="<?php echo $row['nomor_telepon']; ?>"><br>
        <label>Alamat:</label><br>
        <textarea name="alamat"><?php echo $row['alamat']; ?></textarea><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
