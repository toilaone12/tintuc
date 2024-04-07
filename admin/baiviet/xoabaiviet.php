<?php
    $id_tin_tuc = $_GET['id'];
    $delete = "DELETE FROM tintuc WHERE id_tin_tuc = ".$id_tin_tuc; //truy van sua danh muc
    $resultDelete = mysqli_query($conn,$delete);
    if($resultDelete){ // kiem tra da truy van dung chua
        echo '<script>alert("Xoá thành công")</script>';
        echo '<script>location.href="?act=danhsachbaiviet"</script>';
    }else{
        echo mysqli_error($conn);
    }
?>