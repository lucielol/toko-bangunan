<?php

$query_string = $_SERVER['QUERY_STRING'];
parse_str($query_string, $query_params);
$action = isset($query_params['action']) ? $query_params['action'] : null;
$request_method = $_SERVER['REQUEST_METHOD'];

$request_uri = $_SERVER['REQUEST_URI'];
$uri_segments = explode('/', trim($request_uri, '/'));
$id = isset($uri_segments[2]) ? intval($uri_segments[2]) : null;

$input_data = json_decode(file_get_contents("php://input"), true);

switch ($action) {
  case 'getCategories':
    if ($request_method === 'GET') {
      $sql = "SELECT * FROM kategori";
      $query = mysqli_query($conn, $sql);
      $data = array();
      while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
      }
      echo json_encode($data);
    } else {
      echo json_encode(array('success' => false, 'message' => 'Invalid request method for getCategories'));
    }
    break;

  case 'addCategory':
    if ($request_method === 'POST') {
      $nama_kategori = isset($input_data['nama_kategori']) ? $input_data['nama_kategori'] : null;
      $deskripsi = isset($input_data['deskripsi']) ? $input_data['deskripsi'] : null;

      if ($nama_kategori && $deskripsi) {
        $sql = "INSERT INTO kategori (nama_kategori, deskripsi) VALUES ('$nama_kategori', '$deskripsi')";
        if (mysqli_query($conn, $sql)) {
          echo json_encode(array('success' => true, 'message' => 'Category added successfully'));
        } else {
          echo json_encode(array('success' => false, 'message' => 'Category addition failed'));
        }
      } else {
        echo json_encode(array('success' => false, 'message' => 'Nama kategori and deskripsi are required'));
      }
    } else {
      echo json_encode(array('success' => false, 'message' => 'Invalid request method for addCategory'));
    }
    break;

  case 'updateCategory':
    if ($request_method === 'PUT') {
      $id = isset($input_data['id']) ? $input_data['id'] : null;
      $nama_kategori = isset($input_data['nama_kategori']) ? $input_data['nama_kategori'] : null;
      $deskripsi = isset($input_data['deskripsi']) ? $input_data['deskripsi'] : null;

      if ($id && $nama_kategori && $deskripsi) {
        $sql = "UPDATE kategori SET 
                    nama_kategori = '$nama_kategori', 
                    deskripsi = '$deskripsi' 
                WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
          echo json_encode(array('success' => true, 'message' => 'Category updated successfully'));
        } else {
          echo json_encode(array('success' => false, 'message' => 'Category update failed'));
        }
      } else {
        echo json_encode(array('success' => false, 'message' => 'ID, nama kategori, and deskripsi are required'));
      }
    } else {
      echo json_encode(array('success' => false, 'message' => 'Invalid request method for updateCategory'));
    }
    break;

  case 'deleteCategory':
    if ($request_method === 'DELETE') {
      $id = isset($_GET['id']) ? $_GET['id'] : null;

      if ($id) {
        $sql = "DELETE FROM kategori WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
          echo json_encode(array('success' => true, 'message' => 'Category deleted successfully'));
        } else {
          echo json_encode(array('success' => false, 'message' => 'Category deletion failed'));
        }
      } else {
        echo json_encode(array('success' => false, 'message' => 'Category ID is required'));
      }
    } else {
      echo json_encode(array('success' => false, 'message' => 'Invalid request method for deleteCategory'));
    }
    break;
}