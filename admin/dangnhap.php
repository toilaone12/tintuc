<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng nhập </title>
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
    if(isset($_POST['dangnhap'])){
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
        if($username && $password){
            $sql = "SELECT * FROM quantri WHERE ten_tai_khoan = '$username' and mat_khau = '$md5_password' LIMIT 1";
            // var_dump($sql); die;
            $result = mysqli_query($conn,$sql);
            if($result && $result->num_rows){
                $row = mysqli_fetch_assoc($result);
                setcookie('id_quan_tri', $row['id_quan_tri'], time() + (365 * 24 * 60 * 60)); // set 1 nam
                // Thiết lập cookie ten_dang_nhap với thời gian hết hạn là 2 tháng
                setcookie('ten_dang_nhap', $username, time() + (2 * 30 * 24 * 60 * 60)); // set 2 thang
                header("Location: ?act=trangchu");
            }else{
                echo '<script>alert("Tài khoản hoặc mật khẩu không chính xác")</script>';
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
                            <h6 class="fw-light">Đăng nhập để vào trang chủ.</h6>
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
                                    <button type="submit" name="dangnhap" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Đăng nhập</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <a href="#" class="auth-link text-black" onclick="alert('Thông báo với quản trị viên để cung cấp mật khẩu')">Quên mật khẩu?</a>
                                </div>
                                <div class="text-center mt-4 fw-light">
                                    Bạn không có tài khoản? <a href="?act=dangky" class="text-primary">Đăng ký</a>
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