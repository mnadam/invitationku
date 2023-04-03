<?= $this->extend('admin/template/v_template'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            TAMU UNDANGAN
        </div>
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