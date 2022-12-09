<?php 
    // LOgout xóa tất cả các session
    unset($_SESSION['login']);
    unset($_SESSION['customer']);
    unset($_SESSION['admin']);
    header_js('?page=home')
?>