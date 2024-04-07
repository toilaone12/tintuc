<div class="row">
    <div class="col-lg-12">
        <div class="trending-tittle">
            <strong>Tin nóng</strong>
            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
            <div class="trending-animated">
                <ul id="js-news" class="js-hidden">
                    <?php
                    //Xử lý lấy tin nóng mới nhất
                    $sqlHotNews = "SELECT * FROM tintuc WHERE tin_nong = 1 ORDER BY id_tin_tuc DESC";
                    $rsHotNews = mysqli_query($conn, $sqlHotNews);
                    //chi lay ra 3 bai nong moi nhat
                    $dem = 0;
                    while ($rowHotNews = mysqli_fetch_assoc($rsHotNews)) {
                        $dem++;
                    ?>
                        <li class="news-item"><?= $rowHotNews['tieu_de_tin_tuc'] ?></li>
                    <?php
                        if ($dem == 3) break;
                    }
                    ?>
                </ul>
            </div>

        </div>
    </div>
</div>