<?php
session_start();
include 'data_barang.php';
include 'data_customer.php';

function resetIds(&$data) {
    $newId = 1;
    foreach ($data as &$item) {
        $item['id'] = $newId++;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_barang'])) {
        $id = end($barang)['id'] + 1;
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $barang[] = ['id' => $id, 'nama_barang' => $nama_barang, 'harga' => $harga, 'stok' => $stok];
    } elseif (isset($_POST['delete_barang'])) {
        $id = $_POST['delete_barang'];
        foreach ($barang as $key => $item) {
            if ($item['id'] == $id) {
                unset($barang[$key]);
                break;
            }
        }
        resetIds($barang);
    } elseif (isset($_POST['add_customer'])) {
        $id = end($customer)['id'] + 1;
        $nama_customer = $_POST['nama_customer'];
        $email = $_POST['email'];
        $no_telepon = $_POST['no_telepon'];
        $customer[] = ['id' => $id, 'nama_customer' => $nama_customer, 'email' => $email, 'no_telepon' => $no_telepon];
    } elseif (isset($_POST['delete_customer'])) {
        $id = $_POST['delete_customer'];
        foreach ($customer as $key => $cust) {
            if ($cust['id'] == $id) {
                unset($customer[$key]);
                break;
            }
        }
        resetIds($customer);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f7f7f7;
        color: #333;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    h1, h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .form-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .form-container input, .form-container button {
        padding: 10px;
        margin: 5px;
        border: 1px solid green;
        border-radius: 4px;
        font-size: 16px;
    }

    .form-container button {
        background-color: green;
        color: white;
        border: none;
        cursor: pointer;
    }

    .form-container button:hover {
        background-color: red;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        font-size: 16px;
    }

    th {
        background-color: red;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    .delete-button {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .delete-button:hover {
        background-color: #c82333;
    }

    /* Responsiveness */
    @media screen and (max-width: 768px) {
        .form-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .form-container input, .form-container button {
            width: 100%;
        }

        table {
            font-size: 14px;
        }
    }
</style>
<body>
    <div class="container">
        <h1>Manajemen Barang dan Customer</h1>

        <h2>Tambah Barang</h2>
        <div class="form-container">
            <form method="post" style="flex: 1;">
                <input type="text" name="nama_barang" placeholder="Nama Barang" required>
                <input type="number" name="harga" placeholder="Harga" required>
                <input type="number" name="stok" placeholder="Stok" required>
                <button type="submit" name="add_barang">Tambah Barang</button>
            </form>
        </div>

        <h2>Data Barang</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php
            foreach ($barang as $item) {
                echo "<tr>";
                echo "<td>" . $item['id'] . "</td>";
                echo "<td>" . $item['nama_barang'] . "</td>";
                echo "<td>" . $item['harga'] . "</td>";
                echo "<td>" . $item['stok'] . "</td>";
                echo "<td><form method='post' style='display:inline'><button type='submit' name='delete_barang' value='" . $item['id'] . "' class='delete-button'>Hapus</button></form></td>";
                echo "</tr>";
            }
            ?>
        </table>

        <h2>Tambah Customer</h2>
        <div class="form-container">
            <form method="post" style="flex: 1;">
                <input type="text" name="nama_customer" placeholder="Nama Customer" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="no_telepon" placeholder="No Telepon" required>
                <button type="submit" name="add_customer">Tambah Customer</button>
            </form>
        </div>

        <h2>Data Customer</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Customer</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Aksi</th>
            </tr>
            <?php
            foreach ($customer as $cust) {
                echo "<tr>";
                echo "<td>" . $cust['id'] . "</td>";
                echo "<td>" . $cust['nama_customer'] . "</td>";
                echo "<td>" . $cust['email'] . "</td>";
                echo "<td>" . $cust['no_telepon'] . "</td>";
                echo "<td><form method='post' style='display:inline'><button type='submit' name='delete_customer' value='" . $cust['id'] . "' class='delete-button'>Hapus</button></form></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
