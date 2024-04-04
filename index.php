<?php
    session_start();
    require_once './config/database.php';
    $act = isset($_GET['act']) && $_GET['act'] ? addslashes($_GET['act']) : '';
    if($act == 'danhsachdanhmuc'){
        require_once './admin/danhmuc/danhsachdanhmuc.php';
    }else if($act == 'themdanhmuc'){
        require_once './admin/danhmuc/themdanhmuc.php';
    }else if($act == 'suadanhmuc'){
        require_once './admin/danhmuc/suadanhmuc.php';
    }else if($act == 'xoadanhmuc'){
        require_once './admin/danhmuc/xoadanhmuc.php';
    }else if($act == 'timkiemdanhmuc'){
        require_once './admin/danhmuc/timkiemdanhmuc.php';
    }else{
        require_once './admin/trangchu.php';
    }
?>