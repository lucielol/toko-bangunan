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
  case 'login':
    if ($request_method === 'POST') {
      $username = isset($input_data['username']) ? $input_data['username'] : null;
      $password = isset($input_data['password']) ? $input_data['password'] : null;

      if ($username && $password) {
        $sql = "SELECT password FROM user WHERE email = '$username'";
        $query = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($query);

        if ($user && password_verify($password, $user['password'])) {
          echo json_encode([
            'success' => true,
            'message' => 'Login successful'
          ]);
        } else {
          echo json_encode([
            'success' => false,
            'message' => 'Invalid username or password'
          ]);
        }
      } else {
        echo json_encode([
          'success' => false,
          'message' => 'Username and password are required'
        ]);
      }
    } else {
      echo json_encode([
        'success' => false,
        'message' => 'Invalid request method for login'
      ]);
    }
    break;

  case 'register':
    if ($request_method === 'POST') {
      $username = isset($input_data['username']) ? $input_data['username'] : null;
      $password = isset($input_data['password']) ? $input_data['password'] : null;
      $email = isset($input_data['email']) ? $input_data['email'] : null;
      $nama_lengkap = isset($input_data['nama_lengkap']) ? $input_data['nama_lengkap'] : null;
      $nomor_telepon = isset($input_data['nomor_telepon']) ? $input_data['nomor_telepon'] : null;
      $alamat = isset($input_data['alamat']) ? $input_data['alamat'] : null;

      if ($username && $password && $email && $nama_lengkap && $nomor_telepon && $alamat) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO user (username, password, email, nama_lengkap, nomor_telepon, alamat) VALUES ('$username', '$hashedPassword', '$email', '$nama_lengkap', '$nomor_telepon', '$alamat')";
        if (mysqli_query($conn, $sql)) {
          echo json_encode(array('success' => true, 'message' => 'User registered successfully'));
        } else {
          echo json_encode(array('success' => false, 'message' => 'User registration failed'));
        }
      } else {
        echo json_encode(array('success' => false, 'message' => 'Username, password, email, nama_lengkap, nomor_telepon, and alamat are required'));
      }
    } else {
      echo json_encode(array('success' => false, 'message' => 'Invalid request method for registration'));
    }
    break;


  case 'getUsers':
    if ($request_method === 'GET') {
      $sql = "SELECT * FROM user";
      $query = mysqli_query($conn, $sql);
      $data = array();
      while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
      }
      echo json_encode($data);
    } else {
      echo json_encode(array('message' => 'Invalid request method for getUsers'));
    }
    break;

  case 'deleteUser':
    if ($request_method === 'DELETE') {
      $id = $_GET['id'];
      if ($id) {
        $sql = "DELETE FROM user WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
          echo json_encode(array('message' => 'User deleted successfully'));
        } else {
          echo json_encode(array('message' => 'User deletion failed'));
        }
      } else {
        echo json_encode(array('message' => 'User ID is required'));
      }
    } else {
      echo json_encode(array('message' => 'Invalid request method for deleteUser'));
    }
    break;

  case 'updateUser':
    if ($request_method === 'PUT') {
      $input_data = json_decode(file_get_contents("php://input"), true);

      $id = isset($input_data['id']) ? $input_data['id'] : null;
      $username = isset($input_data['username']) ? $input_data['username'] : null;
      $email = isset($input_data['email']) ? $input_data['email'] : null;
      $nama_lengkap = isset($input_data['nama_lengkap']) ? $input_data['nama_lengkap'] : null;
      $nomor_telepon = isset($input_data['nomor_telepon']) ? $input_data['nomor_telepon'] : null;
      $alamat = isset($input_data['alamat']) ? $input_data['alamat'] : null;
      $password = isset($input_data['password']) ? $input_data['password'] : null;

      if ($username && $email && $nama_lengkap && $nomor_telepon && $alamat) {
        $sql = "UPDATE user SET 
                        username = '$username', 
                        email = '$email', 
                        nama_lengkap = '$nama_lengkap', 
                        nomor_telepon = '$nomor_telepon', 
                        alamat = '$alamat'";

        if ($password) {
          $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
          $sql .= ", password = '$hashedPassword'";
        }

        $sql .= " WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
          echo json_encode(array('message' => 'User updated successfully'));
        } else {
          echo json_encode(array('message' => 'User update failed'));
        }
      } else {
        echo json_encode(array('message' => 'All fields except password are required'));
      }
    } else {
      echo json_encode(array('message' => 'Invalid request method for updateUser'));
    }
    break;
}
