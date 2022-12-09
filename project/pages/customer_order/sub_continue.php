<?php 
// khi đang hủy đặt hàng những người dùng ăn tiếp tục
$time = date('Y-m-d H:i:s');
 if(isset($_POST['submit_cancel'])){
        $cancel_order = $_POST['cancel_order'];
        $sql = "UPDATE `order` SET `status` = null, `response_at` = '$time' WHERE id = '$cancel_order'";
        db_query($sql);
        header_js('?page=customer_order&page_or=wait_config');
}
?>