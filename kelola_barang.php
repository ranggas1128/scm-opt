
<?php
session_start();
include 'koneksi.php'; //akses koneksi

$id         = "";
$nama       = "";
$sukses     = "";
$error      = "";
$jumlah = "";
$namasup = "";
$date="";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
// cek id delete
if ($op == 'delete') {
    $id         = $_GET['id'];
    $sqldelete  = "delete from barang where ID_BARANG = '$id'";
    $qdelete    = mysqli_query($conn, $sqldelete);
    if ($qdelete) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error  = "Data gagal dihapus!";
    }
}


if ($error) {
?>
    <div class="alert alert-danger" role="alert" style="text-align:center ;">
        <?php echo $error ?>
    </div>
<?php
    header("refresh:3;url=kelola_barang.php"); // refresh halaman data user
}
?>

<?php
if ($sukses) {
?>
    <div class="alert alert-success" role="alert" style="text-align:center ;">
        <?php echo $sukses ?>
    </div>
<?php
    header("refresh:3;url=kelola_barang.php");
}


// auto increment buat ID_BARANG
$autoincrement = mysqli_query($conn, "select max(ID_BARANG) as max_id from barang");
$data = mysqli_fetch_array($autoincrement);
$id = $data['max_id'];
$urut = (int)substr($id, 3, 3);
$urut++;
$huruf = "PRD";
$id_bahan = $huruf . sprintf("%03s", $urut);

// Query Simpan Tambah data ke database
if (isset($_POST['addbahan'])) {
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $namasup = $_POST['supplier'];

    $tambahbahan = mysqli_query($conn, "insert into barang (ID_BARANG, NAMA_BARANG, JUMLAH_BARANG, NAMA_SUPPLIER) values ('$id_bahan', '$nama', '$jumlah' ,'$namasup')");
    if ($tambahbahan) {
        echo "
        <div class='alert alert-success' role='alert' style='text-align:center ;'>
			Berhasil menambahkan bahan baru.
		</div>
		<meta http-equiv='refresh' content='3; url= kelola_barang.php'/>  ";      
    } else {
        echo "
        <div class='alert alert-danger' role='alert' style='text-align:center ;'>
			Gagal menambahkan bahan baru.
		</div>";
    }
};

