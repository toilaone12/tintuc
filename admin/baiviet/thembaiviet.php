<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thêm bài viết</title>
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
        <!-- lấy nội dung từ file navbar.php -->
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
                // <!-- Xử lý lấy danh sách danh mục cha-->
                $sqlDanhMucCha = "SELECT * FROM danhmuc WHERE id_cha_danh_muc = 0 ORDER BY id_danh_muc DESC";
                $resultDanhMucCha = mysqli_query($conn,$sqlDanhMucCha);
                // Xử lý thêm bài viết
                // Đầu tiên lấy thông tin vừa được gửi lên server (qua phương thức POST)
                if(isset($_POST['thembaiviet'])){ // check phuong thuc POST có tồn tại không và $_POST['thembaiviet'] có tồn tại k (thembaiviet là cái name ở nút button Xác nhận)
                    $file_tin_tuc = $_FILES['file']['name']; //lay thong tin ten file vua chon anh (vi du: a.jpg, b.png)
                    $tmp_tin_tuc = $_FILES['file']['tmp_name']; //lay thong tin duong dan file tam thoi vua chon anh (vi du: a.jpg, b.png)
                    $tieu_de_tin_tuc = mysqli_real_escape_string($conn,$_POST['tieu_de_tin_tuc']); // những thứ trong $_POST chính là cái name của thẻ input    
                    $sapo_tin_tuc = mysqli_real_escape_string($conn,$_POST['sapo_tin_tuc']); // những thứ trong $_POST chính là cái name của thẻ input    
                    $noi_dung_tin_tuc = mysqli_real_escape_string($conn,$_POST['noi_dung_tin_tuc']); // những thứ trong $_POST chính là cái name của thẻ input    
                    $id_danh_muc = $_POST['id_danh_muc']; // những thứ trong $_POST chính là cái name của thẻ input    
                    $tin_nong = $_POST['tin_nong']; // những thứ trong $_POST chính là cái name của thẻ input    
                    $the_tu_khoa = '|'.str_replace(',','|',$_POST['the_tu_khoa']).'|'; // những thứ trong $_POST chính là cái name của thẻ input    
                    if($file_tin_tuc == ''){
                        $err_file_tin_tuc = 'Không được để trống';
                    }
                    if($tieu_de_tin_tuc == ''){ //kiem tra ten danh muc co bi trong khong
                        $err_tieu_de_tin_tuc = 'Không được để trống';
                    }
                    if($sapo_tin_tuc == ''){ //kiem tra ten danh muc co bi trong khong
                        $err_sapo_tin_tuc = 'Không được để trống';
                    }
                    if($noi_dung_tin_tuc == ''){ //kiem tra ten danh muc co bi trong khong
                        $err_noi_dung_tin_tuc = 'Không được để trống';
                    }
                    if($file_tin_tuc && $tieu_de_tin_tuc && $sapo_tin_tuc && $noi_dung_tin_tuc){
                        $ten_file_tin_tuc = pathinfo($file_tin_tuc,PATHINFO_FILENAME); // lay ra ten sau duoi file (vd: a1.jpg se lay la a1);
                        $duoi_file_tin_tuc = pathinfo($file_tin_tuc,PATHINFO_EXTENSION); // lay ra duoi file (vd: a1.jpg se lay la jpg);
                        $anh_tin_tuc = $ten_file_tin_tuc.'-'.time().'.'.$duoi_file_tin_tuc; // vi du file nhan vao la abc.jpg sau khi bien doi se thanh abc-123123213.jpg
                        $path = './image/'.$anh_tin_tuc; // day la duong dan se luu o image/ten_anh;
                        if(move_uploaded_file($tmp_tin_tuc,$path)){
                            $insert = "INSERT INTO `tintuc` VALUES ('','$anh_tin_tuc','$tieu_de_tin_tuc','$sapo_tin_tuc','$noi_dung_tin_tuc',0,$id_danh_muc,$tin_nong,'$the_tu_khoa')"; //truy van them danh muc
                            $resultInsert = mysqli_query($conn,$insert);
                            if($resultInsert){ // kiem tra da truy van dung chua
                                echo '<script>alert("Thêm thành công")</script>';
                                echo '<script>location.href="?act=danhsachbaiviet"</script>';
                            }else{
                                echo '<script>alert("'.mysqli_error($conn).'")</script>';
                                // echo '<script>location.href="?act=danhsachbaiviet"</script>';
                            }
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
                                    <h4 class="card-title">Thêm bài viết</h4>
                                    <!-- a sẽ thêm bài viết thông qua form với phương thức là POST (gửi dữ liệu lên server), enctype="multipart/form-data": giúp người dùng có thể truyền file phương tiện -->
                                    <form class="forms-sample" method="POST" enctype="multipart/form-data"> 
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="anh">Ảnh <span class="text-danger" title="Bắt buộc">(*)</span></label>
                                                    <input type="file" name="file" require id="anh" class="form-control pb-4">
                                                    <p class="text-danger fs-6 mt-2">
                                                        <?= isset($err_file_tin_tuc) && $err_file_tin_tuc ? $err_file_tin_tuc : '' ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Danh mục bài viết <span class="text-danger" title="Bắt buộc">(*)</span></label>
                                                    <select name="id_danh_muc" id="" class="form-select" require>
                                                        <?php
                                                            while($rowDanhMucCha = mysqli_fetch_assoc($resultDanhMucCha)){
                                                        ?>
                                                        <option value="<?=$rowDanhMucCha['id_danh_muc']?>"><?=$rowDanhMucCha['ten_danh_muc']?></option>
                                                        <?php
                                                            //xu ly lay danh muc con tu danh muc cha
                                                            $sqlDanhMucCon = "SELECT * FROM danhmuc WHERE id_cha_danh_muc = ".$rowDanhMucCha['id_danh_muc'];
                                                            $rsDanhMucCon = mysqli_query($conn,$sqlDanhMucCon);
                                                            while($rowDanhMucCon = mysqli_fetch_assoc($rsDanhMucCon)){
                                                        ?>
                                                        <option value="<?=$rowDanhMucCon['id_danh_muc']?>">|---<?=$rowDanhMucCon['ten_danh_muc']?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Tiêu đề <span class="text-danger" title="Bắt buộc">(*)</span></label>
                                            <input type="text" class="form-control" name="tieu_de_tin_tuc" require id="exampleInputUsername1" placeholder="Nhập tiêu đề">
                                            <p class="text-danger fs-6 mt-2">
                                                <?= isset($err_tieu_de_tin_tuc) && $err_tieu_de_tin_tuc ? $err_tieu_de_tin_tuc : '' ?>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Sapo (phần dưới tiêu đề) <span class="text-danger" title="Bắt buộc">(*)</span></label>
                                            <input type="text" class="form-control" name="sapo_tin_tuc" require id="exampleInputUsername1" placeholder="Nhập sapo">
                                            <p class="text-danger fs-6 mt-2">
                                                <?= isset($err_sapo_tin_tuc) && $err_sapo_tin_tuc ? $err_sapo_tin_tuc : '' ?>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nội dung <span class="text-danger" title="Bắt buộc">(*)</span></label>
                                            <textarea name="noi_dung_tin_tuc"></textarea>
                                            <p class="text-danger fs-6 mt-2">
                                                <?= isset($err_noi_dung_tin_tuc) && $err_noi_dung_tin_tuc ? $err_noi_dung_tin_tuc : '' ?>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Tin nóng <span class="text-danger" title="Bắt buộc">(*)</span></label>
                                                    <select name="tin_nong" class="form-select" id="">
                                                        <option value="0">Không</option>
                                                        <option value="1">Có</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Từ khóa</label>
                                                    <input type="text" class="form-control" name="the_tu_khoa" require id="exampleInputUsername1" placeholder="Nhập từ khóa">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2" name="thembaiviet">Xác nhận</button>
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
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <!-- <script src="../assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
    <script>
        CKEDITOR.replace('noi_dung_tin_tuc');
        CKEDITOR.config.pasteFormWordPromptCleanup = true;
        CKEDITOR.config.pasteFormWordRemoveFontStyles = false;
        CKEDITOR.config.pasteFormWordRemoveStyles = false;
        CKEDITOR.config.language = 'vi';
        CKEDITOR.config.htmlEncodeOutput = false;
        CKEDITOR.config.ProcessHTMLEntities = false;
        CKEDITOR.config.entities = false;
        CKEDITOR.config.entities_latin = false;
        CKEDITOR.config.ForceSimpleAmpersand = true;

    </script>
</body>

</html>