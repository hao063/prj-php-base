<?php

// menu trong quản lí đơn hàng (header) => cố định
get_header_admin();

?>


<?php 
// có thể thay đổi
// nhận url từ các file trong folder manager_admin 
    if(isset($_GET['page_ad'])){
        $page_ad = $_GET["page_ad"];
        $path_pages_ad = "pages/manager_admin/{$page_ad}.php";
        if(file_exists($path_pages_ad)){
            require $path_pages_ad;
        }
        else{
            echo "trang này không tồn tại";
        }
    }
    else{
        require "pages/manager_admin/new_orders.php";
    }
?>

<?php 

get_footer_admin();
// footer trong quản lí đơn hàng => cố định
?>

