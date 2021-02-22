<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Data ATM</h4>
                        <a href="<?= base_url(); ?>admin/atm/tambah" class="btn btn-sm btn-warning">+</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Nama ATM
                                    </th>
                                    <th>
                                        Wilayah
                                    </th>
                                    <th>
                                        BANK
                                    </th>
                                    <th class="text-center" colspan="2">
                                        Aksi
                                    </th>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($atm as $a) { ?>
                                        <tr class="isiTabel">
                                            <td>
                                                <?= ++$i; ?>
                                            </td>
                                            <td>
                                                <?= $a['nama_atm']; ?>
                                            </td>
                                            <td>
                                                <?= $a['nama_wilayah']; ?>
                                            </td>
                                            <td>
                                                <?= $a['id_bank']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url(); ?>admin/atm/ubah/<?= $a['id_atm']; ?>" class="btn btn-sm btn-rounded btn-warning">
                                                    <i class="material-icons text-white">
                                                        edit
                                                    </i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url(); ?>admin/atm/delete/<?= $a['id_atm']; ?>" class="btn btn-sm btn-rounded btn-danger">
                                                    <i class="material-icons text-white">
                                                        delete
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