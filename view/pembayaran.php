<div class="row">
    <div class="col-sm-12 p-5">
        <div class="card">
            <div class="card-body">
                <div class=" d-flex justify-content-between">
                    <h5 class="card-title">PEMBAYARAN</h5>
                    <!-- Button trigger modal -->
                    <!-- <button type="button" class="btn btn-outline-success d-flex" data-bs-toggle="modal" data-bs-target="#createModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" width="23px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Tambah Data
                    </button> -->

                    <?php
                    $bulan = array(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
                    for ($i = 2020; $i <= date('Y'); $i++) {
                        $tahun[] = $i;
                    }

                    ?>

                    <!-- Modal create
                    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action=".././controller/pembayarancontroller.php" method="post">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="id_siswa">Siswa dan NISN</label>
                                            <select class="form-select" aria-label="Default select example" name="id_siswa" id="id_siswa" required>
                                                <option selected disabled>Pilih Siswa - NISN</option>
                                                <php
                                                $data = mysqli_query($connect, "SELECT * FROM siswa ORDER BY nama");
                                                foreach ($data as $siswa) { ?>
                                                    <option value="<= $siswa['id_siswa'] ?>"><= $siswa['nama'] ?> - <= $siswa['nisn'] ?></option>
                                                <php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_siswa">Tahun dan Nominal SPP</label>
                                            <select class="form-select" aria-label="Default select example" name="id_siswa" id="id_siswa" required>
                                                <option selected disabled>Pilih Tahun - Nominal SPP</option>
                                                <php
                                                $data = mysqli_query($connect, "SELECT * FROM spp ORDER BY nominal");
                                                foreach ($data as $siswa) { ?>
                                                    <option value="<= $siswa['id_spp'] ?>"><= $siswa['tahun'] ?> - Rp.<= number_format($siswa['nominal'], 0, ',', '.')  ?></option>
                                                <php } ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tgl_bayar">Tanggal Bayar</label>
                                            <input type="date" class="form-control" id="tgl_bayar" placeholder="Pilih Tanggal Bayar" name="tgl_bayar">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_bayar">Bulan Bayar</label>
                                            <select class="form-select" aria-label="Default select example" name="id_siswa" id="id_siswa" required>
                                                <option selected disabled>Pilih Bulan</option>
                                                <php foreach ($bulan as $key => $value) {
                                                    foreach ($value as $key => $val) { ?>
                                                        <option value="<= $val ?>"><= $val ?></option>
                                                <php }
                                                } ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tgl_bayar">Tahun Bayar</label>
                                            <select class="form-select" aria-label="Default select example" name="id_siswa" id="id_siswa" required>
                                                <option selected disabled>Pilih Tahun</option>
                                                <php foreach ($tahun as $key => $value) { ?>
                                                    <option value="<= $value ?>"><= $value ?></option>
                                                <php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nominal">Jumlah Bayar</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rp.</span>
                                                <input type="number" class="form-control" id="nominal" name="nominals">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="id_petugas">Petugas</label>
                                            <input type="text" class="form-control" id="tgl_bayar" value="<= $_SESSION['user']['username']?>" name="tgl_bayar">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->





                </div>


                <table class="table table-striped mt-1">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nominal SPP</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Bulan Bayar</th>
                            <th scope="col">Tahun Bayar</th>
                            <th scope="col">Jumlah Di Bayar</th>
                            <th scope="col">Kekurangan</th>
                            <th scope="col">Petugas</th>
                            <th scope="col">Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $data = mysqli_query($connect, "SELECT * FROM pembayaran,siswa,spp,petugas WHERE  pembayaran.id_spp=spp.id_spp AND siswa.nisn=pembayaran.nisns order by id_pembayaran DESC");
                        $no = 1;
                        ?>
                        <?php foreach ($data as $pembayaran) { ?>

                            <?php
                            $nisn = $pembayaran['nisns'];
                            $pembayaranspp = mysqli_query($connect, "SELECT SUM(jumlah_bayar) as jumlah_bayar FROM pembayaran WHERE nisns=$nisn");
                            $pembayaran_spp = mysqli_fetch_array($pembayaranspp);
                            $jumlah_pembayaran = $pembayaran_spp['jumlah_bayar'];
                            $kekurangan = $pembayaran['nominal'] - $jumlah_pembayaran;
                            ?>

                            <tr class="text-center">
                                <th scope="row"><?php echo $no++; ?></th>
                                <td><?= $pembayaran['nama'] ?></td>
                                <td><?= $pembayaran['nisn']  ?></td>
                                <td>Rp.<?= number_format($pembayaran['nominal'], 0, ',', '.')  ?></td>
                                <td><?= $pembayaran['tgl_bayar']   ?></td>
                                <td><?= $pembayaran['bulan_bayar']   ?></td>
                                <td><?= $pembayaran['tahun_bayar']   ?></td>
                                <td>Rp.<?= number_format($jumlah_pembayaran, 0, ',', '.') ?></td>
                                <td>Rp.<?= number_format($kekurangan, 0, ',', '.') ?></td>
                                <td><?= $pembayaran['nama_petugas']   ?></td>
                                <td>
                                    <?php if ($kekurangan == 0) { ?>
                                        <span class="text-success">Lunas</s>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-danger btn-md mb-10" data-bs-toggle="modal" data-bs-target="#updateModal-<?= $pembayaran['id_pembayaran'] ?>">
                                                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-flex" width="19px">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg> -->

                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <rect x="2" y="5" width="20" height="14" rx="2" ry="2"></rect>
                                                    <line x1="2" y1="10" x2="22" y2="10"></line>
                                                    <line x1="6" y1="14" x2="10" y2="14"></line>
                                                </svg>

                                            </button>
                                        <?php } ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusModal-<?= $pembayaran['id_pembayaran'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-flex" width="19px">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>





                            <!-- Modal update -->
                            <div class="modal fade" id="updateModal-<?= $pembayaran['id_pembayaran'] ?>" tabindex="-1" aria-labelledby="updateModal-<?= $pembayaran['id_pembayaran'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="updateModal-<?= $pembayaran['id_pembayaran'] ?>Label">Edit Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action=".././controller/pembayarancontroller.php" method="post">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="id" value="<?= $pembayaran['id_pembayaran'] ?>">
                                            <div class="modal-body">
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label for="username">Username</label>
                                                        <input type="text" class="form-control" id="usernames" value="<?= $pembayaran['username'] ?>" name="usernames">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password">Password</label>
                                                        <input type="text" class="form-control" id="passwords" value="<?= $pembayaran['password'] ?>" name="passwords">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama_pembayaran">Nama pembayaran</label>
                                                        <input type="text" class="form-control" id="nama_pembayarans" value="<?= $pembayaran['nama_pembayaran'] ?>" name="nama_pembayarans">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="level">level</label>
                                                        <select class="form-select" aria-label="Default select example" name="levels" id="levels">
                                                            <option value="<?= $pembayaran['levels'] ?>" <?php $pembayaran ? $pembayaran['levels'] : ''; ?> selected disabled><?= $pembayaran['levels'] == 'admin' ? 'Admin' : 'pembayaran' ?></option>
                                                            <option value="admin">Admin</option>
                                                            <option value="pembayaran">pembayaran</option>
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
                            <div class="modal fade" id="hapusModal-<?= $pembayaran['id_pembayaran'] ?>" tabindex="-1" aria-labelledby="hapusModal-<?= $pembayaran['id_pembayaran'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="hapusModal-<?= $pembayaran['id_pembayaran'] ?>Label">Hapus Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action=".././controller/pembayarancontroller.php" method="post">
                                            <input type="hidden" name="_methods" value="DELETE">
                                            <input type="hidden" name="ids" value="<?= $pembayaran['id_pembayaran'] ?>">
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