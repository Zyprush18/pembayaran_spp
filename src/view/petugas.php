<div class="row">
    <div class="col-sm-12 p-5">
        <div class="card">
            <div class="card-body">
                <div class=" d-flex justify-content-between">
                    <h5 class="card-title">PETUGAS</h5>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-success d-flex" data-bs-toggle="modal" data-bs-target="#createModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="23px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
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
                                <form action=".././controller/petugascontroller.php" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control" id="password" placeholder="Masukkan Password" name="password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama_petugas">Nama Petugas</label>
                                            <input type="text" class="form-control" id="nama_petugas" placeholder="Masukkan Nama Petugas" name="nama_petugas">
                                        </div>

                                        <div class="mb-3">
                                            <label for="level">level</label>
                                            <select class="form-select" aria-label="Default select example" name="level" id="level">
                                                <option selected>Pilih Level Akses</option>
                                                <option value="admin">Admin</option>
                                                <option value="petugas">Petugas</option>
                                            </select>
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
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Nama Petugas</th>
                            <th scope="col">Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($connect, "SELECT * FROM petugas order by id_petugas");
                        $no = 1;
                        ?>
                        <?php foreach ($data as $petugas) { ?>
                            <tr class="text-center">
                                <th scope="row"><?php echo $no++; ?></th>
                                <td><?= $petugas['username'] ?></td>
                                <td><?= $petugas['password']  ?></td>
                                <td><?= $petugas['nama_petugas']  ?></td>
                                <td><?= $petugas['levels']   ?></td>
                                <td>
                                    <button type="button" class="btn btn-outline-warning btn-md mb-10" data-bs-toggle="modal" data-bs-target="#updateModal-<?= $petugas['id_petugas'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-flex" width="19px">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusModal-<?= $petugas['id_petugas'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-flex" width="19px">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>





                            <!-- Modal update -->
                            <div class="modal fade" id="updateModal-<?= $petugas['id_petugas'] ?>" tabindex="-1" aria-labelledby="updateModal-<?= $petugas['id_petugas'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="updateModal-<?= $petugas['id_petugas'] ?>Label">Edit Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action=".././controller/petugascontroller.php" method="post">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="id" value="<?= $petugas['id_petugas'] ?>">
                                            <div class="modal-body">
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="username">Username</label>
                                                        <input type="text" class="form-control" id="usernames" value="<?= $petugas['username'] ?>" name="usernames">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password">Password</label>
                                                        <input type="text" class="form-control" id="passwords" value="<?= $petugas['password'] ?>" name="passwords">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama_petugas">Nama Petugas</label>
                                                        <input type="text" class="form-control" id="nama_petugass" value="<?= $petugas['nama_petugas'] ?>" name="nama_petugass">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="level">level</label>
                                                        <select class="form-select" aria-label="Default select example" name="levels" id="levels">
                                                            <option value="<?= $petugas['levels'] ?>" <?php $petugas ? $petugas['levels'] : ''; ?>><?= $petugas['levels'] == 'admin' ? 'Admin' : 'Petugas' ?></option>
                                                            <option value="admin">Admin</option>
                                                            <option value="petugas">Petugas</option>
                                                        </select>
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
                            <div class="modal fade" id="hapusModal-<?= $petugas['id_petugas'] ?>" tabindex="-1" aria-labelledby="hapusModal-<?= $petugas['id_petugas'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="hapusModal-<?= $petugas['id_petugas'] ?>Label">Hapus Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action=".././controller/petugascontroller.php" method="post">
                                            <input type="hidden" name="_methods" value="DELETE">
                                            <input type="hidden" name="ids" value="<?= $petugas['id_petugas'] ?>">
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