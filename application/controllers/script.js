
let baseurl = 'https://afim-ta.online/';
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
                console.log(startPos.coords.latitude);
                console.log(startPos.coords.longitude);

                $.ajax({
                    url: baseurl+'home/get_all_lokasi',
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
                                console.log(g);
                                console.log(index.nama_lokasi);
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
                    icon: baseurl+'assets/img/lokasi2.png',
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
                    icon: baseurl+'assets/img/bank3.png'
                });
            } else if (locations[count][3] == 'ATM') {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                    map: map,
                    icon: baseurl+'assets/img/atm5.png'
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

        $("#pilih_bank").click(function() {
            var startPos;
            var geoSuccess = function(position) {
                startPos = position;
                console.log(startPos.coords.latitude);
                console.log(startPos.coords.longitude);
                let opsi_bank = $("#opsi_bank").val();
                console.log($("#opsi_bank").val());

                $("#opsi_bank").on("change", function() {

                    $.ajax({
                        url: baseurl+'home/get_lokasi_bank',
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
                                    console.log(d);
                                    console.log(index.nama_lokasi);
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

                    console.log($("#opsi_bank").val());
                });
                $.ajax({
                    url: baseurl+'home/get_all_lokasi',
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
                                console.log(d);
                                console.log(index.nama_lokasi);
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
                    icon: baseurl+'assets/img/lokasi2.png',
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
                            icon: baseurl+'assets/img/bank3.png'
                        });
                    } else if (locations[count][3] == 'ATM') {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                            map: map,
                            icon: baseurl+'assets/img/atm5.png'
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
        $("#pilih_atm").click(function() {
            var startPos;
            var geoSuccess = function(position) {
                startPos = position;
                console.log(startPos.coords.latitude);
                console.log(startPos.coords.longitude);

                $("#opsi_bank").on("change", function() {
                    $.ajax({
                        url: baseurl+'home/get_lokasi_atm',
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
                    url: baseurl+'home/get_all_lokasi',
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
                    icon: baseurl+'assets/img/lokasi2.png',
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
                            icon: baseurl+'assets/img/bank3.png'
                        });
                    } else if (locations[count][3] == 'ATM') {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                            map: map,
                            icon: baseurl+'assets/img/atm5.png'
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
                    url: baseurl+'home/get_all_lokasi',
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

            console.log(bank_atm_terdekat);

            $.ajax({
                url: baseurl+'home/get_all_lokasi',
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
                                icon: baseurl+'assets/img/bank3.png'
                            });
                        } else if (locations[count][3] == 'ATM') {
                            marker = new google.maps.Marker({
                                position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                                map: map,
                                icon: baseurl+'assets/img/atm5.png'
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
                url: baseurl+'home/jalur_terdekat',
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

                        console.log(a);
                        console.log(kor[0]);
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