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
    if (isset($_POST['nama']) && isset($_POST['nis']) && isset($_POST['nisn']) && isset($_POST['alamat']) && isset($_POST['id_kelas']) && isset($_POST['no_telp']) && isset($_POST['id_spp'])) {

        $nama = $_POST['nama'];
        $nis = $_POST['nis'];
        $nisn = $_POST['nisn'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $id_spp = $_POST['id_spp'];
        $id_kelas = $_POST['id_kelas'];

        $createSiswa = mysqli_query($connect, "INSERT INTO siswa (nama, nis, nisn, alamat, no_telp, id_spp, id_kelas) VALUES ('$nama','$nis','$nisn','$alamat','$no_telp', '$id_spp',' $id_kelas')");
        $createPembayaran = mysqli_query($connect, "INSERT INTO pembayaran (id_petugas, id_siswa,nisns, tgl_bayar, bulan_bayar, tahun_bayar, id_spp, jumlah_bayar) VALUES (NULL ,NULL,'$nisn',NULL, NULL, NULL, '$id_spp', 0)");

        if ($createSiswa && $createPembayaran) {
            header("Location: /index.php?url=siswa");
            exit;
        } else {
            echo "<script>alert('Gagal Tambah Data')</script>";
        }
    }

    // update data 
    if ($_POST['_method'] == "PUT") {
        $id = $_POST['id'];
        $nama = $_POST['namas'];
        $nis = $_POST['niss'];
        $nisn = $_POST['nisns'];
        $alamat = $_POST['alamats'];
        $no_telp = $_POST['no_telps'];
        $id_spp = $_POST['id_spp'];
        $id_kelas = $_POST['id_kelas'];

        $update = mysqli_query($connect, "UPDATE siswa SET nama='$nama',nis='$nis',nisn='$nisn', alamat='$alamat',no_telp='$no_telp',id_spp='$id_spp',id_kelas='$id_kelas' WHERE id_siswa=$id");
        if ($update) {
            header("Location: /index.php?url=siswa");
            exit;
        } else {
            echo "<script>alert('Gagal Edit Data')</script>";
        }
    }

    // delete data 
    if ($_POST['_methods'] == "DELETE") {
        $id = $_POST['id'];

        $delete = mysqli_query($connect, "DELETE FROM siswa WHERE id_siswa=$id");
        if ($delete) {
            header("Location: /index.php?url=siswa");
            exit;
        } else {
            echo "<script>alert('Gagal Hapus Data')</script>";
        }
    }
} catch (\Throwable $th) {
    echo $th;
}
