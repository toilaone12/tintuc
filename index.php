<?php
    session_start();
    require_once './config/database.php';
    $act = isset($_GET['act']) && $_GET['act'] ? addslashes($_GET['act']) : '';
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
    }else if($act == 'danhsachtintuc'){ // trang danh sach tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/tintuc/danhsachtintuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'themtintuc'){ // trang them tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/tintuc/themtintuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'suatintuc'){ // trang sua tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/tintuc/suatintuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'xoatintuc'){ // trang xoa tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/tintuc/xoatintuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'timkiemtintuc'){ // trang tim kiem tin tuc
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/tintuc/timkiemtintuc.php';
        }else{
            header("Location: index.php");
        }
    }else if($act == 'trangchu'){ // trang chu
        if(isset($_COOKIE['id_quan_tri']) && $_COOKIE['id_quan_tri']){
            require_once './admin/trangchu.php';
        }else{
            header('Location: index.php');
        }
    }else{ //trang danh nhap
        require_once './admin/dangnhap.php';
    }
?>