<?php
    session_start();
    header("Cache-Control: no-cache, must-revalidate");
    require_once '../config/database.php';
    $act = isset($_GET['act']) && $_GET['act'] ? addslashes($_GET['act']) : '';
    //phan quan tri
    if($act == 'chitietbaiviet'){ // trang chi tiet bai viet
        require_once '../page/tintuc/chitietbaiviet.php';
    }else if($act == 'danhmuc'){ // trang danh sach danh muc
        require_once '../page/danhmuc/danhsachchuyenmuc.php';
    }else if($act == 'timkiem'){ // trang tim kiem
        require_once '../page/danhmuc/timkiembaiviet.php';
    }else if($act == 'timkiemthe'){ // trang tim kiem the bai viet (tag)
        require_once '../page/danhmuc/timkiemthebaiviet.php';
    }else{ //trang danh nhap
        require_once '../page/trangchu.php';
    }
?>