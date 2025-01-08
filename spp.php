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

    // create data
    if (isset($_POST['tahun']) && isset($_POST['nominal'])) {
        $tahun = $_POST['tahun'];
        $nominal = $_POST['nominal'];

        $create = mysqli_query($connect, "INSERT INTO spp (tahun,nominal) VALUES ($tahun,$nominal)");
        if ($create) {
            header("location: spp.php");
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
            header("location: spp.php");
        } else {
            echo "<script>alert('Gagal Edit Data')</script>";
        }
    }

    // delete data 
    if (isset($_POST['ids']) && $_POST['_methods'] == "DELETE") {
        $id = $_POST['ids'];

        $delete = mysqli_query($connect, "DELETE FROM spp WHERE id_spp=$id");
        if ($delete) {
            header('spp.php');
        } else {
            echo "<script>alert('Gagal Hapus Data')</script>";
        }
    }
} catch (\Throwable $th) {
    throw $th;
}

?>

<?php if ($data['level'] == 'admin' || $data['level'] == 'petugas') { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./asset/bootstrap-5.3.3-dist/css/bootstrap.min.css">
        <script src="./asset/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
        <script src="./asset/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>

    </head>

    <body>
        <?php if ($data['level'] == 'admin') { ?>
            <nav class="navbar navbar-expand-lg bg-secondary-subtle">
                <div class="container-fluid">
                    <a class="navbar-brand text-bold" href="index.php">Pembayaran SPP</a>
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
        <?php }elseif($data['level'] == 'petugas'){ ?>
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
        <?php }?>

        <div class="container-fluid mt-2">
            <div class="row">
                <div class="col-sm-12 p-5">
                    <div class="card">
                        <div class="card-body">
                            <div class=" d-flex justify-content-between">
                                <h5 class="card-title">SPP</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                                    Tambah Data
                                </button>

                                <!-- Modal create -->
                                <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="tahun">Tahun</label>
                                                        <input type="text" class="form-control" id="tahun" placeholder="Masukkan Tahun" name="tahun">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="nominal">Nominal SPP</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">Rp.</span>
                                                            <input type="text" class="form-control" placeholder="Masukkan Nominal SPP" id="nominal" name="nominal">
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Tambah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>





                            </div>
                            <table class="table table-striped mt-1">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Nominal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = mysqli_query($connect, "SELECT * FROM spp order by id_spp");
                                    $no = 1;
                                    ?>
                                    <?php foreach ($data as $spp) { ?>
                                        <tr class="text-center">
                                            <th scope="row"><?php echo $no++; ?></th>
                                            <td><?php echo $spp['tahun'] ?></td>
                                            <td>Rp.<?php echo number_format($spp['nominal'], 0, '.', '.') ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-md mb-10" data-bs-toggle="modal" data-bs-target="#updateModal-<?= $spp['id_spp'] ?>">Edit</button>
                                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal-<?= $spp['id_spp'] ?>">Hapus</a>
                                            </td>
                                        </tr>





                                        <!-- Modal update -->
                                        <div class="modal fade" id="updateModal-<?= $spp['id_spp'] ?>" tabindex="-1" aria-labelledby="updateModal-<?= $spp['id_spp'] ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="updateModal-<?= $spp['id_spp'] ?>Label">Edit Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="id" value="<?= $spp['id_spp'] ?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="tahun">Tahun</label>
                                                                <input type="text" class="form-control" id="tahun" value="<?= $spp['tahun'] ?>" name="tahuns">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="nominal">Nominal SPP</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">Rp.</span>
                                                                    <input type="text" class="form-control" value="<?= $spp['nominal'] ?>" id="nominal" name="nominals">
                                                                    <span class="input-group-text">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-warning">Edit</button>
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal delete -->
                                        <div class="modal fade" id="hapusModal-<?= $spp['id_spp'] ?>" tabindex="-1" aria-labelledby="hapusModal-<?= $spp['id_spp'] ?>Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="hapusModal-<?= $spp['id_spp'] ?>Label">Hapus Data</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="post">
                                                        <input type="hidden" name="_methods" value="DELETE">
                                                        <input type="hidden" name="ids" value="<?= $spp['id_spp'] ?>">
                                                        <div class="modal-body">
                                                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>






                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </body>

    </html>
<?php } ?>