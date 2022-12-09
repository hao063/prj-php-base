<?php


get_header_customer();
// menu của thông tin đặt hàng khách hàng(header) => cố định
?>


<?php 
// có thể thay đổi
// nhận url liên kết tới 1 trong các file trong folder customer_order
    if(isset($_GET['page_or'])){
        $page_or = $_GET["page_or"];
        $path_pages_or = "pages/customer_order/{$page_or}.php";
        if(file_exists($path_pages_or)){
            require $path_pages_or;
        }
        else{
            echo "trang này không tồn tại";
        }
    }
    else{
        require "pages/customer_order/all.php";
    }

?>

<?php 
// footer của thông tin đặt hàng => cố định
get_footer_customer();

?>

