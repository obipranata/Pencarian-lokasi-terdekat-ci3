<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Data Bank</h4>
                        <a href="<?= base_url(); ?>super/bank/tambah" class="btn btn-sm btn-warning">+</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Id Bank
                                    </th>
                                    <th>
                                        Name Bank
                                    </th>
                                    <th class="text-center">
                                        Aksi
                                    </th>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($bank as $b) { ?>
                                        <tr class="isiTabel">
                                            <td>
                                                <?= ++$i; ?>
                                            </td>
                                            <td>
                                                <?= $b['id_bank']; ?>
                                            </td>
                                            <td>
                                                <?= $b['nama_bank']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url(); ?>super/bank/ubah/<?= $b['id_bank']; ?>" class="btn btn-sm btn-rounded btn-warning">
                                                    <i class="material-icons text-white">
                                                        edit
                                                    </i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>