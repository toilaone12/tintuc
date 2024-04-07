<!doctype html>
<html class="no-js" lang="zxx">
<?php require_once 'head.php' ?>

<body>

    <?php require_once 'header.php' ?>
    <?php
        //vi du muon lay 5 tin tuc thi dien $so_ban_ghi_muon_lay = 5;
        $so_ban_ghi_muon_lay = 5;
        $tukhoa = isset($_GET['tukhoa']) && $_GET['tukhoa'] ? mb_strtolower(addslashes($_GET['tukhoa']),'UTF-8') : 0;
        $page = isset($_GET['page']) && $_GET['page'] ? (intval($_GET['page']) * $so_ban_ghi_muon_lay) - $so_ban_ghi_muon_lay : 0;
        //lay bai viet theo chuyen muc duoc chon
        $selectBaiViet = "SELECT * FROM tintuc WHERE tieu_de_tin_tuc LIKE '%".$tukhoa."%' ORDER BY id_tin_tuc DESC LIMIT $page,$so_ban_ghi_muon_lay";
        $resultBaiViet = mysqli_query($conn,$selectBaiViet);
        $selectAll = "SELECT * FROM tintuc WHERE tieu_de_tin_tuc LIKE '%".$tukhoa."%'"; 
        $resultAll = mysqli_query($conn,$selectAll);
        $countAll = ceil($resultAll->num_rows / $so_ban_ghi_muon_lay);
    ?>
    <main>
        <section class="whats-news-area pt-50 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row d-flex justify-content-between mb-30">
                            <div class="col-12">
                                <h4>Từ khóa tìm kiếm: <?=$tukhoa?></h4>
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
                                                    while($rowBaiViet = mysqli_fetch_assoc($resultBaiViet)){
                                                        $select = "SELECT * FROM danhmuc WHERE id_danh_muc = ".$rowBaiViet['id_danh_muc']; 
                                                        $result = mysqli_query($conn,$select);
                                                        $row = mysqli_fetch_assoc($result);
                                                ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="d-flex mb-20">
                                                        <div class="what-img mr-3">
                                                            <img src="../image/<?=$rowBaiViet['anh_tin_tuc']?>" width="140" height="93" loading="lazy" style="object-fit:cover"  alt="">
                                                        </div>
                                                        <div class="what-cap">
                                                            <div style="font-size: 15px;">
                                                                <a href="?act=chitietbaiviet&id=<?=$rowBaiViet['id_tin_tuc']?>" style="color: #000;" class="font-weight-bold hover-news">
                                                                    <?=$rowBaiViet['tieu_de_tin_tuc']?>
                                                                </a>
                                                            </div>
                                                            <div class="bg-category">
                                                                <?=$row['ten_danh_muc']?>
                                                            </div>
                                                            <p style="font-size: 14px; line-height: 1.6;" class="text-secondary">
                                                                <?=$rowBaiViet['sapo_tin_tuc']?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Nav Card -->
                            </div>
                        </div>
                        <!--Start pagination -->
                        <div class="pagination-area pt-50 pb-50 text-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="single-wrap d-flex justify-content-center">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-start">
                                                    <?php
                                                        for($i = 1; $i <= $countAll; $i++){
                                                    ?>
                                                    <li class="page-item <?= isset($_GET['page']) && $_GET['page'] == $i ? 'active' : ''?>">
                                                        <a class="page-link" href="?act=timkiem&tukhoa=<?=$tukhoa?>&page=<?=$i?>"><?='0'.$i?></a>
                                                    </li>
                                                    <?php
                                                        }
                                                    ?>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End pagination  -->
                    </div>
                    <div class="col-lg-4">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-40">
                            <h3>Tin đọc nhiều</h3>
                        </div>
                        <?php
                            //xu ly tin lien quan
                            $lay_doc_nhieu = "SELECT * FROM tintuc ORDER BY luot_xem DESC LIMIT 5";
                            $rs_lay_doc_nhieu = mysqli_query($conn,$lay_doc_nhieu);
                        ?>
                        <!-- Flow Socail -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="whats-news-caption">
                                            <div class="row">
                                                <?php
                                                    while($row_tin_doc_nhieu = mysqli_fetch_assoc($rs_lay_doc_nhieu)){
                                                ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="d-flex mb-20">
                                                        <div class="what-img mr-3">
                                                            <img src="../image/<?=$row_tin_doc_nhieu['anh_tin_tuc']?>" width="140" height="93" loading="lazy" style="object-fit:cover"  alt="">
                                                        </div>
                                                        <div class="what-cap">
                                                            <span style="font-size: 15px;"><a href="?act=chitietbaiviet&id=<?=$row_tin_doc_nhieu['id_tin_tuc']?>" style="color: #000;" class="font-weight-bold hover-news"><?=$row_tin_doc_nhieu['tieu_de_tin_tuc']?></a></span>
                                                        </div>
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
                        <!-- New Poster -->
        
                    </div>
                </div>
            </div>
        </section>
        <!-- Whats New End -->
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
                    <div class="col-xl-3 col-lg-3 col-md-4  col-sm-6">
                        <div class="single-footer-caption mt-60">
                            <div class="footer-tittle">
                                <h4>Newsletter</h4>
                                <p>Heaven fruitful doesn't over les idays appear creeping</p>
                                <!-- Form -->
                                <div class="footer-form">
                                    <div id="mc_embed_signup">
                                        <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative mail_part">
                                            <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address" class="placeholder hide-on-focus" onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '">
                                            <div class="form-icon">
                                                <button type="submit" name="submit" id="newsletter-submit" class="email_icon newsletter-submit button-contactForm"><img src="assets/img/logo/form-iocn.png" alt=""></button>
                                            </div>
                                            <div class="mt-10 info"></div>
                                        </form>
                                    </div>
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