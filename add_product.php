<?php
session_start();

include './functions/function.php';

// Barcode Line
$is_barcode_available = null;
$data = null;

if (isset($_SESSION['barcode_status'])) {
  $is_barcode_available = $_SESSION['barcode_status'];
  unset($_SESSION['barcode_status']);
}

if (isset($_SESSION['barcode_data'])) {
  $data = $_SESSION['barcode_data'];
  unset($_SESSION['barcode_data']);
}

// Query categories
$categories = getData("SELECT * FROM tb_kategori");

// Add a product line
if (isset($_POST['add_new_product'])) {
  if (addProduct($_POST) > 0) {
    $_SESSION['flash'] = [
      'type' => 'success',
      'title' => 'Success!',
      'text' => 'Produk berhasil ditambahkan'
    ];
  } else {
    $_SESSION['flash'] = [
      'type' => 'error',
      'title' => 'Opps...',
      'text' => 'Produk gagal ditambahkan'
    ];
  }
}

// Tambahkan stok produk yang sudah ada
if (isset($_POST['add_product_in'])) {
  $id_barang = $_POST['id_barang'] ?? null;

  if (addProductIn($_POST, $id_barang)) {
    $_SESSION['flash'] = [
      'type' => 'success',
      'title' => 'Success!',
      'text' => 'Stok baru berhasil ditambahkan'
    ];
  } else {
    $_SESSION['flash'] = [
      'type' => 'Alert',
      'title' => 'Oops...',
      'text' => 'Stok baru gagal ditambahkan'
    ];
  }
}
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
    <style>
      #form_new_product,
      #form_existing_product{
          display:none;
      }
    </style>
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
              <a class="nav-link" href="./products_out.php"
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
                    <li class="breadcrumb-item">Barang Masuk</li>
                    <li class="breadcrumb-item active">Tambah Barang</li>
                  </ol>
                </div>
                <h4 class="page-title">Tambah Barang</h4>
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
                  <h4 class="mt-0 header-title">Tambah Barang Masuk</h4>
                  <!-- Barcode form start -->
                  <form action="" method="post">
                    <div class="form-group">
                      <label for="barcode">Barcode</label>
                      <input
                        type="text"
                        class="form-control"
                        id="barcode_view"
                        name="barcode_view"
                        aria-describedby="emailHelp"
                        placeholder="Masukkan barcode"
                      />
                    </div>
                    <button type="button" class="btn btn-gradient-primary" onclick="openScanner()">
                      Scan Barcode
                    </button>
                  </form>
                  <!-- Barcode form end -->

                  <!-- Component Camera -->
                  <div id="scanner" class="mt-3" style="display:none; width:100%; max-width:400px;"></div>
                </div>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->

          <!-- If barcode exists then, show this form -->
          <div class="row" id="form_new_product">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="mt-0 header-title">Input Barang Masuk</h4>

                  <!-- Input product form start -->
                  <form action="" method="post">
                    <input type="hidden" name="barcode" id="barcode" value="">
                    <div class="form-group">
                      <label for="nama_barang">Nama Barang</label>
                      <input
                        type="text"
                        class="form-control"
                        id="nama_barang"
                        name="nama_barang"
                        placeholder="Masukkan nama barang"
                      />
                    </div>
                    <div class="form-group">
                      <label for="kategori">Kategori</label>
                      <select
                        class="form-control"
                        id="kategori"
                        name="kategori"
                        placeholder="Masukkan kategori"
                      >
                      <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['nama_kategori']; ?>"><?= $category['nama_kategori']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="satuan">Satuan</label>
                      <input
                        type="text"
                        class="form-control"
                        id="satuan"
                        name="satuan"
                        placeholder="Masukkan satuan"
                      />
                    </div>
                    <div class="form-group">
                      <label for="harga_beli">Harga Beli</label>
                      <input
                        type="number"
                        class="form-control"
                        id="harga_beli"
                        name="harga_beli"
                        placeholder="Masukkan harga beli"
                      />
                    </div>
                    <div class="form-group">
                      <label for="harga_jual">Harga Jual</label>
                      <input
                        type="number"
                        class="form-control"
                        id="harga_jual"
                        name="harga_jual"
                        placeholder="Masukkan harga jual"
                      />
                    </div>
                    <div class="form-group">
                      <label for="stok_minimum">Stok Minimum</label>
                      <input
                        type="number"
                        class="form-control"
                        id="stok_minimum"
                        name="stok_minimum"
                        placeholder="Masukkan stok minimum"
                      />
                    </div>
                    <div class="form-group">
                      <label for="jumlah">Jumlah</label>
                      <input
                        type="number"
                        class="form-control"
                        id="jumlah"
                        name="jumlah"
                        placeholder="Masukkan jumlah barang"
                      />
                    </div>
                    <div class="form-group">
                      <label for="tanggal_kadaluwarsa"
                        >Tanggal Kadaluwarsa Barang</label
                      >
                      <input
                        type="date"
                        class="form-control"
                        id="tanggal_kadaluwarsa"
                        name="tanggal_kadaluwarsa"
                        placeholder="Masukkan tanggal kadaluwarsa barang"
                      />
                    </div>
                    <button type="submit" class="btn btn-gradient-primary" name="add_new_product">
                      Simpan
                    </button>
                  </form>
                  <!-- Input product form end -->
                </div>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->

          <!-- If barcode exists then, show this form -->
          <div class="row" id="form_existing_product">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="mt-0 header-title">Input Barang Masuk</h4>

                  <!-- Input product form start -->
                  <form action="" method="post">
                    <input type="hidden" name="id_barang" id="id_barang">
                    <div class="form-group">
                      <label for="nama_barang_existing">Nama Barang</label>
                      <input
                        type="text"
                        class="form-control"
                        id="nama_barang_existing"
                        name="nama_barang"
                        readonly
                      />
                    </div>
                    <div class="form-group">
                      <label for="jumlah">Jumlah Barang</label>
                      <input
                        type="number"
                        class="form-control"
                        id="jumlah"
                        name="jumlah"
                        placeholder="Masukkan jumlah barang"
                      />
                    </div>
                    <div class="form-group">
                      <label for="tanggal_kadaluwarsa"
                        >Tanggal Kadaluwarsa Barang</label
                      >
                      <input
                        type="date"
                        class="form-control"
                        id="tanggal_kadaluwarsa"
                        name="tanggal_kadaluwarsa"
                        placeholder="Masukkan tanggal kadaluwarsa barang"
                      />
                    </div>
                    <button type="submit" class="btn btn-gradient-primary" name="add_product_in">
                      Simpan
                    </button>
                  </form>
                  <!-- Input product form end -->
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
    
    <!-- SweatAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- HTML5 QR Code -->
    <script src="https://unpkg.com/html5-qrcode"></script>

    <!-- Sweat Alert -->
    <script>
       <?php if (isset($_SESSION['flash'])): ?>
          Swal.fire({
            icon: '<?= $_SESSION['flash']['type'] ?>',
            title: '<?= $_SESSION['flash']['title'] ?>',
            text: '<?= $_SESSION['flash']['text'] ?>',
            confirmButtonText: 'OK'
          });
        <?php unset($_SESSION['flash']); endif; ?>
    </script>

    <script>
    // Buka kamera
    let html5QrCode;

    function openScanner() {
      const scannerDiv = document.getElementById("scanner");
      scannerDiv.style.display = "block";

      html5QrCode = new Html5Qrcode("scanner");

      html5QrCode.start(
        { facingMode: "environment" }, // ← KUNCI iPhone
        {
          fps: 15,
          qrbox: { width: 300, height: 150 },
          aspectRatio: 1.777,
          formatsToSupport: [
            Html5QrcodeSupportedFormats.QR_CODE,
            Html5QrcodeSupportedFormats.EAN_13,
            Html5QrcodeSupportedFormats.CODE_128
          ]
        },
        (decodedText) => {
          document.getElementById("barcode_view").value = decodedText;
          document.getElementById("barcode").value = decodedText;

          autoCheckBarcode(decodedText, true);

          html5QrCode.stop();
          scannerDiv.style.display = "none";
        },
        (error) => {}
      );
    }

    // Tentukan barcode ada atau tidak
    function autoCheckBarcode(barcode, fromScan = false){
      $.post("cek_barcode_ajax.php",{barcode:barcode}, function(res){
          let data = JSON.parse(res);

          if(data.status === "exists"){
              $("#form_existing_product").show();
              $("#form_new_product").hide();

              $("#id_barang").val(data.id_barang);

              $("#nama_barang_existing").val(data.nama_barang);
          }else{
              $("#form_new_product").show();
              $("#form_existing_product").hide();

              $("#id_barang").val("");
              $("#nama_barang_existing").val("");

              if(fromScan){
                  Swal.fire({
                      icon: "error",
                      title: "Barcode tidak ditemukan",
                      text: "Silakan tambahkan produk baru"
                  });
              }
          }
      });
    }



    // Event ketika ketik manual
    $("#barcode_view").on("input", function(){
        $("#barcode").val(this.value);
        autoCheckBarcode(this.value);
    });
    </script>
    
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
