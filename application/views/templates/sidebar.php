<?php
$hal = $this->uri->segment(2);
$username = $this->session->userdata('username');
$user = $this->db->get_where('user', ['username' => $username])->row_array();
$id_bank = $user['id_bank'];
$bank = $this->db->get_where('bank', ['id_bank' => $id_bank])->row_array();
?>

<body class="dark-edition">
    <div class="wrapper ">
        <div class="sidebar" data-color="purple" data-background-color="black" data-image="<?= base_url(); ?>assets/img/sidebar-2.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo"><a href="#" class="simple-text logo-normal">
                    Pencarian Bank - ATM <br>
                    <small>Floyd Warshall</small>
                </a></div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item <?= ($hal == 'cari') ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url(); ?>admin/cari">
                            <i class="material-icons">pageview</i>
                            <p>Temukan Lokasi Terdekat</p>
                        </a>
                    </li>
                    <li class="nav-item <?= ($hal == 'atm') ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url(); ?>admin/atm">
                            <i class="material-icons">store</i>
                            <p>ATM</p>
                        </a>
                    </li>
                    <li class="nav-item <?= ($hal == 'kantor') ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url(); ?>admin/kantor">
                            <i class="material-icons">apartment</i>
                            <p>Kantor</p>
                        </a>
                    </li>
                    <li class="nav-item dropdown <?= ($hal == 'lokasi_bank' || $hal == 'lokasi_atm' || $hal == 'lokasi_rute') ? 'active' : ''; ?>">
                        <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">location_ons</i>
                            Lokasi
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item text-dark <?= ($hal == 'lokasi_bank') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/lokasi_bank">BANK</a>
                            <a class="dropdown-item text-dark <?= ($hal == 'lokasi_atm') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/lokasi_atm">ATM</a>
                            <a class="dropdown-item text-dark <?= ($hal == 'lokasi_rute') ? 'active' : ''; ?>" href="<?= base_url(); ?>admin/lokasi_rute">RUTE</a>
                        </div>
                    </li>
                    <li class="nav-item <?= ($hal == 'graph') ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?= base_url(); ?>admin/graph">
                            <i class="material-icons">insights</i>
                            <p>Graph</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item active-pro ">
                <a class="nav-link" href="./upgrade.html">
                    <i class="material-icons">unarchive</i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> -->
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <a class="navbar-brand" href="javascript:void(0)"><?= $bank['nama_bank']; ?></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end">
                        <form class="navbar-form">
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control boxSearch" placeholder="Search...">
                                <button type="submit" class="btn btn-default btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </form>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">person</i>
                                    <p class="d-lg-none d-md-block">
                                        Account
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="<?= base_url(); ?>auth/logout"><i class="material-icons">lock</i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->