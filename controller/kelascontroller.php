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
    if (isset($_POST['nama_kelas']) && isset($_POST['kompetensi_keahlian'])) {
        $nama_kelas = $_POST['nama_kelas'];
        $kompetensi_keahlian = $_POST['kompetensi_keahlian'];

        $create = mysqli_query($connect, "INSERT INTO kelas (nama_kelas,kompetensi_keahlian) VALUES ('$nama_kelas','$kompetensi_keahlian')");
        if ($create) {
            header("Location: /index.php?url=kelas");
            exit;
        } else {
            echo "<script>alert('Gagal Tambah Data')</script>";
        }
    }

    // update data 
    if (isset($_POST['nama_kelass']) && isset($_POST['kompetensi_keahlians']) && $_POST['_method'] == "PUT") {
        $id = $_POST['id'];
        $nama_kelas = $_POST['nama_kelass'];
        $kompetensi_keahlian = $_POST['kompetensi_keahlians'];

        $update = mysqli_query($connect, "UPDATE kelas SET nama_kelas='$nama_kelas', kompetensi_keahlian='$kompetensi_keahlian' WHERE id_kelas=$id");
        if ($update) {
            header("Location: /index.php?url=kelas");
            exit;
        } else {
            echo "<script>alert('Gagal Edit Data')</script>";
        }
    }

    // delete data 
    if (isset($_POST['ids']) && $_POST['_methods'] == "DELETE") {
        $id = $_POST['ids'];

        $delete = mysqli_query($connect, "DELETE FROM kelas WHERE id_kelas=$id");
        if ($delete) {
            header("Location: /index.php?url=kelas");
            exit;
        } else {
            echo "<script>alert('Gagal Hapus Data')</script>";
        }
    }
} catch (\Throwable $th) {
    throw $th;
}
