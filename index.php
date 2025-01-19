<?php
try {
    session_start();
    include "databases/connections.php";
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
    }
    $username = $_SESSION['user']['username'];
    $password = $_SESSION['user']['password'];

    $level = mysqli_query($connect, "SELECT levels FROM petugas WHERE username='$username' AND password='$password'");

    $data = mysqli_fetch_array($level);

    if ($data['levels'] !== 'admin') {
        echo '<script>Your No Access this menu</script>';
    }
} catch (\Throwable $th) {
    throw $th;
}
?>

<?php if ($data['levels'] == 'admin') { ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP</title>
    <link rel="stylesheet" href="./asset/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="./asset/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <script src="./asset/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-secondary-subtle">
        <div class="container-fluid">
            <a class="navbar-brand text-bold" href="index.php">Pembayaran SPP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?url=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?url=spp">SPP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?url=kelas">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?url=siswa">Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?url=petugas">Petugas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?url=pembayaran">Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?url=laporan">Laporan</a>
                    </li>
                </ul>
            </div>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </nav>



    <div class="container-fluid mt-2">
        <?php 
            $page = isset($_GET['url'])? $_GET['url'] : 'home';
            include 'view/'. $page . '.php';
        ?>
    </div>


</body>

</html>
<?php }else{
    echo "<script>alert('not access');location.href='login.php';</script>";
} ?>
