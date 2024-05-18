<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet">
    <style>
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
    </style>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark">
        <a class="navbar-brand ps-3" href="index.html">Clustering Padi</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <h1 class="mt-4">Perhitungan</h1>

                <form action="{{ route('clustering') }}" method="post" class="mb-2">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Tampil Data Clustering</button>
                    </div>
                </form>

                <form action="{{ url('/clustering/filter') }}" method="POST" class="d-flex justify-content-end mb-2">
                    @csrf
                    @method('POST')
                    <div class="form-group me-2">
                        <label for="tahunSelect" class="me-2">Filter per Tahun</label>
                        <select id="tahunSelect" class="choices form-select" name="tahun">
                            <option value="">Pilih Tahun</option>
                            <option value="0">Semua</option>
                            @foreach ($availableYears as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-secondary align-self-end" type="submit" name="action" value="filter">Filter</button>
                </form>

                <table id="example" class="table table-striped table-bordered datatables" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Nama Kabupaten</th>
                            <th>Luas Panen / ha</th>
                            <th>Produktivitas ton/ha</th>
                            <th>Produksi / ton</th>
                            <th>Klaster</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$clustering->isEmpty())
                            @foreach ($clustering as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->namakabupaten->nama_kabupaten }}</td>
                                    <td>{{ $item->luas_panen }}</td>
                                    <td>{{ $item->produktivitas }}</td>
                                    <td>{{ $item->produksi }}</td>
                                    <td>{{ $item->cluster }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">Belum ada data clustering. Klik "Tampil Data Clustering" untuk melihat hasil clustering.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('template/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('template/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dataTable = new simpleDatatables.DataTable("#example");
        });
    </script>
</body>

</html>
