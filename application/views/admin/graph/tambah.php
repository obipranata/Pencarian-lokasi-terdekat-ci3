<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Insert Graph</h4>
                        <p class="card-category">Isi form dibawah ini.</p>
                    </div>
                    <script type="text/javascript">
                        var cord = [];
                    </script>
                    <div class="card-body">
                        <form action="<?= base_url(); ?>admin/graph/insert" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= $this->session->flashdata('pesan'); ?>
                                    <label>Peta</label>
                                    <br />
                                    <div id="googleMap" class="col-md-12 col-sm-12 col-xs-12" style="height: 400px;"></div>
                                    <br />
                                    <div class="row row-sm mg-t-20">
                                        <input type="hidden" id="jarak_input" class="form-control col-xs-5 col-md-5" name="jarak">
                                        <input type="hidden" id="lat" class="form-control col-xs-5 col-md-5" name="latitude">
                                        <input type="hidden" id="lng" class="form-control col-xs-5 col-md-5" name="longitude">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="bmd-label-floating" for="point_b">Lokasi Awal</label>
                                    <div class="form-group">
                                        <select class="form-control" name="lokasi_awal" id="point_b">
                                            <option class="bmd-label-floating">-Pilih-</option>
                                            <?php foreach ($lokasi as $l) { ?>
                                                <option kordinate='{"lat":<?= $l['latitude']; ?>,"lng":<?= $l['longitude']; ?>}' class="text-dark" value="<?= $l['id_lokasi']; ?>"><?= $l['nama_lokasi']; ?></option>
                                                <script type="text/javascript">
                                                    cord.push(['<?= $l['nama_lokasi']; ?>', <?= $l['latitude'] ?>, <?= $l['longitude']; ?>]);
                                                </script>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="bmd-label-floating" for="point_a">Lokasi Akhir</label>
                                    <div class="form-group">
                                        <select class="form-control" name="lokasi_akhir" id="point_a">
                                            <option class="bmd-label-floating">-Pilih-</option>
                                            <?php foreach ($lokasi as $l) { ?>
                                                <option kordinate='{"lat":<?= $l['latitude']; ?>,"lng":<?= $l['longitude']; ?>}' class="text-dark" value="<?= $l['id_lokasi']; ?>"><?= $l['nama_lokasi']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h4 id="jarak"></h4>
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
<script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
<script src="<?= base_url('assets') ?>/turfjs/turf.min.js"></script>

<script src="<?= base_url('assets') ?>/chosen/jquery-3.2.1.min.js"></script>
<script src="<?= base_url(); ?>assets/select2/select2.full.min.js"></script>
<script>
    $('#point_a').select2({
        placeholder: 'Pilih',
        allowClear: true
    });
    $('#point_b').select2({
        placeholder: 'Pilih',
        allowClear: true
    });
</script>

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
            // membuat Marker
            if (marker) {
                // pindahkan marker
                marker.setPosition(posisiTitik);
            } else {
                // buat marker baru
                marker = new google.maps.Marker({
                    position: posisiTitik,
                    map: peta,
                    draggable: true
                });
                console.log(marker);
            }
        }

        google.maps.event.addListener(map, 'click', function(event) {
            taruhMarker(this, event.latLng);
            $("#latLngs").text('Titik Kordinat : ' + event.latLng);
            $("#lat").val(event.latLng.lat());
            $("#lng").val(event.latLng.lng());
        });
        var marker;
        var markers;

        var kor1;
        var kor2;
        var flightPath;

        function addLine() {

            flightPath.setMap(map);
        }

        function removeLine() {
            flightPath.setMap(null);
        }

        function dapatkan_jarak(a, b) {
            if (a && b) {
                var lat1 = a[0];
                var lat2 = b[0];
                var lon1 = a[1];
                var lon2 = b[1];

                var R = 6371; // Radius of the earth in km
                var dLat = deg2rad(lat2 - lat1); // deg2rad below
                var dLon = deg2rad(lon2 - lon1);
                var a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c; // Distance in km
                d = d.toFixed(3);
                console.log('oke');
                $("#jarak_input").val(d);
                $("#jarak").text('Jarak : ' + d + ' Km');

                var titik_awal = JSON.parse($("#point_a option:selected").attr("kordinate"));
                var titik_akhir = JSON.parse($("#point_b option:selected").attr("kordinate"));
                var flightPathCoordinates = [
                    titik_awal, titik_akhir
                ];
                if (flightPath) {
                    removeLine();
                    flightPath = new google.maps.Polyline({
                        path: flightPathCoordinates,
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                    });
                    addLine();
                } else {
                    flightPath = new google.maps.Polyline({
                        path: flightPathCoordinates,
                        strokeColor: '#FF0000',
                        strokeOpacity: 1.0,
                        strokeWeight: 2
                    });
                    addLine();
                }

            } else {
                $("#jarak").text("Jarak Tidak Ketahui !");
            }
            // 				console.log(a+' '+b);
            /* 				  var R = 6371; // Radius of the earth in km
            				  var dLat = deg2rad(lat2-lat1);  // deg2rad below
            				  var dLon = deg2rad(lon2-lon1); 
            				  var a = 
            				    Math.sin(dLat/2) * Math.sin(dLat/2) +
            				    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
            				    Math.sin(dLon/2) * Math.sin(dLon/2)
            				    ; 
            				  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
            				  var d = R * c; // Distance in km
            // 				  return d;
            				  $("#jarak_input").val(d);
            				  $("#jarak").text('Jarak : '+d+' Km');
            					var titik_awal =  JSON.parse($("#point_a option:selected").attr("kordinate"));
            					var titik_akhir = JSON.parse($("#point_b option:selected").attr("kordinate")); */

        }

        function deg2rad(deg) {
            return deg * (Math.PI / 180)
        }
        /*             function dapatkan_jarak(a,b){
        				console.log(a+' '+b);
        				if(a && b){
        					var from = turf.point(a);
        					var to = turf.point(b);
        					var options = {units:'kilometers'};
        					var distance = turf.distance(from,to,options);
        					$("#jarak").text('Jarak : '+distance+' Km');
        					$("#jarak_input").val(distance);
        					var titik_awal =  JSON.parse($("#point_a option:selected").attr("kordinate"));
        					var titik_akhir =  JSON.parse($("#point_b option:selected").attr("kordinate"));


        					var flightPathCoordinates = [
        						titik_awal,titik_akhir
        					];
        					if(flightPath){
        						removeLine();
            			        flightPath = new google.maps.Polyline({
        				          path: flightPathCoordinates,
        				          strokeColor: '#FF0000',
        				          strokeOpacity: 1.0,
        				          strokeWeight: 2
        				        });
            					addLine();
        					}else{
        			        flightPath = new google.maps.Polyline({
        				          path: flightPathCoordinates,
        				          strokeColor: '#FF0000',
        				          strokeOpacity: 1.0,
        				          strokeWeight: 2
        				        });
            					addLine();
        					}
        					
        				}else{
        					$("#jarak").text("Jarak Tidak Ketahui !");
        				}
                    } */
        var locations = cord;
        var infowindow = new google.maps.InfoWindow({});

        var marker, count;
        for (count = 0; count < locations.length; count++) {
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

            google.maps.event.addListener(marker, 'click', (function(marker, count) {
                return function() {
                    infowindow.setContent(locations[count][0]);
                    infowindow.open(map, marker);
                }
            })(marker, count));
        }


        $("#point_a").change(function() {
            var latLngs = $("#point_a option:selected").attr("kordinate");
            var latLngs = JSON.parse(latLngs);
            kor1 = [latLngs.lat, latLngs.lng];
            $('#point_a,#point_b option').each(function() {
                if (this.selected)
                    dapatkan_jarak(kor1, kor2);
            });
        });
        $("#point_b").change(function() {
            var latLngs = $("#point_b option:selected").attr("kordinate");
            var latLngs = JSON.parse(latLngs);
            var titik_awal = [latLngs.lat, latLngs.lng];
            var titik_akhir = [latLngs.lat, latLngs.lng];
            kor2 = [latLngs.lat, latLngs.lng];
            $('#point_a,#point_b option').each(function() {
                if (this.selected)
                    dapatkan_jarak(kor1, kor2);
            });

        });


    }
</script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-ExGkrwcp0PSoCWV-7kXLH7-Mow-6eAI&callback=myMap"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5JYTKYZkT937FPQ11gt0-zKRdtjtLH0M&callback=myMap"></script>