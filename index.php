<?php
    session_start();
    header("Cache-Control: no-cache, must-revalidate");
    require_once './config/database.php';
    $act = isset($_GET['act']) && $_GET['act'] ? addslashes($_GET['act']) : '';
    //phan quan tri
    if($act == 'danhsachdanhmuc'){ // trang danh sach danh muc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){ // ktra neu khong luu thong tin nguoi dung lap tuc out ra trang dang nhap
            require_once './admin/danhmuc/danhsachdanhmuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'themdanhmuc'){ // trang them danh muc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/danhmuc/themdanhmuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'suadanhmuc'){ // trang sua danh muc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/danhmuc/suadanhmuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'xoadanhmuc'){ // trang xoa danh muc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/danhmuc/xoadanhmuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'timkiemdanhmuc'){ // trang tim kiem danh muc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/danhmuc/timkiemdanhmuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'danhsachbaiviet'){ // trang danh sach tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/baiviet/danhsachbaiviet.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'thembaiviet'){ // trang them tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/baiviet/thembaiviet.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'suabaiviet'){ // trang sua tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/baiviet/suabaiviet.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'xoabaiviet'){ // trang xoa tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/baiviet/xoabaiviet.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'timkiembaiviet'){ // trang tim kiem tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/baiviet/timkiembaiviet.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'danhsachtaikhoan'){ // trang danh sach tai khoan
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/taikhoan/danhsachtaikhoan.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'suataikhoan'){ // trang sua tai khoan
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/taikhoan/suataikhoan.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'xoataikhoan'){ // trang xoa tai khoan
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/taikhoan/xoataikhoan.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'timkiemtaikhoan'){ // trang xoa tai khoan
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/taikhoan/timkiemtaikhoan.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'danhsachbinhluan'){ // trang danh sach binh luan
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/binhluan/danhsachbinhluan.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'timkiembinhluan'){ // trang xoa tai khoan
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/binhluan/timkiembinhluan.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'phanhoi'){ // trang xoa tai khoan
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/binhluan/phanhoi.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'trangchu'){ // trang chu
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/trangchu.php';
        }else{
            header('Location: index.php');
        }
    }else if($act == 'hosocanhan'){ // trang thong tin ca nhan
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/hosocanhan.php';
        }else{
            header('Location: index.php');
        }
    }else if($act == 'dangxuat'){ // trang dang xuat
        require_once './admin/dangxuat.php';
    }else if($act == 'dangky'){ // trang dang ky
        require_once './admin/dangky.php';
    }else{ //trang danh nhap
        require_once './admin/dangnhap.php';
    }
?>