<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Afim - Rute Terpendek</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/user/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/user/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/user/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="<?= base_url(); ?>assets/user/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/user/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link href="<?= base_url(); ?>assets/select2/select2.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700;800&display=swap" rel="stylesheet" />
    <!-- Line Awesome CDN Link -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

</head>

<style>
    .main-container {
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .main-container h2 {
        margin: 0 0 80px 0;
        color: #8373e6;
        font-size: 30px;
        font-family: "Raleway", sans-serif;
        font-weight: 400;
    }

    .radio-buttons {
        width: 100%;
        margin: 0 auto;
        text-align: center;
    }

    .custom-radio input {
        display: none;
    }

    .radio-btn {
        margin: 10px;
        width: 180px;
        height: 200px;
        border: 3px solid transparent;
        display: inline-block;
        border-radius: 10px;
        position: relative;
        text-align: center;
        box-shadow: 0 0 20px #c3c3c367;
        cursor: pointer;
    }

    .radio-btn>i {
        color: #ffffff;
        background-color: #8373e6;
        font-size: 20px;
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%) scale(4);
        border-radius: 50px;
        padding: 3px;
        transition: 0.2s;
        pointer-events: none;
        opacity: 0;
    }

    .radio-btn .hobbies-icon {
        width: 80px;
        height: 80px;
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .radio-btn .hobbies-icon i {
        color: #8373e6;
        line-height: 80px;
        font-size: 60px;
    }

    .radio-btn .hobbies-icon h3 {
        color: #8373e6;
        font-family: "Raleway", sans-serif;
        font-size: 16px;
        font-weight: 400;
        text-transform: uppercase;
    }

    .custom-radio input:checked+.radio-btn {
        border: 3px solid #8373e6;
    }

    .custom-radio input:checked+.radio-btn>i {
        opacity: 1;
        transform: translateX(-50%) scale(1);
    }
</style>

<body>
    <!--header section start -->
    <div class="header_section header_bg">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- <div class="logo"><a href="index.html"><img src="<?= base_url(); ?>assets/user/images/logo.png"></a></div> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning btn-sm text-white" href="<?= base_url(); ?>auth">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!--header section end
    <!-- contact section start -->
    <div class="contact_section layout_padding">
        <div class="container-fluid">
            <h1 class="what_taital">Rute terpendek dengan algoritma Floyd Warshall</h1>
            <p class="amet_text"> Silahkan cari bank atau atm yang ada di Kota Jayapura dan Kabupaten Jayapura. </p>
            <div class="contact_section2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card bg-dark">
                                <script type="text/javascript">
                                    var cord = [];
                                </script>
                                <div class="card-body">
                                    <form id="form_jalur_terdekat">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="main-container">
                                                            <h2>Pilih rute bank atau atm?</h2>
                                                            <div class="radio-buttons">
                                                                <label class="custom-radio">
                                                                    <input type="radio" id="pilih_bank" name="radio" onclick="handleClick(this);" value="false" />
                                                                    <span class="radio-btn"><i class="las la-check"></i>
                                                                        <div class="hobbies-icon">
                                                                            <i class="las la-building"></i>
                                                                            <h3>BANK</h3>
                                                                        </div>
                                                                    </span>
                                                                </label>
                                                                <label class="custom-radio">
                                                                    <input type="radio" id="pilih_atm" name="radio" onclick="handleClick(this);" value="true" />
                                                                    <span class="radio-btn"><i class="las la-check"></i>
                                                                        <div class="hobbies-icon">
                                                                            <i class="las la-money-check"></i>
                                                                            <h3>ATM</h3>
                                                                        </div>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <form action="<?= base_url(); ?>home" method="get">
                                                        <div class="col-md-12">
                                                            <div class="form-group mt-3">
                                                                <label for="" class="">Pilih BANK</label> <br>
                                                                <select class="form-control" name="opsi_bank" id="opsi_bank">
                                                                    <option class="bmd-label-floating" value="all">Pilih Bank (Optional)</option>
                                                                    <?php foreach ($opsi_bank as $l) { ?>
                                                                        <option class="text-dark" value="<?= $l['id_bank']; ?>"><?= $l['nama_bank']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="col-md-12">
                                                        <div class="form-group mt-3">
                                                            <label for="" class="">Pilih Lokasi Awal</label> <br>
                                                            <select class="form-control " name="point_a" id="point_a">
                                                                <option class="bmd-label-floating" id="node_terdekat">Pilih Lokasi Awal (Optional)</option>
                                                                <?php foreach ($lokasi_rute as $l) { ?>
                                                                    <option kordinate='{"lat":<?= $l['latitude']; ?>,"lng":<?= $l['longitude']; ?>}' class="text-dark" value="<?= $l['id_lokasi']; ?>"><?= $l['nama_lokasi']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php foreach ($lokasi as $l) { ?>
                                                                <script type="text/javascript">
                                                                    cord.push(['<?= $l['nama_lokasi']; ?>', <?= $l['latitude'] ?>, <?= $l['longitude']; ?>,
                                                                        '<?php if ($l['is_atm_bank'] == 1) {
                                                                                echo 'BANK';
                                                                            } else if ($l['is_atm_bank'] == 2) {
                                                                                echo 'ATM';
                                                                            } else if ($l['is_atm_bank'] == 0) {
                                                                                echo 'RUTE';
                                                                            } ?>'
                                                                    ]);
                                                                </script>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12" id="bank">
                                                        <div class="form-group mt-3 ">
                                                            <label for="" class="">Pilih Lokasi Akhir</label> <br>
                                                            <select class="form-control bank select" data-placeholder="" name="point_b" id="point_b_bank">
                                                                <option selected class="bmd-label-floating text-dark" id="lokasi_bank_terdekat">Pilih Lokasi BANK (optional)</option>
                                                                <?php foreach ($lokasi_bank as $l) { ?>
                                                                    <option kordinate='{"lat":<?= $l['latitude']; ?>,"lng":<?= $l['longitude']; ?>}' class="text-dark" value="<?= $l['id_lokasi']; ?>">
                                                                        <?= $l['nama_lokasi']; ?> <br>
                                                                        (<?= $l['nama_bank']; ?>) || <?= $l['alamat']; ?> <br>
                                                                        <?= $l['nama_kantor']; ?> || <?= $l['nama_wilayah']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="atm">
                                                        <div class="form-group mt-3 ">
                                                            <label for="" class="">Pilih Lokasi Akhir</label> <br>
                                                            <select class="form-control atm select" data-placeholder="" name="point_b" id="point_b_atm">
                                                                <option class="bmd-label-floating" id="lokasi_atm_terdekat">Pilih Lokasi ATM (optional)</option>
                                                                <?php foreach ($lokasi_atm as $l) { ?>
                                                                    <option kordinate='{"lat":<?= $l['latitude']; ?>,"lng":<?= $l['longitude']; ?>}' class="text-dark" value="<?= $l['id_lokasi']; ?>"><?= $l['nama_lokasi']; ?> <br>
                                                                        (<?= $l['nama_atm']; ?>) || <?= $l['alamat']; ?>, <br>
                                                                        <?= $l['nama_bank']; ?> || <?= $l['nama_wilayah']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="button" class="btn btn-primary btn-block btn-success" id="cari_rute">Lihat Rute</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12" id="jarak_rute">
                                                <div class="card bg-primary-dark tx-white mt-4">
                                                    <div class="card-body">
                                                        <h5>Jarak :</h5>
                                                        <div>
                                                            <h6><span id="hasil"></span></h6>
                                                        </div>
                                                        <h5>Rute <br /></h5>
                                                        <div>
                                                            <h6><span id="rute_terdekat"></span></h6>
                                                        </div>
                                                        <div>
                                                            <h6><span id="perhitungan"></span></h6>
                                                        </div>
                                                        <div>
                                                            <h6><span id="nama_node"></span></h6>
                                                        </div>


                                                    </div><!-- card-body -->
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <br />
                                                <div id="googleMap" class="col-md-12 col-sm-12 col-xs-12" style="height: 600px;"></div>
                                                <br />
                                                <div class="col-md-12">
                                                    <h4 id="jarak"></h4>
                                                </div>
                                                <div class="row row-sm mg-t-20">
                                                    <input type="hidden" id="jarak_input" class="form-control col-xs-5 col-md-5" name="jarak">
                                                    <input type="hidden" id="lat" class="form-control col-xs-5 col-md-5" name="latitude">
                                                    <input type="hidden" id="lng" class="form-control col-xs-5 col-md-5" name="longitude">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact section end -->
    <!--footer section start -->
    <div class="footer_section  margin_top_90">
        <div class="container">
            <!-- copyright section start -->
            <div class="copyright_section">
                <div class="copyright_text">BY - AFIM</div>
            </div>
            <!-- copyright section end -->
        </div>
    </div>
    <!--footer section end -->
    <!-- Javascript files-->
    <script src="<?= base_url(); ?>assets/user/js/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>assets/user/js/plugin.js"></script>
    <!-- sidebar -->
    <!-- sidebar -->
    <script src="<?= base_url(); ?>assets/user/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= base_url(); ?>assets/user/js/custom.js"></script>
    <!-- javascript -->
    <script src="<?= base_url('assets') ?>/chosen/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/select2/select2.full.min.js"></script>
    <script>
        $('#opsi_bank').select2({
            placeholder: 'Pilih',
            allowClear: true
        });
        $('#point_a').select2({
            placeholder: 'Pilih',
            allowClear: true
        });
        $('#point_b_bank').select2({
            placeholder: 'Pilih',
            allowClear: true
        });
        $('#point_b_atm').select2({
            placeholder: 'Pilih',
            allowClear: true
        });
    </script>
</body>

</html>

<script type="text/javascript">
    var bank = document.getElementById("bank");
    var atm = document.getElementById("atm");
    var point_bank = document.getElementById("point_b_bank");
    var point_atm = document.getElementById("point_b_atm");
    var jarak_rute = document.getElementById("jarak_rute");

    bank.style.display = "none";
    atm.style.display = "none";
    jarak_rute.style.display = "none";

    function handleClick(myRadio) {
        if (myRadio.value == "true") {
            point_bank.disabled = true;
            point_atm.disabled = false;
            bank.style.display = "none";
            atm.style.display = "";
        } else if (myRadio.value == "false") {
            bank.style.display = "";
            atm.style.display = "none";
            point_atm.disabled = true;
            point_bank.disabled = false;
        }
    }
</script>
<script type="text/javascript">
    var locations = cord,
        marker = [];

    function myMap() {

        var mapProp = {
            center: new google.maps.LatLng(-2.53371, 140.71813),
            zoom: 13,
        };
        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        window.onload = function() {
            var startPos;
            var geoSuccess = function(position) {
                startPos = position;
                // console.log(startPos.coords.latitude);
                // console.log(startPos.coords.longitude);

                $.ajax({
                    url: "<?= base_url('home/get_all_lokasi') ?>",
                    type: "POST",
                    data: {

                    },
                    success: function(e) {
                        var obj_spbu = JSON.parse(e);
                        dapat_node = [];
                        dapat_node_terpendek = [];
                        obj_spbu.forEach(function(index) {
                            let cek_atm_bank;
                            if (index.is_atm_bank == 0) {
                                var lat1 = startPos.coords.latitude;
                                var lat2 = index.latitude;
                                var lon1 = startPos.coords.longitude;
                                var lon2 = index.longitude;

                                var Radius = 6371; // Radius of the earth in km
                                var dLat = deg2rad(lat2 - lat1); // deg2rad below
                                var dLon = deg2rad(lon2 - lon1);
                                var e =
                                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                                    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                                var f = 2 * Math.atan2(Math.sqrt(e), Math.sqrt(1 - e));
                                var g = Radius * f; // Distance in km
                                g = g.toFixed(3);
                                dapat_node.push([index.id_lokasi, index.latitude, index.longitude, g, index.nama_lokasi]);
                                dapat_node_terpendek.push([g]);
                                // console.log(g);
                                // console.log(index.nama_lokasi);
                            }
                        });
                        for (count = 0; count < dapat_node.length; count++) {
                            if (dapat_node[count][3] == Math.min.apply(Math, dapat_node_terpendek)) {
                                document.getElementById("point_a").value = dapat_node[count][0];
                                document.getElementById("point_a").html(dapat_node[count][4]);
                            }
                        }
                    }
                })

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(startPos.coords.latitude, startPos.coords.longitude),
                    map: map,
                    icon: "<?= base_url('assets/img/lokasi2.png') ?>",
                    animation: google.maps.Animation.BOUNCE
                });
                var infowindowText = "<div class='text-center'><strong>Posisi Saat Ini</strong> Lat : " +
                    startPos.coords.latitude + " | Long: " + startPos.coords.longitude + "</strong></div>";
                infowindow.setContent(infowindowText);
                infowindow.open(map, marker);
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            };
            navigator.geolocation.getCurrentPosition(geoSuccess);
        };


        /*Dapatkan Jarak  */
        function deg2rad(deg) {
            return deg * (Math.PI / 180);
        }

        function dapatkan_jarak(lat1, lon1, lat2, lon2) {
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
            return d;
        }
        var flightPath;

        function addLine() {
            flightPath.setMap(map);
        }

        function removeLine() {
            flightPath.setMap(null);
        }

        function buatGaris(b) {

            if (flightPath) {
                removeLine();
                flightPath = new google.maps.Polyline({
                    path: b,
                    strokeColor: 'blue',
                    strokeOpacity: 1.0,
                    strokeWeight: 8
                });
                addLine();
            } else {
                flightPath = new google.maps.Polyline({
                    path: b,
                    strokeColor: 'blue',
                    strokeOpacity: 1.0,
                    strokeWeight: 8
                });
                addLine();
            }
        }
        var infowindow = new google.maps.InfoWindow({});
        var dataa = [];

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
            dataa.push(marker);
            google.maps.event.addListener(marker, 'click', (function(marker, count) {
                return function() {
                    if (locations[count][3] == 'BANK') {
                        infowindow.setContent("<h1 class='az-content-label mg-b-5'>" + locations[count][0] + "</h1><hr><p class='az-content-label mg-b-5' font-size='9px'>Titik Kordinat</p><p>" + locations[count][1] + "," + locations[count][2] + "</p>");
                        infowindow.open(map, marker);
                    } else {
                        infowindow.setContent("<h1 class='az-content-label mg-b-5'>Rute " + locations[count][0] + "</h1><hr><p class='az-content-label mg-b-5' font-size='9px'>Titik Kordinat</p><p>" + locations[count][1] + "," + locations[count][2] + "</p>");
                        infowindow.open(map, marker);
                    }
                }
            })(marker, count));
        }
        // console.log(locations);

        function removeMarkers() {
            for (i = 0; i < dataa.length; i++) {
                dataa[i].setMap(null);
            }
            console.log('Marker has removed');
        }

        $("#pilih_bank").click(function() {
            var startPos;
            var geoSuccess = function(position) {
                startPos = position;
                // console.log(startPos.coords.latitude);
                // console.log(startPos.coords.longitude);
                let opsi_bank = $("#opsi_bank").val();
                // console.log($("#opsi_bank").val());

                $("#opsi_bank").on("change", function() {

                    $.ajax({
                        url: "<?= base_url('home/get_lokasi_bank') ?>",
                        type: "POST",
                        data: {
                            // id_bank = $("#opsi_bank").val()
                        },
                        // tanda
                        success: function(e) {
                            var obj_spbu = JSON.parse(e);
                            dapat_lokasi = [];
                            dapat_lok_terpendek = [];
                            obj_spbu.forEach(function(index) {
                                let cek_atm_bank;
                                if (index.is_atm_bank == 1 && index.id_bank == $("#opsi_bank").val()) {
                                    var lat1 = startPos.coords.latitude;
                                    var lat2 = index.latitude;
                                    var lon1 = startPos.coords.longitude;
                                    var lon2 = index.longitude;

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
                                    dapat_lokasi.push([index.id_lokasi, index.latitude, index.longitude, d, index.nama_lokasi]);
                                    dapat_lok_terpendek.push([d]);
                                    // console.log(d);
                                    // console.log(index.nama_lokasi);
                                }
                            });
                            for (count = 0; count < dapat_lokasi.length; count++) {
                                if (dapat_lokasi[count][3] == Math.min.apply(Math, dapat_lok_terpendek)) {
                                    document.getElementById("lokasi_bank_terdekat").value = dapat_lokasi[count][0];
                                    document.getElementById("lokasi_bank_terdekat").html(dapat_lokasi[count][4]);
                                }
                            }
                        }
                    });

                    // console.log($("#opsi_bank").val());
                });
                $.ajax({
                    url: "<?= base_url('home/get_all_lokasi') ?>",
                    type: "POST",
                    data: {
                        // id_bank = $("#opsi_bank").val()
                    },
                    // tanda
                    success: function(e) {
                        var obj_spbu = JSON.parse(e);
                        dapat_lokasi = [];
                        dapat_lok_terpendek = [];
                        obj_spbu.forEach(function(index) {
                            let cek_atm_bank;
                            if (index.is_atm_bank == 1) {
                                var lat1 = startPos.coords.latitude;
                                var lat2 = index.latitude;
                                var lon1 = startPos.coords.longitude;
                                var lon2 = index.longitude;

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
                                dapat_lokasi.push([index.id_lokasi, index.latitude, index.longitude, d, index.nama_lokasi]);
                                dapat_lok_terpendek.push([d]);
                                // console.log(d);
                                // console.log(index.nama_lokasi);
                            }
                        });
                        for (count = 0; count < dapat_lokasi.length; count++) {
                            if (dapat_lokasi[count][3] == Math.min.apply(Math, dapat_lok_terpendek)) {
                                document.getElementById("lokasi_bank_terdekat").value = dapat_lokasi[count][0];
                                document.getElementById("lokasi_bank_terdekat").html(dapat_lokasi[count][4]);
                            }
                        }
                    }
                });

                var mapProp = {
                    center: new google.maps.LatLng(startPos.coords.latitude, startPos.coords.longitude),
                    zoom: 16
                };
                map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(startPos.coords.latitude, startPos.coords.longitude),
                    map: map,
                    icon: "<?= base_url('assets/img/lokasi2.png') ?>",
                    animation: google.maps.Animation.BOUNCE
                });
                var infowindowText = "<div class='text-center'><strong>Posisi Saat Ini</strong> Lat : " +
                    startPos.coords.latitude + " | Long: " + startPos.coords.longitude + "</strong></div>";
                infowindow.setContent(infowindowText);
                infowindow.open(map, marker);
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });

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
                    dataa.push(marker);
                    google.maps.event.addListener(marker, 'click', (function(marker, count) {
                        return function() {
                            if (locations[count][3] == 'BANK') {
                                infowindow.setContent("<h1 class='az-content-label mg-b-5'>" + locations[count][0] + "</h1><hr><p class='az-content-label mg-b-5' font-size='9px'>Titik Kordinat</p><p>" + locations[count][1] + "," + locations[count][2] + "</p>");
                                infowindow.open(map, marker);
                            } else {
                                infowindow.setContent("<h1 class='az-content-label mg-b-5'>Rute " + locations[count][0] + "</h1><hr><p class='az-content-label mg-b-5' font-size='9px'>Titik Kordinat</p><p>" + locations[count][1] + "," + locations[count][2] + "</p>");
                                infowindow.open(map, marker);
                            }
                        }
                    })(marker, count));
                }
                // console.log(locations);

                function removeMarkers() {
                    for (i = 0; i < dataa.length; i++) {
                        dataa[i].setMap(null);
                    }
                    console.log('Marker has removed');
                }

            };
            navigator.geolocation.getCurrentPosition(geoSuccess);
        });
        $("#pilih_atm").click(function() {
            var startPos;
            var geoSuccess = function(position) {
                startPos = position;
                // console.log(startPos.coords.latitude);
                // console.log(startPos.coords.longitude);

                $("#opsi_bank").on("change", function() {
                    $.ajax({
                        url: "<?= base_url('home/get_lokasi_atm') ?>",
                        type: "POST",
                        data: {

                        },
                        success: function(e) {
                            var obj_spbu = JSON.parse(e);
                            dapat_lokasi = [];
                            dapat_lok_terpendek = [];
                            obj_spbu.forEach(function(index) {
                                let cek_atm_bank;
                                if (index.is_atm_bank == 2 && index.id_bank == $("#opsi_bank").val()) {
                                    var lat1 = startPos.coords.latitude;
                                    var lat2 = index.latitude;
                                    var lon1 = startPos.coords.longitude;
                                    var lon2 = index.longitude;

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
                                    dapat_lokasi.push([index.id_lokasi, index.latitude, index.longitude, d, index.nama_lokasi]);
                                    dapat_lok_terpendek.push([d]);
                                    // console.log(d);
                                    // console.log(index.nama_lokasi);
                                }

                            });
                            for (count = 0; count < dapat_lokasi.length; count++) {
                                if (dapat_lokasi[count][3] == Math.min.apply(Math, dapat_lok_terpendek)) {
                                    document.getElementById("lokasi_atm_terdekat").value = dapat_lokasi[count][0];
                                    document.getElementById("lokasi_atm_terdekat").html(dapat_lokasi[count][4]);
                                }
                            }
                        }
                    });
                });

                $.ajax({
                    url: "<?= base_url('home/get_all_lokasi') ?>",
                    type: "POST",
                    data: {

                    },
                    success: function(e) {
                        var obj_spbu = JSON.parse(e);
                        dapat_lokasi = [];
                        dapat_lok_terpendek = [];
                        obj_spbu.forEach(function(index) {
                            let cek_atm_bank;
                            if (index.is_atm_bank == 2) {
                                var lat1 = startPos.coords.latitude;
                                var lat2 = index.latitude;
                                var lon1 = startPos.coords.longitude;
                                var lon2 = index.longitude;

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
                                dapat_lokasi.push([index.id_lokasi, index.latitude, index.longitude, d, index.nama_lokasi]);
                                dapat_lok_terpendek.push([d]);
                                // console.log(d);
                                // console.log(index.nama_lokasi);
                            }

                        });
                        for (count = 0; count < dapat_lokasi.length; count++) {
                            if (dapat_lokasi[count][3] == Math.min.apply(Math, dapat_lok_terpendek)) {
                                document.getElementById("lokasi_atm_terdekat").value = dapat_lokasi[count][0];
                                document.getElementById("lokasi_atm_terdekat").html(dapat_lokasi[count][4]);
                            }
                        }
                    }
                });

                var mapProp = {
                    center: new google.maps.LatLng(startPos.coords.latitude, startPos.coords.longitude),
                    zoom: 16
                };
                map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(startPos.coords.latitude, startPos.coords.longitude),
                    map: map,
                    icon: "<?= base_url('assets/img/lokasi2.png') ?>",
                    animation: google.maps.Animation.BOUNCE
                });
                var infowindowText = "<div class='text-center'><strong>Posisi Saat Ini</strong> Lat : " +
                    startPos.coords.latitude + " | Long: " + startPos.coords.longitude + "</strong></div>";
                infowindow.setContent(infowindowText);
                infowindow.open(map, marker);
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });

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
                    dataa.push(marker);
                    google.maps.event.addListener(marker, 'click', (function(marker, count) {
                        return function() {
                            if (locations[count][3] == 'BANK') {
                                infowindow.setContent("<h1 class='az-content-label mg-b-5'>" + locations[count][0] + "</h1><hr><p class='az-content-label mg-b-5' font-size='9px'>Titik Kordinat</p><p>" + locations[count][1] + "," + locations[count][2] + "</p>");
                                infowindow.open(map, marker);
                            } else {
                                infowindow.setContent("<h1 class='az-content-label mg-b-5'>Rute " + locations[count][0] + "</h1><hr><p class='az-content-label mg-b-5' font-size='9px'>Titik Kordinat</p><p>" + locations[count][1] + "," + locations[count][2] + "</p>");
                                infowindow.open(map, marker);
                            }
                        }
                    })(marker, count));
                }
                console.log(locations);

                function removeMarkers() {
                    for (i = 0; i < dataa.length; i++) {
                        dataa[i].setMap(null);
                    }
                    console.log('Marker has removed');
                }

            };
            navigator.geolocation.getCurrentPosition(geoSuccess);
        });

        $("#cari_rute").click(function(e) {
            jarak_rute.style.display = "";
            e.preventDefault();

            e.preventDefault();
            var jns = $("#jns").val();
            removeMarkers();
            var bank_atm_terdekat;

            var radiusx = $('#radius option:selected').val();
            var id_lok = $("#point_a option:selected").attr("kordinate");
            var id_loks = JSON.parse(id_lok);
            if (id_lok != '') {
                $.ajax({
                    url: "<?= base_url('home/get_all_lokasi') ?>",
                    success: function(html) {
                        var Obj = JSON.parse(html);
                        var d = [];
                        Obj.forEach(function(index) {
                            d.push([index.id_lokasi, index.nama_lokasi, dapatkan_jarak(id_loks.lat, id_loks.lng, index.latitude, index.longitude)]);
                        });
                        var x = d;
                        /* d.sort(function(a,b){
                            return a[2] > b[2];
                        }); */
                        var f = d.filter(function(e) {
                            return e[2] < radiusx;
                        });
                        bank_atm_terdekat = f;

                    }
                });
            }

            // console.log(bank_atm_terdekat);

            $.ajax({
                url: "<?= base_url('home/get_all_lokasi') ?>",
                type: "POST",
                data: {
                    jns: jns,
                    bank_atm_terdekat: bank_atm_terdekat
                },
                success: function(e) {
                    var obj_spbu = JSON.parse(e);
                    locations = [];
                    obj_spbu.forEach(function(index) {
                        let cek_atm_bank;
                        if (index.is_atm_bank == 1) {
                            cek_atm_bank = 'BANK';
                        } else if (index.is_atm_bank == 2) {
                            cek_atm_bank = 'ATM';
                        } else if (index.is_atm_bank == 0) {
                            cek_atm_bank = 'RUTE';
                        }
                        locations.push([index.nama_lokasi, index.latitude, index.longitude, cek_atm_bank]);
                    });
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
                        dataa.push(marker);
                        google.maps.event.addListener(marker, 'click', (function(marker, count) {
                            var layanan;
                            var Fasilitas;
                            return function() {
                                if (locations[count][3] == 'BANK') {
                                    infowindow.setContent("<h1 class='az-content-label mg-b-5'> " + locations[count][0] + "</h1><hr><p class='az-content-label mg-b-5' font-size='9px'>Titik Kordinat</p><p>" + locations[count][1] + "," + locations[count][2] + "</p>");
                                    infowindow.open(map, marker);
                                } else {
                                    infowindow.setContent("<h1 class='az-content-label mg-b-5'>Rute " + locations[count][0] + "</h1><hr><p class='az-content-label mg-b-5' font-size='9px'>Titik Kordinat</p><p>" + locations[count][1] + "," + locations[count][2] + "</p>");
                                    infowindow.open(map, marker);
                                }
                            }
                        })(marker, count));
                    }
                }
            });

            var data = new FormData($("#form_jalur_terdekat")[0]);
            $.ajax({
                url: "<?php echo base_url("home/jalur_terdekat"); ?>",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(html) {
                    if (html == '') {
                        alert("Maaf, Jalur Tidak Dapat Dilalui !");
                    } else {

                        // Sets the map on all markers in the array.
                        //marker = [];

                        var a = JSON.parse(html);
                        $("#hasil").text(a.distance[0].toFixed(3) + ' Km');
                        $("#rute_terdekat").text(a.nodes[0]);
                        var kor = [];
                        a.kordinat.forEach(function(index) {
                            kor.push(JSON.parse(index));
                        });

                        // console.log(a);
                        // console.log(kor[0]);
                        var mapProp = {
                            center: new google.maps.LatLng(kor[0].lat, kor[0].lng),
                            zoom: 16,
                        };
                        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

                        buatGaris(kor);
                    }
                }
            });
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5JYTKYZkT937FPQ11gt0-zKRdtjtLH0M&callback=myMap"></script>