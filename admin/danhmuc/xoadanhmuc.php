<?php
    $id_danh_muc = $_GET['id'];
    $delete = "DELETE FROM danhmuc WHERE id_danh_muc = ".$id_danh_muc; //truy van sua danh muc
    $resultDelete = mysqli_query($conn,$delete);
    if($resultDelete){ // kiem tra da truy van dung chua
        echo '<script>alert("Xoá thành công")</script>';
        echo '<script>location.href="?act=danhsachdanhmuc"</script>';
    }else{
        echo mysqli_error($conn);
    }
?>