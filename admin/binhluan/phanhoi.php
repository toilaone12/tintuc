<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Phản hồi</title>
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
            <?php require './admin/sidebar.php'?>
            <!-- partial -->
            <?php
                // Xử lý logic
                $id_phan_hoi = $_GET['id'];
                $id_bai_viet = $_GET['id_bai_viet'];
                // Xử lý phản hồi
                // Đầu tiên lấy thông tin vừa được gửi lên server (qua phương thức POST)
                if(isset($_POST['phanhoi'])){ // check phuong thuc POST có tồn tại không và $_POST['suadanhmuc'] có tồn tại k (suadanhmuc là cái name ở nút button Xác nhận)  
                    $noi_dung_binh_luan = mysqli_real_escape_string($conn,$_POST['noi_dung_binh_luan']);
                    $ngay_binh_luan = date('Y-m-d H:i:s');
                    if($noi_dung_binh_luan == ''){ //kiem tra ten danh muc co bi trong khong
                        $err_noi_dung_binh_luan = 'Không được để trống';
                    }else{
                        $insert = "INSERT INTO binhluan VALUES ('',$id_bai_viet,'Quản trị viên','$noi_dung_binh_luan',$id_phan_hoi,0,'$ngay_binh_luan')";
                        $resultInsert = mysqli_query($conn,$insert);
                        if($resultInsert){ // kiem tra da truy van dung chua
                            echo '<script>alert("Phản hồi thành công")</script>';
                            echo '<script>location.href="?act=danhsachbinhluan"</script>';
                        }
                    }
                }
            ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Phản hồi</h4>
                                    <!-- a sẽ thêm danh mục thông qua form với phương thức là POST (gửi dữ liệu lên server) -->
                                    <form class="forms-sample" method="POST">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nội dung bình luận</label>
                                            <input type="text" class="form-control" name="noi_dung_binh_luan" require id="exampleInputUsername1" placeholder="Nhập nội dung">
                                            <p class="text-danger fs-6 mt-2">
                                                <?= isset($err_noi_dung_binh_luan) && $err_noi_dung_binh_luan ? $err_noi_dung_binh_luan : '' ?>
                                            </p>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2" name="phanhoi">Xác nhận</button>
                                    </form>
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