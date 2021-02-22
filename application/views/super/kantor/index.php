<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Data Kantor</h4>
                    </div>
                    <div class="card-body">
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