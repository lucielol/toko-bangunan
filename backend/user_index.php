<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
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
    <h1>Manage Users</h1>
    <a href="user_create.php">Add New User</a>
    <a href="index.php">Back to Dashboard</a>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nama Lengkap</th>
            <th>Nomor Telepon</th>
            <th>Alamat</th>
            <th>Tanggal Dibuat</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['nama_lengkap']}</td>
                        <td>{$row['nomor_telepon']}</td>
                        <td>{$row['alamat']}</td>
                        <td>{$row['tanggal_dibuat']}</td>
                        <td>
                            <a href='user_update.php?id={$row['id']}'>Edit</a> | 
                            <a href='user_delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No users found</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php $conn->close(); ?>
