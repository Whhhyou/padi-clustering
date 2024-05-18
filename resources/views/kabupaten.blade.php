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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</head>
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
    .navbar-brand {
    color: #adb5bd; /* Warna teks untuk tulisan "Clustering Padi" di navbar */
}
</style>
<body class="sb-nav-fixed">
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
            </nav>
        </div>
        <div id="layoutSidenav_content" style="background-color:aliceblue">
            <main>
                <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger" id="hapusButton">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="container-fluid px-4">
    <h1 class="mt-4">Kabupaten/Kota</h1>
    <a href="/kabupaten/kabupaten_tambah">
        <button type="button" class="btn btn-primary">Tambah Data Kabupaten</button>
    </a>
    <table id="myTable" class="table">
        <thead>
            <tr style="width:100%">
                <th scope="col" style="width: 30%">No</th>
                <th scope="col" style="width: 30%">Nama Kabupaten / Kota</th>
                <th scope="col" style="width: 50%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tb_kabupaten as $key => $kabupaten)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $kabupaten->nama_kabupaten }}</td>
                    <td>
                        <a href="/kabupaten/kabupaten_edit/{{ $kabupaten->id }}">
                            <button type="button" class="btn btn-info">Edit</button>
                        </a>
                        <button type="button" class="btn btn-danger hapus-button" data-id="{{ $kabupaten->id }}">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
     <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('template/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('template/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Menangani klik tombol hapus
            const hapusButtons = document.querySelectorAll('.hapus-button');
            hapusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Set ID data yang akan dihapus ke dalam modal
                    const id = this.getAttribute('data-id');
                    const hapusButtonModal = document.getElementById('hapusButton');
                    hapusButtonModal.dataset.id = id;
                    // Buka modal konfirmasi
                    const modal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
                    modal.show();
                });
            });

            // Menangani klik tombol hapus dalam modal
            const hapusButtonModal = document.getElementById('hapusButton');
            hapusButtonModal.addEventListener('click', function() {
                const id = this.dataset.id;
                window.location.href = "/kabupaten/kabupaten_hapus/" + id;
            });

            // Menangani klik tombol batal dalam modal
            const batalButtonModal = document.getElementById('batalButton');
            batalButtonModal.addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
                modal.hide();
            });
        });
    </script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
</body>

</html>