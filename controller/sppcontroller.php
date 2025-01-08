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
    if (isset($_POST['tahun']) && isset($_POST['nominal'])) {
        $tahun = $_POST['tahun'];
        $nominal = $_POST['nominal'];

        $create = mysqli_query($connect, "INSERT INTO spp (tahun,nominal) VALUES ($tahun,$nominal)");
        if ($create) {
            header("Location: /index.php?url=spp");
            exit;
        } else {
            echo "<script>alert('Gagal Tambah Data')</script>";
        }
    }

    // update data 
    if (isset($_POST['tahuns']) && isset($_POST['nominals']) && $_POST['_method'] == "PUT") {
        $id = $_POST['id'];
        $tahun = $_POST['tahuns'];
        $nominal = $_POST['nominals'];

        $update = mysqli_query($connect, "UPDATE spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp=$id");
        if ($update) {
            header("Location: /index.php?url=spp");
            exit;
        } else {
            echo "<script>alert('Gagal Edit Data')</script>";
        }
    }

    // delete data 
    if (isset($_POST['ids']) && $_POST['_methods'] == "DELETE") {
        $id = $_POST['ids'];

        $delete = mysqli_query($connect, "DELETE FROM spp WHERE id_spp=$id");
        if ($delete) {
            header("Location: /index.php?url=spp");
            exit;
        } else {
            echo "<script>alert('Gagal Hapus Data')</script>";
        }
    }
} catch (\Throwable $th) {
    throw $th;
}
