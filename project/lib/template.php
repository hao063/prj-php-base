<?php 
// header và footer chính
function get_header(){
    $path_header = "inc/header.php";
    if(file_exists($path_header)){
        require $path_header;
    }
    else{
        echo "trang này không tồn tại";
    }
}
function get_footer(){
    $path_footer = "inc/footer.php";
    if(file_exists($path_footer)){
        require $path_footer;
    }
    else{
        echo "trang này không tồn tại";
    }
}
// header và footer con (thong tin đơn hàng của khách hàng)
function get_header_customer(){
    $path_header = "inc/header_order.php";
    if(file_exists($path_header)){
        require $path_header;
    }
    else{
        echo "trang này không tồn tại";
    }
}
function get_footer_customer(){
    $path_footer = "inc/footer_order.php";
    if(file_exists($path_footer)){
        require $path_footer;
    }
    else{
        echo "trang này không tồn tại";
    }
}
// header và footer con (quản lí đơn hàng của khách hàng)
function get_header_admin(){
    $path_header = "inc/header_admin.php";
    if(file_exists($path_header)){
        require $path_header;
    }
    else{
        echo "trang này không tồn tại";
    }
}
function get_footer_admin(){
    $path_footer = "inc/footer_admin.php";
    if(file_exists($path_footer)){
        require $path_footer;
    }
    else{
        echo "trang này không tồn tại";
    }
}



?>