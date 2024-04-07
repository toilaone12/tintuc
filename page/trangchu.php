<!doctype html>
<html class="no-js" lang="zxx">
<?php require_once 'head.php'; ?>

<body>

    <?php require_once 'header.php' ?>

    <main>
        <!-- Trending Area Start -->
        <div class="trending-area fix">
            <div class="container">
                <div class="trending-main">
                    <!-- Trending Tittle -->
                    <?php require_once 'trending.php' ?>
                    <div class="row">
                        <div class="col-lg-8">
                            <?php
                            //chi lay 1 tin nong 
                            $dem1 = 0;
                            $id_danh_muc_1 = 0;
                            $id_tin_tuc = 0;
                            while ($rowHotNews1 = mysqli_fetch_assoc($rsHotNews)) {
                                $id_tin_tuc = $rowHotNews1['id_tin_tuc'];
                                $id_danh_muc_1 = $rowHotNews1['id_danh_muc'];
                                $sql = "SELECT * FROM danhmuc WHERE id_danh_muc = " . $rowHotNews1['id_danh_muc'];
                                $rs = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($rs);
                                // unset($rowHotNews1);
                                $dem1++;
                            ?>
                                <!-- Trending Top -->
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <img src="../image/<?= $rowHotNews1['anh_tin_tuc']; ?>" width="770" height="410" loading="lazy" style="object-fit: cover;" alt="">
                                        <div class="trend-top-cap">
                                            <span><?= $row['ten_danh_muc'] ?></span>
                                            <h2><a href="?act=chitietbaiviet&id=<?= $rowHotNews1['id_tin_tuc'] ?>"><?= $rowHotNews1['tieu_de_tin_tuc'] ?></a></h2>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                if ($dem1 == 1);
                                break;
                            }
                            ?>
                        </div>
                        <!-- Riht content -->
                        <div class="col-lg-4">
                            <?php
                            //xu ly lay 3 tin nong khac tin nong dau tine
                            $sqlHotNews2 = "SELECT * FROM tintuc WHERE tin_nong = 1 AND id_tin_tuc != $id_tin_tuc ORDER BY id_tin_tuc DESC LIMIT 3";
                            $rsHotNews2 = mysqli_query($conn, $sqlHotNews2);
                            while ($row2 = mysqli_fetch_assoc($rsHotNews2)) {
                                $sql = "SELECT * FROM danhmuc WHERE id_danh_muc = " . $row2['id_danh_muc'];
                                $rs = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($rs);
                            ?>
                                <div class="trand-right-single d-flex">
                                    <div class="trand-right-img">
                                        <img src="../image/<?= $row2['anh_tin_tuc']; ?>" width="120" height="100" loading="lazy" style="object-fit: cover;" alt="">
                                    </div>
                                    <div class="trand-right-cap">
                                        <span class="color1"><?= $row['ten_danh_muc'] ?></span>
                                        <h4><a href="?act=chitietbaiviet&id=<?= $row2['id_tin_tuc'] ?>"><?= $row2['tieu_de_tin_tuc'] ?></a></h4>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Trending Area End -->
        <!-- Whats New Start -->
        <section class="whats-news-area pt-50 pb-20">
            <div class="container">
                <div class="row">
                    <?php
                        $sqlDM = "SELECT * FROM danhmuc WHERE id_cha_danh_muc = 0 ORDER BY id_danh_muc DESC";
                        $rsDM = mysqli_query($conn,$sqlDM);
                        $dem3 = 0;
                        while($row3 = mysqli_fetch_assoc($rsDM)){
                            $dem3++;
                            // phan du lich
                            if($dem3 == 1){
                    ?>
                    <div class="col-lg-4 border-right">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-4 col-md-4">
                                <div class="section-tittle mb-30">
                                    <h4><a class="hover-cate" href="?act=danhmuc&id=<?=$row3['id_danh_muc']?>"><?=$row3['ten_danh_muc']?></a></h4>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="properties__button">
                                    <!--Nav Button  -->
                                    <nav>
                                        <div class="mt-1" id="nav-tab" role="tablist">
                                            <?php
                                                $sqlDMCon = "SELECT * FROM danhmuc WHERE id_cha_danh_muc = ".$row3['id_danh_muc']." ORDER BY id_danh_muc DESC LIMIT 2";
                                                $dem4 = 0;
                                                $rsDMCon = mysqli_query($conn,$sqlDMCon);
                                                while($rowDMCon = mysqli_fetch_assoc($rsDMCon)){
                                                    $dem4++;
                                            ?>
                                            <a class="text-dark <?=$dem4 == 2 ? 'pr-3' : ''?>" href="?act=danhmuc&id=<?=$rowDMCon['id_danh_muc']?>" style="font-size: 13px; float:right;"><?=$rowDMCon['ten_danh_muc']?></a>
                                            <?php
                                                }
                                            ?>
                                            
                                        </div>
                                    </nav>
                                    <!--End Nav Button  -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Nav Card -->
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- card one -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="whats-news-caption">
                                            <div class="row">
                                                <?php
                                                    $sqlBaiVietDM = "SELECT * FROM tintuc WHERE id_danh_muc = ".$row3['id_danh_muc'];
                                                    $rsBaiVietDM = mysqli_query($conn,$sqlBaiVietDM);
                                                    $dem5 = 0;
                                                    while($rowBaiVietDM = mysqli_fetch_assoc($rsBaiVietDM)){
                                                        $dem5++;
                                                        if($dem5 == 1){
                                                ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="d-flex mb-20">
                                                        <div class="what-img mr-3">
                                                            <img src="../image/<?=$rowBaiVietDM['anh_tin_tuc']?>" width="140" height="93" loading="lazy" style="object-fit:cover"  alt="">
                                                        </div>
                                                        <div class="what-cap">
                                                            <span style="font-size: 15px;"><a href="?act=chitietbaiviet&id=<?=$rowBaiVietDM['id_tin_tuc']?>" style="color: #000;" class="font-weight-bold hover-news"><?=$rowBaiVietDM['tieu_de_tin_tuc']?></a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                        }else{
                                                ?>
                                                <div class="col-lg-12 col-md-12 mb-10">
                                                    <span style="font-size: 15px;"><a href="?act=chitietbaiviet&id=<?=$rowBaiVietDM['id_tin_tuc']?>" style="color: #000;" class="hover-news"><?=$rowBaiVietDM['tieu_de_tin_tuc']?></a></span>
                                                </div>
                                                <?php
                                                        }
                                                        if($dem5 == 4) break;
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Nav Card -->
                            </div>
                        </div>
                    </div>
                    <?php   
                            //phan bds
                            }else if($dem3 == 2){
                    ?>
                    <!-- phan danh muc -->
                    <div class="col-lg-4 border-right">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-6 col-md-6">
                                <div class="section-tittle mb-30">
                                    <h4><a href="?act=danhmuc&id=<?=$row3['id_danh_muc']?>" class="hover-cate"><?=$row3['ten_danh_muc']?></a></h4>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="properties__button">
                                    <!--Nav Button  -->
                                    <nav>
                                        <div class="mt-1" id="nav-tab" role="tablist">
                                            <?php
                                                $sqlDMCon = "SELECT * FROM danhmuc WHERE id_cha_danh_muc = ".$row3['id_danh_muc']." ORDER BY id_danh_muc DESC LIMIT 2";
                                                $dem4 = 0;
                                                $rsDMCon = mysqli_query($conn,$sqlDMCon);
                                                while($rowDMCon = mysqli_fetch_assoc($rsDMCon)){
                                                    $dem4++;
                                            ?>
                                            <a class="text-dark <?=$dem4 == 2 ? 'pr-3' : ''?>" href="?act=danhmuc&id=<?=$rowDMCon['id_danh_muc']?>" style="font-size: 13px; float:right;"><?=$rowDMCon['ten_danh_muc']?></a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </nav>
                                    <!--End Nav Button  -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Nav Card -->
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- card one -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="whats-news-caption">
                                            <div class="row">
                                                <?php
                                                    $sqlBaiVietDM = "SELECT * FROM tintuc WHERE id_danh_muc = ".$row3['id_danh_muc'];
                                                    $rsBaiVietDM = mysqli_query($conn,$sqlBaiVietDM);
                                                    $dem5 = 0;
                                                    while($rowBaiVietDM = mysqli_fetch_assoc($rsBaiVietDM)){
                                                        $dem5++;
                                                ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="d-flex mb-20">
                                                        <div class="what-img mr-3">
                                                            <img src="../image/<?=$rowBaiVietDM['anh_tin_tuc']?>" width="140" height="93" loading="lazy" style="object-fit:cover"  alt="">
                                                        </div>
                                                        <div class="what-cap">
                                                            <span style="font-size: 15px;"><a href="?act=chitietbaiviet&id=<?=$rowBaiVietDM['id_tin_tuc']?>" style="color: #000;" class="font-weight-bold hover-news"><?=$rowBaiVietDM['tieu_de_tin_tuc']?></a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                        if($dem5 == 3) break;
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Nav Card -->
                            </div>
                        </div>
                    </div>
                    <?php
                            //phan thoi su
                            }else if($dem3 == 4){
                    ?>
                    <div class="col-lg-4 border-right">
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-4 col-md-4">
                                <div class="section-tittle mb-30">
                                    <h4><a href="?act=danhmuc&id=<?=$row3['id_danh_muc']?>" class="hover-cate"><?=$row3['ten_danh_muc']?></a></h4>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="properties__button">
                                    <!--Nav Button  -->
                                    <nav>
                                        <div class="mt-1" id="nav-tab" role="tablist">
                                            <?php
                                                $sqlDMCon = "SELECT * FROM danhmuc WHERE id_cha_danh_muc = ".$row3['id_danh_muc']." ORDER BY id_danh_muc DESC LIMIT 2";
                                                $dem4 = 0;
                                                $rsDMCon = mysqli_query($conn,$sqlDMCon);
                                                while($rowDMCon = mysqli_fetch_assoc($rsDMCon)){
                                                    $dem4++;
                                            ?>
                                            <a class="text-dark <?=$dem4 == 2 ? 'pr-3' : ''?>" href="?act=danhmuc&id=<?=$rowDMCon['id_danh_muc']?>" style="font-size: 13px; float:right;"><?=$rowDMCon['ten_danh_muc']?></a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </nav>
                                    <!--End Nav Button  -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- Nav Card -->
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- card one -->
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="whats-news-caption">
                                            <div class="row">
                                                <?php
                                                    $sqlBaiVietDM = "SELECT * FROM tintuc WHERE id_danh_muc = ".$row3['id_danh_muc'];
                                                    $rsBaiVietDM = mysqli_query($conn,$sqlBaiVietDM);
                                                    $dem5 = 0;
                                                    while($rowBaiVietDM = mysqli_fetch_assoc($rsBaiVietDM)){
                                                        $dem5++;
                                                ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="d-flex mb-20">
                                                        <div class="what-img mr-3">
                                                            <img src="../image/<?=$rowBaiVietDM['anh_tin_tuc']?>" width="140" height="93" loading="lazy" style="object-fit:cover"  alt="">
                                                        </div>
                                                        <div class="what-cap">
                                                            <span style="font-size: 15px;"><a href="?act=chitietbaiviet&id=<?=$rowBaiVietDM['id_tin_tuc']?>" style="color: #000;" class="font-weight-bold hover-news"><?=$rowBaiVietDM['tieu_de_tin_tuc']?></a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                        if($dem5 == 3) break;
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Nav Card -->
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
        <!-- Whats New End -->
        <!--   Weekly2-News start -->
        <div class="weekly2-news-area  weekly2-pading gray-bg">
            <div class="container">
                <div class="weekly2-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>Tin nhiều lượt đọc</h3>
                            </div>
                        </div>
                    </div>
                    <?php
                        //lay ra tin duoc doc nhieu nhat (lay theo luot_xem)
                        $tin_doc_nhieu = "SELECT * FROM tintuc ORDER BY luot_xem DESC LIMIT 5";
                        $rs_tin_doc_nhieu = mysqli_query($conn,$tin_doc_nhieu);
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="weekly2-news-active dot-style d-flex dot-style">
                                <?php
                                    while($row_tin_doc_nhieu = mysqli_fetch_assoc($rs_tin_doc_nhieu)){
                                        $sql = "SELECT * FROM danhmuc WHERE id_danh_muc = " . $row_tin_doc_nhieu['id_danh_muc'];
                                        $rs = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($rs);
                                ?>
                                <div class="weekly2-single">
                                    <div class="weekly2-img">
                                        <img src="../image/<?=$row_tin_doc_nhieu['anh_tin_tuc']?>" alt="">
                                    </div>
                                    <div class="weekly2-caption">
                                        <span class="color1"><?=$row['ten_danh_muc']?></span>
                                        <h4><a href="?act=chitietbaiviet&id=<?=$row_tin_doc_nhieu['id_tin_tuc']?>"><?=$row_tin_doc_nhieu['tieu_de_tin_tuc']?></a></h4>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Weekly-News -->
        <!--Start pagination -->
        <!-- <div class="pagination-area pb-45 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End pagination  -->
    </main>

    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding fix">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                        <div class="single-footer-caption">
                            <div class="single-footer-caption">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="index.html"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>Suscipit mauris pede for con sectetuer sodales adipisci for cursus fames lectus tempor da blandit gravida sodales Suscipit mauris pede for con sectetuer sodales adipisci for cursus fames lectus tempor da blandit gravida sodales Suscipit mauris pede for sectetuer.</p>
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50 mt-60">
                            <div class="footer-tittle">
                                <h4>Instagram Feed</h4>
                            </div>
                            <div class="instagram-gellay">
                                <ul class="insta-feed">
                                    <li><a href="#"><img src="assets/img/post/instra1.jpg" alt=""></a></li>
                                    <li><a href="#"><img src="assets/img/post/instra2.jpg" alt=""></a></li>
                                    <li><a href="#"><img src="assets/img/post/instra3.jpg" alt=""></a></li>
                                    <li><a href="#"><img src="assets/img/post/instra4.jpg" alt=""></a></li>
                                    <li><a href="#"><img src="assets/img/post/instra5.jpg" alt=""></a></li>
                                    <li><a href="#"><img src="assets/img/post/instra6.jpg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom aera -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="footer-menu f-right">
                                <ul>
                                    <li><a href="#">Terms of use</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Breaking New Pluging -->
    <script src="./assets/js/jquery.ticker.js"></script>
    <script src="./assets/js/site.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>