<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Kategori</title>
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
    </style>
</head>
<body>
    <h1>Manage Kategori</h1>
    <a href="kategori_create.php">Add New Kategori</a>
    <a href="index.php">Back to Dashboard</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Tanggal Dibuat</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM kategori";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama_kategori']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>{$row['tanggal_dibuat']}</td>
                        <td>
                            <a href='kategori_update.php?id={$row['id']}'>Edit</a> | 
                            <a href='kategori_delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No categories found</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php $conn->close(); ?>
