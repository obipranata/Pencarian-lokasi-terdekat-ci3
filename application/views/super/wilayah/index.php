<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Data Wilayah</h4>
                        <a href="<?= base_url(); ?>super/wilayah/tambah" class="btn btn-sm btn-warning">+</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Name Wilayah
                                    </th>
                                    <th class="text-center">
                                        Aksi
                                    </th>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($wilayah as $w) { ?>
                                        <tr class="isiTabel">
                                            <td>
                                                <?= ++$i; ?>
                                            </td>
                                            <td>
                                                <?= $w['nama_wilayah']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url(); ?>super/wilayah/ubah/<?= $w['id_wilayah']; ?>" class="btn btn-sm btn-rounded btn-warning">
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