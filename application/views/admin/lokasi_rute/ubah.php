<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Update Lokasi</h4>
                        <p class="card-category">Isi form dibawah ini.</p>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>admin/lokasi_rute/ubah/<?= $lokasi['id_lokasi']; ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Peta</label>
                                    <br />
                                    <div id="googleMap" class="col-md-12 col-sm-12 col-xs-12" style="height: 400px;"></div>
                                    <br />
                                    <p id="latLngs"></p>
                                    <div class="row row-sm mg-t-20">
                                        <input type="hidden" id="lat" class="form-control col-xs-5 col-md-5" name="latitude" value="<?= $lokasi['longitude']; ?>">
                                        <input type="hidden" id="lng" class="form-control col-xs-5 col-md-5" name="longitude" value="<?= $lokasi['latitude']; ?>">
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
<script type="text/javascript">
    var cord = [];
</script>
<?php foreach ($point_lokasi as $p) { ?>
    <script type="text/javascript">
        cord.push(['<?= $p['nama_lokasi']; ?>', <?= $p['latitude'] ?>, <?= $p['longitude']; ?>,
            '<?php if ($p['is_atm_bank'] == 1) {
                    echo 'BANK';
                } else if ($p['is_atm_bank'] == 2) {
                    echo 'ATM';
                } else if ($p['is_atm_bank'] == 0) {
                    echo 'RUTE';
                } ?>'
        ]);
    </script>
<?php } ?>
<!-- <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script> -->
<script type="text/javascript">
    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(-2.53371, 140.71813),
            zoom: 13,
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        var marker;

        function taruhMarker(peta, posisiTitik) {
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta,
                draggable: true
            });
            console.log(marker);
        }
        google.maps.event.addListener(map, 'click', function(event) {
            taruhMarker(this, event.latLng);
            $("#latLngs").text('Titik Kordinat : ' + event.latLng.lat() + ' , ' + event.latLng.lng());
            $("#lat").val(event.latLng.lat());
            $("#lng").val(event.latLng.lng());
        });

        var locations = cord;
        var infowindow = new google.maps.InfoWindow({});

        var marker, count;


        for (count = 0; count < locations.length; count++) {
            if (locations[count][3] == 'RUTE') {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                    map: map,
                    title: locations[count][0],
                    label: {
                        text: locations[count][0],
                        color: "#fff",
                        fontSize: "12px",
                        fontWeight: "bold"
                    },
                });
            } else if (locations[count][3] == 'BANK') {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                    map: map,
                    icon: "<?= base_url('assets/img/bank3.png') ?>"
                });
            } else if (locations[count][3] == 'ATM') {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                    map: map,
                    icon: "<?= base_url('assets/img/atm5.png') ?>"
                });
            }

            google.maps.event.addListener(marker, 'click', (function(marker, count) {
                return function() {
                    infowindow.setContent(locations[count][0]);
                    infowindow.open(map, marker);
                }
            })(marker, count));
        }

    }
</script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-ExGkrwcp0PSoCWV-7kXLH7-Mow-6eAI&callback=myMap"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5JYTKYZkT937FPQ11gt0-zKRdtjtLH0M&callback=myMap"></script>