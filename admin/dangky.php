<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng ký </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<?php
    //xử lý đăng nhập
    if(isset($_POST['dangky'])){
        $username = $_POST['username'];
        $password = ($_POST['password']);
        $md5_password = md5($_POST['password']); //ma hoa md5 tranh bi danh cap thong tin
        // var_dump($password); die;
        if($username == ''){
            $err_username = 'Không được để trống';
        }
        if($password == ''){
            $err_password = 'Không được để trống';
        }
        if($username && $password){ // neu ca 2 deu da dien thong tin
            $sql = "SELECT * FROM quantri WHERE ten_tai_khoan = '$username' LIMIT 1"; //ktra ten tai khoan da ton tai chua
            $result = mysqli_query($conn,$sql);
            if($result && !$result->num_rows){
                $ho_ten_ngau_nhien = 'UID-'.rand(0000,9999); //rand nay se tao ngau nhieu tu 0000 -> 9999 va se ten ngau nhien (vi du UID-1002)
                $insert = "INSERT INTO `quantri` VALUES('','$username','$md5_password','$ho_ten_ngau_nhien')";
                $resultInsert = mysqli_query($conn,$insert);
                if($resultInsert){
                    echo '<script>alert("Đăng ký thành công")</script>';
                    echo '<script>location.href="index.php"</script>';
                }
            }else{
                echo '<script>alert("Tên tài khoản đã tồn tại")</script>';
            }
        }
    }
?>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="assets/images/logo.svg" alt="logo">
                            </div>
                            <h4>Chào mừng đến với trang quản trị viên</h4>
                            <h6 class="fw-light">Đăng ký tài khoản quản trị viên.</h6>
                            <form class="pt-3" method="POST">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên đăng nhập</label>
                                    <input type="text" name="username" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Tên tài khoản">
                                    <p class="text-danger fs-6 mt-2">
                                        <?= isset($err_username) && $err_username ? $err_username : '' ?>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mật khẩu">
                                    <p class="text-danger fs-6 mt-2">
                                        <?= isset($err_password) && $err_password ? $err_password : '' ?>
                                    </p>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" name="dangky" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Đăng ký</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <a href="#" class="auth-link text-black" onclick="alert('Thông báo với quản trị viên để cung cấp mật khẩu')">Quên mật khẩu?</a>
                                </div>
                                <div class="text-center mt-4 fw-light">
                                    Bạn không có tài khoản? <a href="?act=''" class="text-primary">Đăng nhập</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>