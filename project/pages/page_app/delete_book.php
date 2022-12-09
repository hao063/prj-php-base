<?php 
    // Xóa sách
    $table = "bookstore";
    $where = "id = ".$_GET["id"];
    $file_img = $_GET['image'];
    db_delete($table, $where);
    unlink("./sql/data/{$file_img}");
    header("Location:?page=manage_book");
?>

