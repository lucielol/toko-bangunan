<?php

$request_method = $_SERVER['REQUEST_METHOD'];
$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $query_params);
$action = isset($query_params['action']) ? $query_params['action'] : null;
$uri_segments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$id = isset($uri_segments[2]) ? intval($uri_segments[2]) : null;
$input_data = json_decode(file_get_contents("php://input"), true);

switch ($action) {
  case 'getProducts':
    if ($request_method === 'GET') {
      $sql = "SELECT * FROM produk";
      $result = $conn->query($sql);
      $data = array();
      if ($result) {
        while ($row = $result->fetch_assoc()) {
          $data[] = $row;
        }
        echo json_encode($data);
      } else {
        echo json_encode(array('success' => false, 'message' => 'Query error: ' . $conn->error));
      }
    } else {
      echo json_encode(array('success' => false, 'message' => 'Invalid request method for getProducts'));
    }
    break;

  case 'addProduct':
    if ($request_method === 'POST') {
      $nama_produk = isset($input_data['nama_produk']) ? $input_data['nama_produk'] : null;
      $deskripsi = isset($input_data['deskripsi']) ? $input_data['deskripsi'] : null;
      $harga = isset($input_data['harga']) ? $input_data['harga'] : null;
      $stok = isset($input_data['stok']) ? $input_data['stok'] : null;
      $kategori_id = isset($input_data['kategori_id']) ? $input_data['kategori_id'] : null;
      $tanggal_dibuat = isset($input_data['tanggal_dibuat']) ? $input_data['tanggal_dibuat'] : null;
      $gambar_url = isset($input_data['gambar_url']) ? $input_data['gambar_url'] : null;

      if ($nama_produk && $deskripsi && $harga && $stok && $kategori_id && $tanggal_dibuat && $gambar_url) {
        $sql = "INSERT INTO produk (nama_produk, deskripsi, harga, stok, kategori_id, tanggal_dibuat, gambar_url) 
                VALUES ('$nama_produk', '$deskripsi', $harga, $stok, $kategori_id, '$tanggal_dibuat', '$gambar_url')";
        if ($conn->query($sql)) {
          echo json_encode(array('success' => true, 'message' => 'Product added successfully'));
        } else {
          echo json_encode(array('success' => false, 'message' => 'Product addition failed: ' . $conn->error));
        }
      } else {
        echo json_encode(array('success' => false, 'message' => 'All fields are required'));
      }
    } else {
      echo json_encode(array('success' => false, 'message' => 'Invalid request method for addProduct'));
    }
    break;

  case 'updateProduct':
    if ($request_method === 'PUT') {
      $input_data = json_decode(file_get_contents("php://input"), true);

      $id = isset($input_data['id']) ? $input_data['id'] : null;
      $nama_produk = isset($input_data['nama_produk']) ? $input_data['nama_produk'] : null;
      $deskripsi = isset($input_data['deskripsi']) ? $input_data['deskripsi'] : null;
      $harga = isset($input_data['harga']) ? $input_data['harga'] : null;
      $stok = isset($input_data['stok']) ? $input_data['stok'] : null;
      $kategori_id = isset($input_data['kategori_id']) ? $input_data['kategori_id'] : null;
      $tanggal_dibuat = isset($input_data['tanggal_dibuat']) ? $input_data['tanggal_dibuat'] : null;
      $gambar_url = isset($input_data['gambar_url']) ? $input_data['gambar_url'] : null;

      if ($id && $nama_produk && $deskripsi && $harga && $stok && $kategori_id && $tanggal_dibuat && $gambar_url) {
        $sql = "UPDATE produk SET 
                nama_produk = '$nama_produk', 
                deskripsi = '$deskripsi', 
                harga = $harga, 
                stok = $stok, 
                kategori_id = $kategori_id, 
                tanggal_dibuat = '$tanggal_dibuat', 
                gambar_url = '$gambar_url' 
                WHERE id = $id";

        if ($conn->query($sql)) {
          echo json_encode(array('success' => true, 'message' => 'Product updated successfully'));
        } else {
          echo json_encode(array('success' => false, 'message' => 'Product update failed: ' . $conn->error));
        }
      } else {
        echo json_encode(array('success' => false, 'message' => 'All fields are required'));
      }
    } else {
      echo json_encode(array('success' => false, 'message' => 'Invalid request method for updateProduct'));
    }
    break;

  case 'deleteProduct':
    if ($request_method === 'DELETE') {
      $id = isset($query_params['id']) ? intval($query_params['id']) : null;
      if ($id) {
        $sql = "DELETE FROM produk WHERE id = $id";
        if ($conn->query($sql)) {
          echo json_encode(array('success' => true, 'message' => 'Product deleted successfully'));
        } else {
          echo json_encode(array('success' => false, 'message' => 'Product deletion failed: ' . $conn->error));
        }
      } else {
        echo json_encode(array('success' => false, 'message' => 'Product ID is required'));
      }
    } else {
      echo json_encode(array('success' => false, 'message' => 'Invalid request method for deleteProduct'));
    }
    break;
}
