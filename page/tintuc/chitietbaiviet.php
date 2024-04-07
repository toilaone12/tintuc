<!doctype html>
<html class="no-js" lang="zxx">
<?php require_once 'head.php'; ?>

<body>

    <?php require_once 'header.php' ?>
    <?php
    // lay thong tin bai viet duoc chon
    $id = $_GET['id'];
    $select = "SELECT * FROM tintuc WHERE id_tin_tuc = " . $id;
    $rs = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($rs);
    $update = "UPDATE tintuc SET luot_xem = ".(intval($row['luot_xem']) + 1)." WHERE id_tin_tuc = ".$id;
    $rsUpdate = mysqli_query($conn, $update);  
    //xu ly dangg comment
    if (isset($_POST['send_comment'])) {
        $ten_binh_luan = $_POST['ten_binh_luan'];
        $noi_dung_binh_luan = mysqli_real_escape_string($conn,$_POST['noi_dung_binh_luan']);
        $ngay_binh_luan = date('Y-m-d H:i:s');
        $insert = "INSERT INTO binhluan VALUES ('',$id,'$ten_binh_luan','$noi_dung_binh_luan',0,0,'$ngay_binh_luan')";
        $rsInsert = mysqli_query($conn, $insert);
        if ($rsInsert) {
            echo "<script>alert('Bình luận thành công')</script>";
            echo "<script>location.href='?act=chitietbaiviet&id=" . $id . "'</script>";
        } else {
            echo "<script>alert('Bình luận thất bại')</script>";
        }
    }else if(isset($_POST['reply_comment'])){
        $ten_binh_luan = $_POST['ten_binh_luan'];
        $noi_dung_binh_luan = mysqli_real_escape_string($conn,$_POST['noi_dung_binh_luan']);
        $ngay_binh_luan = date('Y-m-d H:i:s');
        $id_phan_hoi = $_POST['id_binh_luan'];
        $insert = "INSERT INTO binhluan VALUES ('',$id,'$ten_binh_luan','$noi_dung_binh_luan',$id_phan_hoi,0,'$ngay_binh_luan')";
        $rsInsert = mysqli_query($conn, $insert);
        if ($rsInsert) {
            echo "<script>alert('Phản hồi thành công')</script>";
            echo "<script>location.href='?act=chitietbaiviet&id=" . $id . "'</script>";
        } else {
            echo "<script>alert('Phản hồi thất bại')</script>";
        }
    }
    ?>
    <main>
        <!-- About US Start -->
        <div class="about-area mb-100">
            <div class="container">
                <!-- Hot Aimated News Tittle-->
                <?php require_once 'trending.php' ?>

                <div class="row">
                    <div class="col-lg-9">
                        <h1><?= $row['tieu_de_tin_tuc'] ?></h1>
                        <!-- Trending Tittle -->
                        <div class="about-right mb-30">
                            <div class="mt-5">
                                <?= $row['noi_dung_tin_tuc'] ?>
                            </div>
                        </div>
                        <div class="mb-90">
                            Từ khóa: 
                            <?php
                                //lay ra tag bai viet neu co
                                if($row['the_tu_khoa']){
                                    $mang_tu_khoa = explode("|",$row['the_tu_khoa']);
                                    $mang_tu_khoa = array_filter($mang_tu_khoa);
                                }
                                foreach($mang_tu_khoa as $key => $the){
                            ?>
                            <span class="bg-danger rounded px-2 py-1 mr-2">
                                <a class="text-light" href="?act=timkiemthe&tukhoa=<?=$the?>"><?=$the?></a>
                            </span>
                            <?php } ?>
                        </div>
                        <!-- From -->
                        <div class="row">
                            <div class="col-lg-6">
                                <form class="form-contact mb-80" method="post" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <textarea class="form-control w-100 error" name="noi_dung_binh_luan" id="message" cols="30" rows="9" onblur="this.placeholder = 'Nhập nội dung'" placeholder="Nhập nội dung"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input class="form-control error" name="ten_binh_luan" id="ten_binh_luan" type="text" onblur="this.placeholder = 'Nhập tên'" placeholder="Nhập tên">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" name="send_comment" class="button-comment">Gửi</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <h3>Danh sách bình luận</h3>
                                <?php
                                    //xu ly danh sach binh luan
                                    $danhsach = "SELECT * FROM binhluan WHERE is_lock = 0 and id_phan_hoi = 0 and id_tin_tuc = ".$_GET['id'];
                                    $rsDanhSach = mysqli_query($conn,$danhsach);
                                ?>
                                <section class="gradient-custom">
                                    <div class="row">
                                        <div class="col">
                                            <?php 
                                                while($rowDanhSach = mysqli_fetch_assoc($rsDanhSach)) {
                                                    //quy doi chu cai dau trong ten
                                                    $ten_binh_luan = $rowDanhSach['ten_binh_luan'];
                                                    $chu_cai_dau_ten_bl = explode(' ',$ten_binh_luan);
                                                    $chu_cai_dau_ten_bl = end($chu_cai_dau_ten_bl);
                                                    $chu_cai_dau_ten_bl = mb_substr($chu_cai_dau_ten_bl,0,1,'UTF-8');
                                            ?>
                                            <div class="d-flex flex-start mt-2">
                                                <div class="flex-grow-1 flex-shrink-1">
                                                    <div>
                                                        <div class="d-flex justify-content-start align-items-center mb-2">
                                                            <span class="badge badge-danger mr-3 p-2"><?=$chu_cai_dau_ten_bl?></span>
                                                            <span class="">
                                                                <?=$rowDanhSach['ten_binh_luan']?> <span class="small">- <?=date('d/m/Y',strtotime($rowDanhSach['ngay_binh_luan']))?></span>
                                                            </span>
                                                            <a style="cursor: pointer;">
                                                                <span class="bg-primary p-1 text-light rounded ml-3 reply-comment" 
                                                                    data-id="<?=$rowDanhSach['id_binh_luan']?>" 
                                                                    data-news="<?=$rowDanhSach['id_tin_tuc']?>"  style="font-size: 13px;">
                                                                    Phản hồi
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <p class="border px-2 py-1 w-100 mb-0 ml-4">
                                                            <?=$rowDanhSach['noi_dung_binh_luan']?>
                                                        </p>
                                                    </div>
                                                    <div class="form-reply form-reply-<?=$rowDanhSach['id_binh_luan']?>">
                                                    </div>
                                                    <?php
                                                        //danh sach nguoi phan hoi
                                                        $danhsachphanhoi = "SELECT * FROM binhluan WHERE is_lock = 0 and id_phan_hoi = ".$rowDanhSach['id_binh_luan']." and id_tin_tuc = ".$_GET['id'];
                                                        $rsDanhSachPhanHoi = mysqli_query($conn,$danhsachphanhoi);
                                                        while($rowDanhSachPhanHoi = mysqli_fetch_assoc($rsDanhSachPhanHoi)){
                                                            $ten_binh_luan = $rowDanhSachPhanHoi['ten_binh_luan'];
                                                            $chu_cai_dau_ten_ph = explode(' ',$ten_binh_luan);
                                                            $chu_cai_dau_ten_ph = end($chu_cai_dau_ten_ph);
                                                            $chu_cai_dau_ten_ph = mb_substr($chu_cai_dau_ten_ph,0,1,'UTF-8');
                                                    ?>
                                                    <div class="mt-2 ml-4">
                                                        <div class="d-flex justify-content-start align-items-center mb-2">
                                                            <span class="badge badge-danger p-2 mr-3"><?=$chu_cai_dau_ten_ph?></span>
                                                            <span class="">
                                                                <?=$rowDanhSachPhanHoi['ten_binh_luan']?> <span class="small">- <?=date('d/m/Y',strtotime($rowDanhSachPhanHoi['ngay_binh_luan']))?></span>
                                                            </span>
                                                        </div>
                                                        <p class="border px-2 py-1 w-100 mb-0 ml-4">
                                                            <?=$rowDanhSachPhanHoi['noi_dung_binh_luan']?>
                                                        </p>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-40">
                            <h3>Tin liên quan</h3>
                        </div>
                        <?php
                            //xu ly tin lien quan
                            $lay_tin_lq = "SELECT * FROM tintuc WHERE id_tin_tuc != ".$id.' AND id_danh_muc = '.$row['id_danh_muc'].' ORDER BY tin_nong DESC LIMIT 5';
                            $rs_lay_tin_lq = mysqli_query($conn,$lay_tin_lq);
                        ?>
                        <!-- Flow Socail -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="whats-news-caption">
                                            <div class="row">
                                                <?php
                                                    while($row_tin_lq = mysqli_fetch_assoc($rs_lay_tin_lq)){
                                                ?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="d-flex mb-20">
                                                        <div class="what-img mr-3">
                                                            <img src="../image/<?=$row_tin_lq['anh_tin_tuc']?>" width="140" height="93" loading="lazy" style="object-fit:cover"  alt="">
                                                        </div>
                                                        <div class="what-cap">
                                                            <span style="font-size: 15px;"><a href="?act=chitietbaiviet&id=<?=$row_tin_lq['id_tin_tuc']?>" style="color: #000;" class="font-weight-bold hover-news"><?=$row_tin_lq['tieu_de_tin_tuc']?></a></span>
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
                        <div class="news-poster d-none d-lg-block mt-50">
                            <img src="assets/img/news/news_card.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About US End -->
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
                                            <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address" class="placeholder hide-on-focus" onblur="this.placeholder = ' Email Address '">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let replys = document.querySelectorAll('.reply-comment');
            replys.forEach((reply) => {
                reply.addEventListener('click', function(){
                    let id = reply.dataset.id;
                    let idNews = reply.dataset.news;
                    let html = `<form class="form-contact mb-10 ml-5 mt-10" method="POST" novalidate="novalidate">
                        <input type="hidden" name="id_binh_luan" value="${id}"/>
                        <input type="hidden" name="id_tin_tuc" value="${idNews}"/>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control error" name="ten_binh_luan" id="ten_binh_luan" type="text" onblur="this.placeholder = 'Nhập tên'" placeholder="Nhập tên">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" name="noi_dung_binh_luan" placeholder="Nhập nội dung" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-10">
                            <button type="submit" name="reply_comment" class="button-comment">Gửi</button>
                        </div>
                    </form>`
                    document.querySelectorAll('.form-reply').forEach(function(element) {
                        if (!element.classList.contains('form-reply-' + id)) {
                            element.style.display = 'none';
                        }
                    });
                    let replyForm = document.querySelector('.form-reply-' + id);
                    replyForm.innerHTML = html;
                    replyForm.style.display = 'block';
                })
            })
        })
    </script>
</body>

</html>