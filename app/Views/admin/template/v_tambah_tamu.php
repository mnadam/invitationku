<?= $this->extend('admin/template/v_template'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            DAFTAR UNDANGAN
        </div>
        <form method="post" action="<?php echo base_url('prosesExcel'); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label>File Excel</label>
                <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Upload</button>
            </div>
        </form>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uniq Code</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>AKsi</th>
                    </tr>
                </thead>
                <?php $i = 1; ?>
                <?php foreach ($user as $a) : ?>
                    <tbody>
                        <tr>
                            <td> <?= $i++; ?></td>
                            <td> <?= $a['uniq_code']; ?></td>
                            <td> <?= $a['nama_tamu']; ?></td>
                            <td> <?= $a['alamat']; ?></td>
                            <td>
                                <span class="badge bg-success">Active</span>
                            </td>
                        </tr>


                    </tbody>

                <?php endforeach;  ?>
            </table>
        </div>
    </div>

</section>

<?= $this->endSection(); ?>