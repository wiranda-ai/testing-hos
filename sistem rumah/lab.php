<?php
require 'function.php';
require 'cek.php';

// batasi akses hanya untuk yang punya akses 'lab'
if(!isset($_SESSION['log']) || $_SESSION['akses'] != 'lab'){
    // jika tidak login atau akses bukan lab, redirect ke login atau halaman lain
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">Lingkungan Hidup</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <!-- Navbar User Info & Dropdown -->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 d-flex align-items-center">
        <li class="nav-item me-3 text-white">
            <?php
            if (isset($_SESSION['email'])) {
                echo "Hello, " . htmlspecialchars($_SESSION['email']);
            } else {
                echo "Not logged in";
            }
            ?>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                             <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                BIdang Pengelolahan Sampah Limbah B3
                            </a>
                             <a class="nav-link" href="lab.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Bidang Lab
                            </a>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            
                            
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Lab</h1>
                        
                        
                        
                        <div class="card mb-4">
                            <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Data Lab
                            </button>
                            <a href="exportlab.php" class="btn btn-info"> Export Data</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lokasi</th>
                                            <th>Tipe Lokasi</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                        $ambilsemuadatalab = mysqli_query($conn, "select * from lab");
                                        $i= 1;
                                        while($data=mysqli_fetch_array($ambilsemuadatalab)){
                                            $nama_lokasi = $data['nama_lokasi'];
                                            $tipe_lokasi = $data['tipe_lokasi'];
                                            $latitude = $data['latitude'];
                                            $longitude = $data['longitude'];
                                            $alamat = $data['alamat'];
                                            $idlab =$data['idlab'];
                                        ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$nama_lokasi;?></td>
                                            <td><?=$tipe_lokasi;?></td>
                                            <td><?=$latitude;?></td>
                                            <td><?=$longitude;?></td>
                                            <td><?=$alamat;?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idlab;?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idlab;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- edit model -->
                                        <div class="modal fade" id="edit<?=$idlab;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Data</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <form method="post">
                                            <div class="modal-body">
                                                <input type="text" name="nama_lokasi" value="<?=$nama_lokasi;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="tipe_lokasi" value="<?=$tipe_lokasi;?>" class="form-control" required>
                                                <br>
                                                <input type="text" name="latitude" placeholder="Latitude (contoh: 6°10'12.5&quot;S)" class="form-control" required>
                                                <br>
                                                <input type="text" name="longitude" placeholder="Longitude (contoh: 106°49'30.2&quot;E)" class="form-control" required>
                                                <br>
                                                <input type="text" name="alamat" value="<?=$alamat;?>" class="form-control" required>
                                                <input type="hidden" name="idlab" value="<?=$idlab;?>">
                                                <button type="submit" class="btn btn-primary" name="updatenewdata">Submit</button>
                                            </div>
                                        </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- delete model -->
                                        <div class="modal fade" id="delete<?=$idlab;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <form method="post">
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus <?=$nama_lokasi;?>?
                                            <input type="hidden" name="idlab" value="<?=$idlab;?>">
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapusdatanew">Hapus</button>
                                        </div>
                                        </form>
                                            </div>
                                        </div>
                                        </div>
                                        <?php
                                        };
                                        ?>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Dinas Lingkungan Hidup 2025</div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <script>
document.addEventListener('DOMContentLoaded', function () {
    const table = new simpleDatatables.DataTable("#dataTable", {
        searchable: true,          // Aktifkan pencarian
        paging: true,               // Aktifkan pagination
        perPage: 10,                 // Baris per halaman default
        perPageSelect: [5, 10, 25],  // Pilihan jumlah baris
        info: true                   // Aktifkan teks "Showing..."
    });

    // Tambahkan class bootstrap agar pagination rapi
    const paginations = document.querySelectorAll('.dataTable-pagination');
    paginations.forEach(function(pagination) {
        pagination.classList.add('pagination', 'justify-content-end');
    });

    // Tambahkan class bootstrap ke search box
    const searchInput = document.querySelector('.dataTable-search input');
    if (searchInput) {
        searchInput.classList.add('form-control', 'form-control-sm');
        searchInput.setAttribute('placeholder', 'Search...');
    }
});
</script>

    </body>

    <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Lab</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
       <form method="post">
  <div class="modal-body">
    <input type="text" name="namalokasi" placeholder="Nama Lokasi" class="form-control" required>
    <br>
    <input type="text" name="tipelokasi" class="form-control" placeholder="Tipe Lokasi" required>
    <br>
    <input type="text" name="latitude" placeholder="Latitude" class="form-control" required>
    <br>
    <input type="text" name="longitude" placeholder="Longitude" class="form-control" required>
    <br>
    <input type="text" name="alamat" placeholder="Alamat" class="form-control" required>
    <br>
    <button type="submit" class="btn btn-primary" name="addnewdata_lab">Submit</button>
  </div>
</form>

    </div>
  </div>
</div>
</html>
