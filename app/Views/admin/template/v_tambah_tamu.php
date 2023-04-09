<?= $this->extend('admin/template/v_template'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">TAMBAH TAMU UNDANGAN</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form method="post" action="<?php echo base_url('prosesExcel'); ?>" enctype="multipart/form-data">

                        <label>Import File Excel (.xls / .xlsx) </label>
                        <div class="col-md-6 mb-1">
                            <fieldset>
                                <div class="input-group">
                                    <?= csrf_field(); ?>
                                    <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx">
                                    <button class="btn btn-primary" type="submit"> <i class="bi bi-cloud-arrow-up-fill"> </i>Upload</button>

                                </div>
                            </fieldset>
                        </div>

                        <!-- <div class="class mb-3">
                          
                            <label>Import File Excel (.xls / .xlsx) </label>
                            <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
                            <button class="btn btn-primary" type="submit"> <i class="bi bi-cloud-arrow-up-fill"> </i> Upload </button>

                        </div> -->

                    </form>
                    <div class="col-lg-6">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#default"> <i class="bi bi-plus"> </i> Tambah Data</a>
                    </div>

                </div>
            </div>
        </div>



        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uniq Code</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php $i = 1; ?>

                <tbody>
                    <?php foreach ($user as $a) : ?>
                        <tr>
                            <td> <?= $i++; ?></td>
                            <td> <?= $a['uniq_code']; ?></td>
                            <td> <?= $a['nama_tamu']; ?></td>
                            <td> <?= $a['no_telp']; ?></td>
                            <td> <?= $a['alamat']; ?></td>
                            <td>
                                <a class="text-warning"> <i class="bi bi-pencil-fill"> </i> </a> |
                                <a class="text-danger" href="" data-bs-toggle="modal" data-bs-target="#defaulHapus<?php echo $a['id']; ?>"> <i class="bi bi-trash-fill"> </i> </a>

                            </td>
                        </tr>
                    <?php endforeach;  ?>
                </tbody>

            </table>
        </div>
    </div>


    <!--Basic Modal -->
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Data Undangan</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <form method="post" action="<?php echo base_url('prosesTambahTamu'); ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php $random = random_string('alnum', 16); ?>
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label class="col-form-label">Uniq Code</label>
                            <input type="text" class="form-control" name="kode_unik" value="<?php echo $random; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Nama </label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">No Telpon / Whatsapp </label>
                            <input type="number" class="form-control" name="no_telp" value="62">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Alamat</label>
                            <textarea class="form-control" id="message-text" name="alamat"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach ($user as $a) : ?>
        <!--Delete Modal -->
        <div id="defaulHapus<?php echo $a['id']; ?>" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="container d-flex pl-0">

                            <h5 class="text text-danger" class="modal-title ml-2" id="exampleModalLabel"> <span class="bi bi-trash-fill"> </span> Delete Data</h5>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="<?php echo base_url('prosesHapusTamu'); ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <p class="text-muted">Apakah Kamu Yakin Akan Menghapus <?php echo $a['nama_tamu'] ?> ?</p>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $a['id']; ?>">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach;  ?>

</section>




<?= $this->endSection(); ?>