<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Data Graph</h4>
                        <a href="<?= base_url(); ?>admin/graph/tambah" class="btn btn-sm btn-warning">+</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Lokasi Awal
                                    </th>
                                    <th>
                                        Lokasi Akhir
                                    </th>
                                    <th>
                                        Jarak
                                    </th>
                                    <th class="text-center">
                                        Aksi
                                    </th>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($graph as $g) { ?>
                                        <tr class="isiTabel">
                                            <td>
                                                <?= ++$i; ?>
                                            </td>
                                            <td>
                                                <?= $g['lok_awal']; ?>
                                            </td>
                                            <td>
                                                <?= $g['lok_tujuan']; ?>
                                            </td>
                                            <td>
                                                <?= $g['jarak']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url(); ?>admin/graph/delete/<?= $g['lokasi_awal']; ?>/<?= $g['lokasi_akhir']; ?>" class="btn btn-sm btn-rounded btn-danger">
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