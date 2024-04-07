<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Danh sách bình luận</title>
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
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-9 m-auto grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title text-uppercase">Danh sách bình luận</h4>
                                        <div class="d-flex">
                                            <form action="?act=timkiemdanhmuc" method="post">
                                                <div class="form-group d-flex justify-content-end">
                                                    <input type="text" name="keyword" placeholder="Tìm kiếm" id="" class="form-control w-50 me-1">
                                                    <button type="submit" class="btn btn-primary px-3 py-2">Tìm kiếm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Xử lý phần danh sách bình luận -->
                                    <?php
                                        //xu ly khoa binh luan
                                        if(isset($_GET['khoabinhluan'])){
                                            $update = "UPDATE binhluan SET is_lock = ".$_GET['khoabinhluan']." WHERE id_binh_luan = ".$_GET['id'];
                                            $resultUpdate = mysqli_query($conn,$update);
                                            if($resultUpdate){
                                                if($_GET['khoabinhluan']){
                                                    echo '<script>alert("Khoá bình luận thành công")</script>';
                                                }else{
                                                    echo '<script>alert("Mở khoá bình luận thành công")</script>';
                                                }
                                                echo '<script>location.href="?act=danhsachbinhluan"</script>';
                                            }else{
                                                echo '<script>alert("'.mysqli_error($conn).'")</script>';
                                            }
                                        }
                                        $sql = "SELECT * FROM binhluan ORDER BY id_binh_luan DESC";
                                        $result = mysqli_query($conn,$sql);
                                    ?>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Bài viết số</th>
                                                    <th>Tên người bình luận</th>
                                                    <th>Nội dung bình luận</th>
                                                    <th>Phản hồi mã bình luận số</th>
                                                    <th>Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = 0;
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $i++;
                                                ?>
                                                <tr>
                                                    <!-- $row: se tra ve 1 mang du lieu tu db, ['ten_danh_muc'] thì ten_danh_muc thì xem trên database trên phpmyadmin nhé -->
                                                    <td><?=$i?></td>
                                                    <td>#<?=$row['id_tin_tuc']?></td>
                                                    <td><?=$row['ten_binh_luan']?></td>
                                                    <td><?=$row['noi_dung_binh_luan']?></td>
                                                    <td><?=$row['id_phan_hoi'] ? '#'.$row['id_phan_hoi'] : 'Không có'?></td>
                                                    <td>
                                                        <?php
                                                            if(!$row['id_phan_hoi']){
                                                        ?>
                                                        <a href="?act=phanhoi&id=<?=$row['id_binh_luan']?>&id_bai_viet=<?=$row['id_tin_tuc']?>" class="badge badge-success text-decoration-none me-3">Phản hồi</a>
                                                        <?php } ?>
                                                        <?php
                                                            if(!$row['is_lock']){
                                                        ?>
                                                        <a href="?act=danhsachbinhluan&khoabinhluan=1&id=<?=$row['id_binh_luan']?>" class="badge badge-danger text-decoration-none me-3">Khóa bình luận</a>
                                                        <?php }else{ ?>    
                                                        <a href="?act=danhsachbinhluan&khoabinhluan=0&id=<?=$row['id_binh_luan']?>" class="badge badge-primary text-decoration-none me-3">Mở khóa bình luận</a>
                                                        <?php } ?>
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