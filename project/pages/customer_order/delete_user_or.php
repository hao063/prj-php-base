<?php 
// xóa đơn hàng dựa trên tên của action
$id = $_GET['id'];
if($_GET['action'] == 'delete_cancel'){
    $table = 'order';
    $where = "`id` = '$id'";
    db_delete($table, $where);
    header_js('?page=customer_order&page_or=cancelled');
}

if($_GET['action'] == 'delete_accept'){
    $table = 'order';
    $where = "`id` = '$id'";
    db_delete($table, $where);
    header_js('?page=customer_order&page_or=delivered');
}

?>