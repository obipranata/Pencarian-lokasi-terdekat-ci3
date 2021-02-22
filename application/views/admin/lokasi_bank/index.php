<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Data Lokasi</h4>
                        <a href="<?= base_url(); ?>admin/lokasi_bank/tambah" class="btn btn-sm btn-warning">+</a>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Name Lokasi
                                    </th>
                                    <th class="text-center">
                                        Latitude
                                    </th>
                                    <th class="text-center">
                                        Longitude
                                    </th>
                                    <th class="text-center">
                                        Alamat
                                    </th>
                                    <th colspan="2" class="text-center">
                                        Aksi
                                    </th>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($lokasi as $l) { ?>
                                        <tr class="isiTabel">
                                            <td>
                                                <?= ++$i; ?>
                                            </td>
                                            <td>
                                                <?= $l['nama_lokasi']; ?>
                                            </td>
                                            <td>
                                                <?= $l['latitude']; ?>
                                            </td>
                                            <td>
                                                <?= $l['longitude']; ?>
                                            </td>
                                            <td>
                                                <?= $l['alamat']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url(); ?>admin/lokasi_bank/ubah/<?= $l['id_lokasi']; ?>" class="btn btn-sm btn-rounded btn-warning">
                                                    <i class="material-icons text-white">
                                                        edit
                                                    </i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url(); ?>admin/lokasi_bank/hapus/<?= $l['id_lokasi']; ?>" class="btn btn-sm btn-rounded btn-danger">
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