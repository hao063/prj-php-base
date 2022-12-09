<?php 
    // Xóa bình luận (admin thao tác)
    $table = "judge";
    $id_product = $_GET['id_product_detail'];
    $where = "id = ".$_GET["id"];
    db_delete($table, $where);
    header("Location:?page=product_details&id_product_detail={$id_product}");
?>