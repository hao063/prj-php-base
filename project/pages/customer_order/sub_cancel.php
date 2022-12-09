<?php 
// khi người dùng ấn hủy đơn hàng
$time = date('Y-m-d H:i:s');
 if(isset($_POST['submit_cancel'])){
        $cancel_order = $_POST['cancel_order'];
        $sql = "UPDATE `order` SET `status` = 3, `response_at` = '$time' WHERE id = '$cancel_order'";
        db_query($sql);
        header_js('?page=customer_order&page_or=all');
}
?>