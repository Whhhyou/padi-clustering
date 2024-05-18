<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        #map {
            height: 500px;
            width: 70%;
            margin-left: 150px;
            display: inline-block;
        }

        #legend {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            font-size: 0.9em;
            line-height: 1.4;
        }

        .legend-title {
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .legend-item {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .legend-color {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 5px;
            border: 1px solid #000;
        }

        .color-yellow {
            background-color: yellow;
        }

        .color-blue {
            background-color: blue;
        }

        .color-green {
            background-color: green;
        }

        .form-select {
            width: auto;
            display: inline-block;
            min-width: 100px;
        }

        .btn {
            display: inline-block;
            width: auto;
            min-width: 100px;
        }
        body {
        background-color: #f8f9fa;
    }

    .sb-topnav {
        background-color: #343a40;
    }

    .sb-sidenav {
        background-color: #343a40;
    }

    .sb-sidenav .nav-link {
        color: #adb5bd;
    }

    .sb-sidenav .nav-link:hover {
        color: #fff;
    }

    .sb-sidenav .sb-sidenav-menu .nav .sb-nav-link-icon {
        color: #adb5bd;
    }

    .sb-sidenav .sb-sidenav-menu .nav .sb-nav-link-icon:hover {
        color: #fff;
    }

    .sb-sidenav-menu .nav-link {
        font-size: 0.9rem;
    }

    main {
        padding: 20px;
    }

    table {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    table thead {
        background-color: #007bff;
        color: #fff;
    }

    table th,
    table td {
        padding: 15px;
        text-align: center;
    }

    form {
        margin-bottom: 20px;
    }

    footer {
        background-color: #f8f9fa;
        border-top: 1px solid #e9ecef;
        padding: 20px 0;
    }

    .modal-header {
        background-color: #dc3545;
        color: #fff;
    }

    .modal-footer .btn-secondary {
        background-color: #6c757d;
    }

    .modal-footer .btn-danger {
        background-color: #dc3545;
    }
    </style>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Clustering Padi</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            {{-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div> --}}
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('actionlogout') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="/">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link" href="/kabupaten">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Kabupaten / Kota
                        </a>

                        <a class="nav-link" href="/produksi">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Produksi
                        </a>
                        <a class="nav-link" href="/tampil_clustering">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Perhitungan
                        </a>
                        <a class="nav-link" href="/maps">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data Cluster Maps
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content" style="background-color:aliceblue">
            <head>
                <title>Map View</title>
                <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
            </head>
            
            <main>
                <div>
                    <h1>Map View</h1>
                    
                    <form action="{{url('/maps')}}" method="GET">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tahunSelect" class="form-label">Tahun</label>
                                    <select class="form-select" id="tahunSelect" name="tahun">
                                        <option value="">Pilih Tahun</option>
                                        @foreach ($availableYears as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-success" type="submit">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <div id="map"></div>
                <div id="legend">
                    <div class="legend-title">Keterangan Warna</div>
                    <div class="legend-item"><span class="legend-color color-yellow"></span>Cluster 1: Rendah</div>
                    <div class="legend-item"><span class="legend-color color-blue"></span>Cluster 2: Sedang</div>
                    <div class="legend-item"><span class="legend-color color-green"></span>Cluster 3: Tinggi</div>
                </div>
            </main>
            
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('template/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('template/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('dist/assets/compiled/js/leaflet.ajax.js') }}"></script>
    <script>
        var map = L.map('map').setView([-7.512803, 112.231668], 7);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var geojson = {!! $geojson !!};

        L.geoJSON(geojson, {
            style: function(feature) {
                // Tentukan gaya berdasarkan klaster
                var cluster = feature.properties.cluster;
                if (cluster === "1") {
                    return { color: 'yellow' }; // Klaster 1: warna merah
                } else if (cluster === "2") {
                    return { color: 'blue' }; // Klaster 2: warna kuning
                } else if (cluster === "3") {
                    return { color: 'green' }; // Klaster 3: warna hijau
                } else {
                    return { color: 'red' }; // Klaster tidak terdefinisi: warna abu-abu
                }
            },
        //     onEachFeature: function(feature, layer) {
        //     // Tambahkan popup saat mouse hover
        //     var namaKabupaten = feature.properties.nama_kabupaten;
        //     var cluster = feature.properties.cluster;
        //     var produktivitas;
        //     if (cluster === "1") {
        //         produktivitas = "Rendah";
        //     } else if (cluster === "2") {
        //         produktivitas = "Sedang";
        //     } else if (cluster === "3") {
        //         produktivitas = "Tinggi";
        //     } else {
        //         produktivitas = "Tidak Diketahui";
        //     }
        //     layer.bindPopup('<b>Nama Kabupaten:</b> ' + namaKabupaten + '<br><b>Klaster:</b> ' + cluster + '<br><b>Produktivitas:</b> ' + produktivitas);
        // }
        onEachFeature: function(feature, layer) {
                // Tambahkan popup saat mouse hover
                var namaKabupaten = feature.properties.nama_kabupaten;
                var cluster = feature.properties.cluster;
                layer.bindPopup('<b>Nama Kabupaten:</b> ' + namaKabupaten + '<br><b>Klaster:</b> ' + cluster);
            }
        }).addTo(map);

        // L.marker([51.5, -0.09]).addTo(map)
        //     .bindPopup('A pretty CSS popup.<br> Easily customizable.')
        //     .openPopup();
    </script>

</body>

</html>
