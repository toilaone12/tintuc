<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tìm kiếm tin tức</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?= require_once './admin/navbar.php' ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper" style="padding-top: 75px !important;">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">Màu nền cho sidebar</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3"></div>Sáng
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3"></div>Tối
                    </div>
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php require './admin/sidebar.php' ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <a href="?act=themtintuc" class="btn btn-success px-3 py-2 mb-3">Thêm tin tức</a>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title text-uppercase">Danh sách tin tức</h4>
                                        <div class="d-flex">
                                            <form action="?act=timkiemtintuc" method="post">
                                                <div class="form-group d-flex justify-content-end">
                                                    <input type="text" name="keyword" placeholder="Tìm kiếm" id="" class="form-control w-50 me-1">
                                                    <button type="submit" class="btn btn-primary px-3 py-2">Tìm kiếm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Xử lý phần danh sách tin tức -->
                                    <?php
                                    $sql = "SELECT * FROM tintuc WHERE tieu_de_tin_tuc LIKE '%" . strtolower($_POST['keyword']) . "%'"; // tim kiem theo tieu de
                                    $result = mysqli_query($conn, $sql);
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Ảnh</th>
                                                    <th>Tiêu đề</th>
                                                    <th>Danh mục</th>
                                                    <th>Sapo</th>
                                                    <th>Nội dung</th>
                                                    <th>Lượt xem</th>
                                                    <th>Tin nóng</th>
                                                    <th>Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $i++;
                                                    //phần này sẽ truy vấn lấy thông tin danh muc
                                                    $sqlCha = "SELECT * FROM danhmuc WHERE id_danh_muc = " . $row['id_danh_muc'];
                                                    $resultCha = mysqli_query($conn, $sqlCha);
                                                    $rowCha = mysqli_fetch_assoc($resultCha);
                                                ?>
                                                    <tr>
                                                        <!-- $row: se tra ve 1 mang du lieu tu db, ['ten_tin_tuc'] thì ten_tin_tuc thì xem trên database trên phpmyadmin nhé -->
                                                        <td><?= $i ?></td>
                                                        <td><img class="image-table" src="./image/<?= $row['anh_tin_tuc'] ?>" width="200" height="150" alt=""></td>
                                                        <td><?= $row['tieu_de_tin_tuc'] ?></td>
                                                        <td><?= $rowCha['ten_danh_muc'] ? $rowCha['ten_danh_muc'] : 'Không có' ?></td>
                                                        <td><?= $row['sapo_tin_tuc'] ?></td>
                                                        <td><?= $row['noi_dung_tin_tuc'] ?></td>
                                                        <td><span class="badge badge-primary"><?= $row['luot_xem'] ?></span></td>
                                                        <td><span class="badge badge-danger"><?= $row['tin_nong'] ? 'Có' : 'Không' ?></span></td>
                                                        <td>
                                                            <a href="?act=suatintuc&id=<?= $row['id_tin_tuc'] ?>" class="badge badge-success text-decoration-none me-3">Sửa</a>
                                                            <a href="?act=xoatintuc&id=<?= $row['id_tin_tuc'] ?>" class="badge badge-danger text-decoration-none">Xóa</a>
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
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/proBanner.js"></script>
    <!-- <script src="../assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
</body>

</html>