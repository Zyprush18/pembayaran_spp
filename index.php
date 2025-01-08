<?php
try {
    session_start();
    include "databases/connections.php";
    if (!isset($_SESSION['user'])) {
        header('location: login.php');
    }
    $username = $_SESSION['user']['username'];
    $password = $_SESSION['user']['password'];

    $level = mysqli_query($connect, "SELECT level FROM petugas WHERE username='$username' AND password='$password'");

    $data = mysqli_fetch_array($level);
} catch (\Throwable $th) {
    throw $th;
}
?>


<!DOCTYPE html>
<html lang="en">
<?php if ($data['level'] == 'petugas') { ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=q, initial-scale=1.0">
        <title>Petugas</title>
        <link rel="stylesheet" href="/asset/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <script src="/asset/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-secondary-subtle">
            <div class="container-fluid">
                <a class="navbar-brand text-bold" href="#">Pembayaran SPP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Administrator</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="spp.php">SPP</a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Laporan</a>
                        </li>
                    </ul>
                </div>
                <a href="logout.php" class="btn btn-primary">Logout</a>

            </div>
        </nav>

        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-success-subtle mx-auto p-2">
                        <p class="fs-7 text-center">Anda login sebagai <b>Petugas</b></p>
                    </div>

                    <div class="card mt-1" style="height: 50px;">
                        <div class="body-card">
                            <p class="p-1">SELAMAT DATANG DI WEBSITE PEMBAYARAN SPP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </body>

<?php } elseif ($data['level'] == 'admin') { ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=q, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" href="/asset/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <script src="/asset/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-secondary-subtle">
            <div class="container-fluid">
                <a class="navbar-brand text-bold" href="#">Pembayaran SPP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Administrator</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="spp.php">SPP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Petugas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Laporan</a>
                        </li>
                    </ul>
                </div>
                <a href="logout.php" class="btn btn-primary">Logout</a>

            </div>
        </nav>

        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-sm-12">
                    <div class="bg-success-subtle mx-auto p-2">
                        <p class="fs-7 text-center">Anda login sebagai <b>Administrator</b></p>
                    </div>

                    <div class="card mt-1" style="height: 50px;">
                        <div class="body-card">
                            <p class="p-1">SELAMAT DATANG DI WEBSITE PEMBAYARAN SPP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>


<?php } else {
    header('location:login.php');
} ?>

</html>