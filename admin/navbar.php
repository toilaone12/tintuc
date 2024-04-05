<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="../index.html">
                <img src="assets/images/logo.svg" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="../index.html">
                <img src="assets/images/logo-mini.svg" alt="logo" />
            </a>
        </div>
    </div>
    <?php
        //xu ly len chu cai dau tien trong ten
        $sql = "SELECT * FROM quantri WHERE id_quan_tri = ".$_COOKIE['id_quan_tri'];
        $rs = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($rs);
        $ten_nguoi_dung = $row['ho_ten'];
        $chu_cai_dau_ten_nd = explode(' ',$ten_nguoi_dung);
        $chu_cai_dau_ten_nd = end($chu_cai_dau_ten_nd);
        $chu_cai_dau_ten_nd = mb_substr($chu_cai_dau_ten_nd,0,1,'UTF-8');
    ?>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <?php $hours = date('H'); ?>
                <h1 class="welcome-text"><?= $hours < 24 && $hours >= 18 ? 'Chào buổi tối' : ($hours < 18 && $hours >= 12 ? 'Chào buổi chiều' : 'Chào buổi sáng') ?>, 
                <span class="text-black fw-bold"><?= $ten_nguoi_dung;?></span>
                </h1>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="rounded bg-danger badge"><?=$chu_cai_dau_ten_nd?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <span class="rounded bg-danger badge"><?=$chu_cai_dau_ten_nd?></span>
                        <p class="mb-1 mt-3 font-weight-semibold"><?=$_COOKIE['ten_dang_nhap']?></p>
                    </div>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>Hồ sơ của tôi</a>
                    <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>