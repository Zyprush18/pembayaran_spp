<?php
try {
    session_start();
    include(__DIR__ . '/../databases/connections.php');
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
    }
    $username = $_SESSION['user']['username'];
    $password = $_SESSION['user']['password'];

    $level = mysqli_query($connect, "SELECT levels FROM petugas WHERE username='$username' AND password='$password'");

    $data = mysqli_fetch_array($level);
  
    // create data
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['nama_petugas']) && isset($_POST['level'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $nama_petugas = $_POST['nama_petugas'];
        $level = $_POST['level'];

        $create = mysqli_query($connect, "INSERT INTO petugas (username, password, nama_petugas, levels) VALUES ('$username','$password','$nama_petugas','$level')");
        if ($create) {
            header("Location: /index.php?url=petugas");
            exit;
        } else {
            echo "<script>alert('Gagal Tambah Data')</script>";
        }
    }

    // update data 
    if (isset($_POST['usernames']) && isset($_POST['passwords']) && isset($_POST['nama_petugass']) && isset($_POST['levels']) && $_POST['_method'] == "PUT") {
        $id = $_POST['id'];
        $username = $_POST['usernames'];
        $password = md5($_POST['passwords']);
        $nama_petugas = $_POST['nama_petugass'];
        $level = $_POST['levels'];

        $update = mysqli_query($connect, "UPDATE petugas SET username='$username',password='$password',nama_petugas='$nama_petugas', levels='$level' WHERE id_petugas=$id");
        if ($update) {
            header("Location: /index.php?url=petugas");
            exit;
        } else {
            echo "<script>alert('Gagal Edit Data')</script>";
        }
    }

    // delete data 
    if (isset($_POST['ids']) && $_POST['_methods'] == "DELETE") {
        $id = $_POST['ids'];

        $delete = mysqli_query($connect, "DELETE FROM petugas WHERE id_petugas=$id");
        if ($delete) {
            header("Location: /index.php?url=petugas");
            exit;
        } else {
            echo "<script>alert('Gagal Hapus Data')</script>";
        }
    }
} catch (\Throwable $th) {
    throw $th;
}
