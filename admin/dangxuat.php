<?php
    // Thiết lập lại cookie 'id_quan_tri' với thời gian hết hạn trong quá khứ
    if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
        unset($_COOKIE['id_quan_tri']); 
        unset($_COOKIE['ten_dang_nhap']); 
        setcookie('id_quan_tri', "", time() - 3600);
        // Thiết lập lại cookie 'ten_dang_nhap' với thời gian hết hạn trong quá khứ
        setcookie('ten_dang_nhap', "", time() - 3600);
        header('Location: index.php');
    }
?>