<?php
include './functions/function.php';

$products = getData("
SELECT 
    b.*,
    IFNULL(m.total_masuk, 0) - IFNULL(k.total_keluar, 0) AS stok
FROM tb_barang b

LEFT JOIN (
    SELECT id_barang, SUM(jumlah) AS total_masuk
    FROM tb_barang_masuk
    GROUP BY id_barang
) m ON b.id_barang = m.id_barang

LEFT JOIN (
    SELECT id_barang, SUM(jumlah) AS total_keluar
    FROM tb_barang_keluar
    GROUP BY id_barang
) k ON b.id_barang = k.id_barang
");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Market - Dashboard</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta content="Market Dashboard" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="./assets/images/favicon.ico" />

    <link
      href="./plugins/jvectormap/jquery-jvectormap-2.0.2.css"
      rel="stylesheet"
    />
    <link href="./plugins/lightpick/lightpick.css" rel="stylesheet" />

    <!-- App css -->
    <link
      href="./assets/css/bootstrap.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link href="./assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="./assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link
      href="./assets/css/metisMenu.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link href="./assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- DataTables Bootstrap 4 CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css"
    />
  </head>

  <body>
    <!-- Top Bar Start -->
    <div class="topbar">
      <!-- LOGO -->
      <div class="topbar-left">
        <a href="./dashboard/crm-index.php" class="logo">
          <span>
            <img
              src="./assets/images/logo-sm.png"
              alt="logo-small"
              class="logo-sm"
            />
          </span>
          <span>
            <img
              src="./assets/images/logo.png"
              alt="logo-large"
              class="logo-lg logo-light"
            />
            <img
              src="./assets/images/logo-dark.png"
              alt="logo-large"
              class="logo-lg"
            />
          </span>
        </a>
      </div>
      <!--end logo-->
      <!-- Navbar -->
      <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">
          <li class="dropdown notification-list">
            <a
              class="nav-link dropdown-toggle arrow-none waves-light waves-effect"
              data-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="false"
              aria-expanded="false"
            >
              <i class="ti-bell noti-icon"></i>
              <span class="badge badge-danger badge-pill noti-icon-badge"
                >2</span
              >
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-lg pt-0">
              <h6
                class="dropdown-item-text font-15 m-0 py-3 bg-primary text-white d-flex justify-content-between align-items-center"
              >
                Notifications
                <span class="badge badge-light badge-pill">2</span>
              </h6>
              <div class="slimscroll notification-list">
                <!-- item-->
                <a href="#" class="dropdown-item py-3">
                  <small class="float-right text-muted pl-2">2 min ago</small>
                  <div class="media">
                    <div class="avatar-md bg-primary">
                      <i class="la la-cart-arrow-down text-white"></i>
                    </div>
                    <div
                      class="media-body align-self-center ml-2 text-truncate"
                    >
                      <h6 class="my-0 font-weight-normal text-dark">
                        Your order is placed
                      </h6>
                      <small class="text-muted mb-0"
                        >Dummy text of the printing and industry.</small
                      >
                    </div>
                    <!--end media-body-->
                  </div>
                  <!--end media--> </a
                ><!--end-item-->
                <!-- item-->
                <a href="#" class="dropdown-item py-3">
                  <small class="float-right text-muted pl-2">10 min ago</small>
                  <div class="media">
                    <div class="avatar-md bg-success">
                      <i class="la la-group text-white"></i>
                    </div>
                    <div
                      class="media-body align-self-center ml-2 text-truncate"
                    >
                      <h6 class="my-0 font-weight-normal text-dark">
                        Meeting with designers
                      </h6>
                      <small class="text-muted mb-0"
                        >It is a long established fact that a reader.</small
                      >
                    </div>
                    <!--end media-body-->
                  </div>
                  <!--end media--> </a
                ><!--end-item-->
                <!-- item-->
                <a href="#" class="dropdown-item py-3">
                  <small class="float-right text-muted pl-2">40 min ago</small>
                  <div class="media">
                    <div class="avatar-md bg-pink">
                      <i class="la la-list-alt text-white"></i>
                    </div>
                    <div
                      class="media-body align-self-center ml-2 text-truncate"
                    >
                      <h6 class="my-0 font-weight-normal text-dark">
                        UX 3 Task complete.
                      </h6>
                      <small class="text-muted mb-0"
                        >Dummy text of the printing.</small
                      >
                    </div>
                    <!--end media-body-->
                  </div>
                  <!--end media--> </a
                ><!--end-item-->
                <!-- item-->
                <a href="#" class="dropdown-item py-3">
                  <small class="float-right text-muted pl-2">1 hr ago</small>
                  <div class="media">
                    <div class="avatar-md bg-warning">
                      <i class="la la-truck text-white"></i>
                    </div>
                    <div
                      class="media-body align-self-center ml-2 text-truncate"
                    >
                      <h6 class="my-0 font-weight-normal text-dark">
                        Your order is placed
                      </h6>
                      <small class="text-muted mb-0"
                        >It is a long established fact that a reader.</small
                      >
                    </div>
                    <!--end media-body-->
                  </div>
                  <!--end media--> </a
                ><!--end-item-->
                <!-- item-->
                <a href="#" class="dropdown-item py-3">
                  <small class="float-right text-muted pl-2">2 hrs ago</small>
                  <div class="media">
                    <div class="avatar-md bg-info">
                      <i class="la la-check-circle text-white"></i>
                    </div>
                    <div
                      class="media-body align-self-center ml-2 text-truncate"
                    >
                      <h6 class="my-0 font-weight-normal text-dark">
                        Payment Successfull
                      </h6>
                      <small class="text-muted mb-0"
                        >Dummy text of the printing.</small
                      >
                    </div>
                    <!--end media-body-->
                  </div>
                  <!--end media--> </a
                ><!--end-item-->
              </div>
              <!-- All-->
              <a
                href="javascript:void(0);"
                class="dropdown-item text-center text-primary"
              >
                View all <i class="fi-arrow-right"></i>
              </a>
            </div>
          </li>

          <li class="dropdown">
            <a
              class="nav-link dropdown-toggle waves-effect waves-light nav-user"
              data-toggle="dropdown"
              href="#"
              role="button"
              aria-haspopup="false"
              aria-expanded="false"
            >
              <img
                src="./assets/images/users/user-1.png"
                alt="profile-user"
                class="rounded-circle"
              />
              <span class="ml-1 nav-user-name hidden-sm">Admin</span>
            </a>
          </li>
        </ul>
        <!--end topbar-nav-->

        <ul class="list-unstyled topbar-nav mb-0">
          <li>
            <button
              class="nav-link button-menu-mobile waves-effect waves-light"
            >
              <i class="ti-menu nav-icon"></i>
            </button>
          </li>
        </ul>
      </nav>
      <!-- end navbar-->
    </div>
    <!-- Top Bar End -->

    <!-- Left Sidenav -->
    <div class="left-sidenav">
      <ul class="metismenu left-sidenav-menu">
        <li>
          <a href="./index.php"
            ><i class="ti-bar-chart"></i><span>Dashboard</span></a
          >
        </li>

        <li class="mm-active">
          <a href="javascript: void(0);"
            ><i class="ti-server"></i><span>Data Master</span
            ><span class="menu-arrow"
              ><i class="mdi mdi-chevron-right"></i></span
          ></a>
          <ul class="nav-second-level" aria-expanded="false">
            <li class="nav-item">
              <a class="nav-link" href="./products.php"
                ><i class="ti-control-record"></i>Master Barang</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./product_in.php"
                ><i class="ti-control-record"></i>Barang Masuk</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./product_out.php"
                ><i class="ti-control-record"></i>Barang Keluar</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./categories.php"
                ><i class="ti-control-record"></i>Kategori</a
              >
            </li>
          </ul>
        </li>

        <li>
          <a href="javascript: void(0);"
            ><i class="ti-lock"></i><span>Menu Lainnya</span
            ><span class="menu-arrow"
              ><i class="mdi mdi-chevron-right"></i></span
          ></a>
          <ul class="nav-second-level" aria-expanded="false">
            <li class="nav-item">
              <a class="nav-link" href="./authentication/auth-login.php"
                ><i class="ti-control-record"></i>Manajemen User</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./penjualan.php"
                ><i class="ti-control-record"></i>Penjualan</a
              >
            </li>
          </ul>
        </li>

        <li>
          <a href="javascript: void(0);"
            ><i class="ti-bar-chart"></i><span>Logout</span></a
          >
        </li>
      </ul>
    </div>
    <!-- end left-sidenav-->

    <div class="page-wrapper">
      <!-- Page Content-->
      <div class="page-content">
        <div class="container-fluid">
          <!-- Page-Title -->
          <div class="row">
            <div class="col-sm-12">
              <div class="page-title-box">
                <div class="float-right">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Master Barang</li>
                  </ol>
                </div>
                <h4 class="page-title">Master Barang</h4>
              </div>
              <!--end page-title-box-->
            </div>
            <!--end col-->
          </div>
          <!-- end page title end breadcrumb -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="mt-0 header-title">Data Barang</h4>

                  <table
                    id="datatable"
                    class="table table-bordered dt-responsive nowrap"
                    style="
                      border-collapse: collapse;
                      border-spacing: 0;
                      width: 100%;
                    "
                  >
                    <thead>
                      <tr>
                        <th>Kode Barang</th>
                        <th>Barcode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php foreach ($products as $product) : ?>
                      <tr>
                        <td><?= $product['id_barang']; ?></td>
                        <td><?= $product['barcode']; ?></td>
                        <td><?= $product['nama_barang']; ?></td>
                        <td><?= $product['kategori']; ?></td>
                        <td>Rp. <?= number_format($product['harga_beli'], 0, ',', '.'); ?></td>
                        <td>Rp. <?= number_format($product['harga_jual'], 0, ',', '.'); ?></td>
                        <td><?= number_format($product['stok'], 0, ',', '.'); ?></td>
                        <td>
                          <a href="./update_product.php?id_barang=<?= $product['id_barang']; ?>"
                            ><i class="fas fa-edit text-warning"></i
                          ></a>
                        </td>
                        <td>
                          <a href="./delete_product.php?id_barang=<?= $product['id_barang']; ?>" onclick="return confirm('Yakin hapus barang?');"
                            ><i class="fas fa-trash text-danger"></i
                          ></a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- container -->

        <footer class="footer text-center text-sm-left">
          &copy; 2026 Market
          <span class="text-muted d-none d-sm-inline-block float-right"
            >Crafted with <i class="mdi mdi-heart text-danger"></i
          ></span>
        </footer>
        <!--end footer-->
      </div>
      <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <!-- jQuery  -->
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/metismenu.min.js"></script>
    <script src="./assets/js/waves.js"></script>
    <script src="./assets/js/feather.min.js"></script>
    <script src="./assets/js/jquery.slimscroll.min.js"></script>
    <script src="./assets/js/jquery-ui.min.js"></script>

    <script src="./plugins/moment/moment.js"></script>
    <script src="./plugins/apexcharts/apexcharts.min.js"></script>
    <script src="./plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="./plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="./plugins/chartjs/chart.min.js"></script>
    <script src="./plugins/chartjs/roundedBar.min.js"></script>
    <script src="./plugins/lightpick/lightpick.js"></script>
    <script src="./assets/pages/jquery.sales_dashboard.init.js"></script>

    <!-- App js -->
    <script src="./assets/js/app.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Bootstrap 4 JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function () {
        $("#datatable").DataTable({
          lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
          ],
          pageLength: 10,
          responsive: true,
        });
      });
    </script>
  </body>
</html>
