<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Produk</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Manage Produk</h1>
    <a href="produk_create.php">Add New Produk</a>
    <a href="index.php">Back to Dashboard</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Kategori ID</th>
            <th>Gambar</th> <!-- Kolom Gambar -->
            <th>Tanggal Dibuat</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM produk";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama_produk']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>{$row['harga']}</td>
                        <td>{$row['stok']}</td>
                        <td>{$row['kategori_id']}</td>
                        <td><img src='{$row['gambar_url']}' alt='Gambar Produk'></td> <!-- Menampilkan Gambar -->
                        <td>{$row['tanggal_dibuat']}</td>
                        <td>
                            <a href='produk_update.php?id={$row['id']}'>Edit</a> | 
                            <a href='produk_delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No products found</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php $conn->close(); ?>
