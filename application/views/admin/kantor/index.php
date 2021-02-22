<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Data Kantor</h4>
                        <a href="<?= base_url(); ?>admin/kantor/tambah" class="btn btn-sm btn-warning">+</a>
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
                                        Nama Kantor
                                    </th>
                                    <th>
                                        Alamat
                                    </th>
                                    <th>
                                        No Telp
                                    </th>
                                    <th>
                                        Keterangan
                                    </th>
                                    <th>
                                        BANK
                                    </th>
                                    <th>
                                        Wilayah
                                    </th>
                                    <th class="text-center">
                                        Aksi
                                    </th>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    <?php foreach ($kantor as $k) { ?>
                                        <tr class="isiTabel">
                                            <td>
                                                <?= ++$i; ?>
                                            </td>
                                            <td>
                                                <?= $k['nama_kantor']; ?>
                                            </td>
                                            <td>
                                                <?= $k['alamat']; ?>
                                            </td>
                                            <td>
                                                <?= $k['no_telp']; ?>
                                            </td>
                                            <td>
                                                <?= $k['keterangan']; ?>
                                            </td>
                                            <td>
                                                <?= $k['id_bank']; ?>
                                            </td>
                                            <td>
                                                <?= $k['nama_wilayah']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url(); ?>admin/kantor/ubah/<?= $k['id_kantor']; ?>" class="btn btn-sm btn-rounded btn-warning">
                                                    <i class="material-icons text-white">
                                                        edit
                                                    </i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url(); ?>admin/kantor/hapus/<?= $k['id_kantor']; ?>" class="btn btn-sm btn-rounded btn-danger">
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