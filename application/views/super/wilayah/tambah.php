<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Insert Wilayah</h4>
                        <p class="card-category">Isi form dibawah ini.</p>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>super/wilayah/insert" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nama Wilayah</label>
                                        <input type="text" class="form-control" name="nama_wilayah">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block pull-right btn-success">Simpan</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>