// Query Simpan Edit data ke database
if (isset($_POST['editbarang'])) {
    $idedit = $_POST['idedit'];
    $namaedit = $_POST['namaedit'];
    $jumlahedit = $_POST['jumlahedit'];
    $namasupedit = $_POST['supplieredit'];

    $editbarang = mysqli_query($conn, "Update barang SET NAMA_BARANG='$namaedit', JUMLAH_BARANG='$jumlahedit', NAMA_SUPPLIER='$namasupedit' WHERE ID_BARANG='$idedit'");
    if ($editbarang) {
        echo "
        <div class='alert alert-success' role='alert' style='text-align:center ;'>
			Berhasil Meyimpan Perubahan.
		</div>
		<meta http-equiv='refresh' content='3; url= kelola_barang.php'/>  ";
    } else {
        echo "
        <div class='alert alert-danger' role='alert' style='text-align:center ;'>
			Gagal Meyimpan Perubahan.
		</div>";
    }
};

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kelola Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">

    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
         input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            }

        </style>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li><a href="index.php"><span>Home</span></a></li>
                            <li>
                                <a href="index.php"><i class="ti-dashboard"></i><span>CV OPTIMA MITRA</span></a>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Kelola
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="kelola_supplier.php">Supplier</a></li>
                                    <li class="active"><a href="kelola_barang.php">Barang</a></li>
                                </ul>
                            </li>
                            <li>
                                <!-- <a href="../logout.php"><span>Logout</span></a> -->

                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li>
                                <h3>
                                    <div class="date">
                                        <script type='text/javascript'>
                                            // <!--
                                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                            var date = new Date();
                                            var day = date.getDate();
                                            var month = date.getMonth();
                                            var thisDay = date.getDay(),
                                                thisDay = myDays[thisDay];
                                            var yy = date.getYear();
                                            var year = (yy < 1000) ? yy + 1900 : yy;
                                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                            //-->
                                        </script></b>
                                    </div>
                                </h3>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- page title area end -->
            <div class="main-content-inner">

                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <h2>Daftar Barang</h2>
                                    <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Barang</button>
                                </div>
                                <div class="data-tables datatable-dark">
                                    <table id="dataTable3" class="display" style="width:100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>ID Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah Stok</th>
                                                <th>Supplier</th>
                                                <th>Terakhir Restock</th>
                                                <th>Pilih Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $brgs = mysqli_query($conn, "SELECT * from barang order by ID_BARANG ASC");
                                            $no = 1;
                                            while ($p = mysqli_fetch_array($brgs)) {
                                                $id = $p['ID_BARANG'];

                                            ?>

                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $p['ID_BARANG'] ?></td>
                                                    <td><?php echo $p['NAMA_BARANG'] ?></td>
                                                    <td><?php echo $p['JUMLAH_BARANG'] ?></td>
                                                    <td><?php echo $p['NAMA_SUPPLIER'] ?></td>
                                                    <td><?php echo $p['DATE'] ?></td>
                                                    <td>
                                                    <a href="" class="btn btn-success btn-md" data-toggle="modal" data-target="#modal<?php echo $p['ID_BARANG'] ?>">Edit</a>

                                                    <div class="modal fade" id="modal<?php echo $p['ID_BARANG'] ?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Barang</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post">
                                                            <input type="hidden" name="idedit" value="<?php echo $p['ID_BARANG']?>">
                                                                <div class="form-group">
                                                                    <label>Nama Barang</label>
                                                                    <input name="namaedit" type="text" class="form-control" value="<?php echo $p['NAMA_BARANG']?>" required autofocus>
                                                                    </div>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post">
                                                                <div class="form-group">
                                                                    <label>Jumlah Stok</label>
                                                                    <input name="jumlahedit" type="number" class="form-control" value="<?php echo $p['JUMLAH_BARANG']?>" required autofocus>
                                                                </div>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post">
                                                                <div class="form-group">
                                                                    <label>Supplier</label>
                                                                    <select id="supplieredit" name="supplieredit" required>
                                                    <option value="<?php echo $p['NAMA_SUPPLIER']; ?>"><?php echo $p['NAMA_SUPPLIER']; ?></option>
                                                    <?php 

                                                        $readuser = "select * from SUPPLIER";
                                                        $q = mysqli_query($conn, $readuser);

                                                        while ($bahan = mysqli_fetch_array($q)) {
                                                            ?>
                                                            <option value="<?php echo $bahan['NAMA_SUPPLIER']; ?>" > <?php echo $bahan['NAMA_SUPPLIER']; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                    </select>
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                            <input name="editbarang" type="submit" class="btn btn-primary" value="Simpan Perubahan">
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                                    <a href="kelola_barang.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Hapus data stok produk ?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                                    </td>

                                                </tr>

                                            <?php
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- row area start-->
        </div>
    </div>
    <!-- main content area end -->
    <!-- footer area start-->
    <footer>
        <div class="footer-area">
            <p>Developed by CV OPTIMA MITRA</p>
        </div>
    </footer>
    <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <!-- form tambah barang  -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input name="nama" type="text" class="form-control" required autofocus>
                            </div>

                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Jumlah Stok</label>
                            <input name="jumlah" type="number" class="form-control" required autofocus>
                        </div>

                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select id="supplier" name="supplier" required>
            <option value=""></option>
            <?php 

                $readuser = "select * from SUPPLIER";
                $q = mysqli_query($conn, $readuser);

                while ($bahan = mysqli_fetch_array($q)) {
                    ?>
                    <option value="<?php echo $bahan['NAMA_SUPPLIER']; ?>" > <?php echo $bahan['NAMA_SUPPLIER']; ?></option>
                    <?php
                }
            ?>
            </select>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input name="addbahan" type="submit" class="btn btn-primary" value="Tambah">
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#dataTable3').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        });
    </script>

    <!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>