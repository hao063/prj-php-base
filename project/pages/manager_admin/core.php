<?php 
$id = $_GET['id'];
if($_GET['action'] == 'delete'){
    $table = 'preventive_order';
    $where = "`id` = '$id'";
    db_delete($table, $where);
    header_js('?page=manage_order&page_ad=is_order');
}
if($_GET['action'] == 'delete2'){
    $table = 'preventive_order';
    $where = "`id` = '$id'";
    db_delete($table, $where);
    header_js('?page=manage_order&page_ad=cancel_order');
}

?>