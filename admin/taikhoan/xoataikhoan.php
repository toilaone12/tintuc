<?php
    $id_quan_tri = $_GET['id'];
    $delete = "DELETE FROM quantri WHERE id_quan_tri = ".$id_quan_tri; //truy van sua danh muc
    $resultDelete = mysqli_query($conn,$delete);
    if($resultDelete){ // kiem tra da truy van dung chua
        echo '<script>alert("Xoá thành công")</script>';
        echo '<script>location.href="?act=danhsachtaikhoan"</script>';
    }else{
        echo mysqli_error($conn);
    }
?>