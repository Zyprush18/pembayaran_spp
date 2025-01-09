<div class="row">
    <div class="col-sm-12 p-5">
        <div class="card">
            <div class="card-body">
                <div class=" d-flex justify-content-between">
                    <h5 class="card-title">SISWA</h5>
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
                                <form action=".././controller/siswacontroller.php" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama">Nama Siswa</label>
                                            <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Siswa" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nis">Nis</label>
                                            <input type="number" class="form-control" id="nis" placeholder="Masukkan Nis Siswa" name="nis">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nisn">Nisn</label>
                                            <input type="number" class="form-control" id="nisn" placeholder="Masukkan Nisn Siswa" name="nisn">
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_kelas">Kelas</label>
                                            <select class="form-select" aria-label="Default select example" name="id_kelas" id="id_kelas">
                                                <option selected disabled>Pilih Kelas - Kompetensi Keahlian</option>
                                                <?php
                                                $data = mysqli_query($connect, "SELECT * FROM kelas ORDER BY nama_kelas");
                                                foreach ($data as $kelas) { ?>
                                                    <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['nama_kelas'] ?> - <?= $kelas['kompetensi_keahlian'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat">Alamat Siswa</label>
                                            <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat Siswa" name="alamat">
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_tlp">No. Telepon</label>
                                            <input type="number" class="form-control" id="no_tlp" placeholder="Masukkan Nomor Telepon Siswa" name="no_tlp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_kelas">Tahun Dan Nominal SPP</label>
                                            <select class="form-select" aria-label="Default select example" name="id_spp" id="id_spp">
                                                <option selected disabled>Pilih Tahun - Nominal SPP</option>
                                                <?php
                                                $data = mysqli_query($connect, "SELECT * FROM spp ORDER BY tahun");
                                                foreach ($data as $spp) { ?>
                                                    <option value="<?= $spp['id_spp'] ?>"><?= $spp['tahun'] ?> - Rp.<?= number_format($spp['nominal'], 2, ',', '.') ?></option>
                                                <?php } ?>
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
                            <th scope="col">Nama</th>
                            <th scope="col">Nis</th>
                            <th scope="col">Nisn</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Kompetensi Keahlian</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Tahun SPP</th>
                            <th scope="col">Nominal SPP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($connect, "SELECT * FROM siswa,spp,kelas WHERE spp.id_spp=siswa.id_spp AND kelas.id_kelas=siswa.id_kelas ORDER BY nama");
                        $no = 1;
                        ?>
                        <?php foreach ($data as $siswa) { ?>
                            <tr class="text-center">
                                <th scope="row"><?php echo $no++; ?></th>
                                <td><?= $siswa['nama'] ?></td>
                                <td><?= $siswa['nis']  ?></td>
                                <td><?= $siswa['nisn']  ?></td>
                                <td><?= $siswa['nama_kelas']  ?></td>
                                <td><?= $siswa['kompetensi_keahlian']  ?></td>
                                <td><?= $siswa['alamat']  ?></td>
                                <td><?= $siswa['tahun']  ?></td>
                                <td>Rp.<?php echo number_format($siswa['nominal'], 0, '.', '.') ?></td>
                                <td>
                                    <button type="button" class="btn btn-outline-warning btn-md mb-10" data-bs-toggle="modal" data-bs-target="#updateModal-<?= $siswa['id_siswa'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-flex" width="19px">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusModal-<?= $siswa['id_siswa'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-flex" width="19px">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>





                            <!-- Modal update -->
                            <div class="modal fade" id="updateModal-<?= $siswa['id_siswa'] ?>" tabindex="-1" aria-labelledby="updateModal-<?= $siswa['id_siswa'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="updateModal-<?= $siswa['id_siswa'] ?>Label">Edit Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action=".././controller/siswacontroller.php" method="post">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="id" value="<?= $siswa['id_siswa'] ?>">
                                            <div class="modal-body">
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="nama_siswas">siswa</label>
                                                        <input type="text" class="form-control" id="nama_siswas" value="<?= $siswa['nama_siswa'] ?>" name="nama_siswas">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="kompetensi_keahlian">Kompetensi Keahlian</label>
                                                        <input type="text" class="form-control" id="kompetensi_keahlians" value="<?= $siswa['kompetensi_keahlian'] ?>" name="kompetensi_keahlians">
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
                            <div class="modal fade" id="hapusModal-<?= $siswa['id_siswa'] ?>" tabindex="-1" aria-labelledby="hapusModal-<?= $siswa['id_siswa'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="hapusModal-<?= $siswa['id_siswa'] ?>Label">Hapus Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action=".././controller/siswacontroller.php" method="post">
                                            <input type="hidden" name="_methods" value="DELETE">
                                            <input type="hidden" name="ids" value="<?= $siswa['id_siswa'] ?>">
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