<?php 
    session_start();
    ob_start();
    require "lib/template.php";
    require "./sql/config.php";
    get_header();
?>
<?php 

if(isset($_GET['page'])){
    $page = $_GET["page"];
    $path_pages = "pages/page_app/{$page}.php";
    if(file_exists($path_pages)){
        require $path_pages;
    }
    else{
        echo "trang này không tồn tại";
    }
}
else{
    require "pages/page_app/home.php";
}

?>
<?php 
    get_footer();
?>