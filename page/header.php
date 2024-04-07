<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">
            <div class="header-top black-bg d-none d-md-block">
                <div class="container">
                    <div class="col-xl-12">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="header-info-left">
                                <ul>
                                    <li><?=date('d/m/Y H:i:s')?></li>
                                </ul>
                            </div>
                            <div class="header-info-right">
                                <ul class="header-social">
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li> <a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-mid d-none d-md-block">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <div class="header-banner f-right ">
                                <img src="assets/img/hero/header_card.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                            <!-- sticky -->
                            <div class="sticky-logo">
                                <a href="index.php"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-md-block">
                                <nav>
                                    <ul id="navigation">
                                        <?php
                                            //xử lý lấy danh mục cha và danh mục con
                                            $sqlDanhMucCha = "SELECT * FROM danhmuc WHERE id_cha_danh_muc = 0";
                                            $rsDanhMucCha = mysqli_query($conn,$sqlDanhMucCha);
                                        ?>
                                        <li><a href="index.php">Trang chủ</a></li>
                                        <?php
                                            $dem = 0;
                                            while($rowDanhMucCha = mysqli_fetch_assoc($rsDanhMucCha)){
                                                $dem++;
                                                //xu ly lay danh muc con
                                                $sqlDanhMucCon = "SELECT * FROM danhmuc WHERE id_cha_danh_muc = ".$rowDanhMucCha['id_danh_muc'];
                                                $rsDanhMucCon = mysqli_query($conn,$sqlDanhMucCon);
                                        ?>
                                        <li><a href="?act=danhmuc&id=<?=$rowDanhMucCha['id_danh_muc']?>"><?=$rowDanhMucCha['ten_danh_muc']?></a>
                                            <?php if($rsDanhMucCon->num_rows) { ?>
                                            <ul class="submenu">
                                                <?php
                                                    while($rowDanhMucCon = mysqli_fetch_assoc($rsDanhMucCon)){
                                                ?>
                                                <li><a href="?act=danhmuc&id=<?=$rowDanhMucCon['id_danh_muc']?>"><?=$rowDanhMucCon['ten_danh_muc']?></a></li>
                                                <?php
                                                    }
                                                ?>
                                            </ul>
                                            <?php
                                                }
                                            ?>
                                        </li>
                                        <?php 
                                                if($dem == 9) break; //khi du 9 danh muc cha thi se khong chay vong lap nua
                                            } 
                                        ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4">
                            <div class="header-right-btn f-right d-none d-lg-block">
                                <i class="fas fa-search special-tag"></i>
                                <div class="search-box">
                                    <form action="?act=timkiem" method="GET">
                                        <input type="hidden" name="act" value="timkiem">
                                        <input type="text" name="tukhoa" placeholder="Tiêu đề bài viết">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-md-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>