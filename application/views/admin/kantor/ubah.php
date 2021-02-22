<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Update Kantor</h4>
                        <p class="card-category">Isi form dibawah ini.</p>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>admin/kantor/ubah/<?= $kantor['id_kantor']; ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nama Kantor</label>
                                        <input type="text" class="form-control" name="nama_kantor" value="<?= $kantor['nama_kantor']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" value="<?= $kantor['alamat']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">No Telp</label>
                                        <input type="text" class="form-control" name="no_telp" value="<?= $kantor['no_telp']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan" value="<?= $kantor['keterangan']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="wilayah">Wilayah</label>
                                    <div class="form-group">
                                        <select class="form-control" id="wilayah" name="id_wilayah">
                                            <option class="text-dark">Pilih</option>
                                            <?php foreach ($wilayah as $w) { ?>
                                                <?php
                                                if ($w['id_wilayah'] == $kantor['id_wilayah']) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                                ?>
                                                <option <?= $selected; ?> class="text-dark" value="<?= $w['id_wilayah']; ?>"><?= $w['nama_wilayah'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block pull-right btn-success">Simpan</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets') ?>/chosen/jquery-3.2.1.min.js"></script>
<script src="<?= base_url(); ?>assets/select2/select2.full.min.js"></script>
<script>
    $('#id_bank').select2({
        placeholder: 'Pilih',
        allowClear: true
    });
    $('#wilayah').select2({
        placeholder: 'Pilih',
        allowClear: true
    });
</script>