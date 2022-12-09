
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css app -->
    <link rel="icon" href="./public/image/Boy_E2KO.png" type="image/gif" sizes="20x20">
    <link rel="stylesheet" href="./public/css/css_app/home.css">
    <link rel="stylesheet" href="./public/css/css_app/login.css">
    <link rel="stylesheet" href="./public/css/css_app/add_book.css">
    <link rel="stylesheet" href="./public/css/css_app/create_account.css">
    <link rel="stylesheet" href="./public/css/css_app/manage_book.css">
    <link rel="stylesheet" href="./public/css/css_app/product_details.css">
    <link rel="stylesheet" href="./public/css/css_app/cart_book.css">
    <link rel="stylesheet" href="./public/css/css_app/account.css">
    <link rel="stylesheet" href="./public/css/css_app/change_password.css">
    <link rel="stylesheet" href="./public/css/css_app/edit_book.css">

    <!-- link liên kết Jquery và font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="./public/js/jquery.nice-number.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="./public/js/jquery.nice-number.js"></script>

    <link rel="stylesheet" href="./public/css/css_app/style.css">

    <!-- css customer -->
    <link rel="stylesheet" href="./public/css/order_user/style.css">
    <link rel="stylesheet" href="./public/css/order_user/all.css">
    <!-- css admin -->
    <link rel="stylesheet" href="./public/css/css_admin/style.css">
    <link rel="stylesheet" href="./public/css/css_admin/new.css">
    <link rel="stylesheet" href="./public/css/css_admin/view.css">

    <!-- js input:date -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <title>Hào E2KO</title>
</head>
<body>
<div class="container">
        <div class="header">
            <div class="img_header">
                <img src="public/image/header.png" alt="">
            </div>

            <div class="header_logo">
                <a href="?page=home">
                    <img src="public/image/haobook.png" >
                </a>
            </div>
            
        <?php if(!isset($_SESSION['admin'])): ?>
            <div class="header_cart">
                <a href="?page=cart_book">
                    <div class="cart__count"><?php 
                    if(isset($_SESSION['cart'])){
                        echo  count($_SESSION['cart']);
                    }
                    else{
                        echo 0;
                    }
                    ?></div>
                    <i class="fas fa-cart-plus"></i>
                </a>
            </div>
        <?php endif; ?>
    <?php 
    if(isset($_SESSION['customer']) || isset($_SESSION['admin'])): ?>
        <?php 
            $id = $_SESSION['login']['id'];
            $sql_avatar = "SELECT avatar FROM account WHERE id='$id'";
            $result = db_query($sql_avatar);
            $nu_avatar = mysqli_fetch_assoc($result); 
        ?>
            <div class="header_account">
                <a href="?page=account">
                    <img src="./sql/avatar/<?=$nu_avatar['avatar']?>" alt="">
                </a>
            </div>
            <div class="header_logout">
                <a href="?page=logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
    <?php else: ?>
            <div class="header_account">
                <a href="?page=login">
                    <i class="far fa-user-circle"></i>
                </a>
            </div>
    <?php endif; ?>
        </div>
        <div class="menu">
            <div class="menu_sidle">
                <div id="sidle">
                    <i class="fas fa-bars"></i>
                    <?php if(isset($_SESSION['admin'])): ?>
                    <span>&ensp; </span>
                    <?php else: ?>
                    <span>&ensp; </span>
                    <?php endif; ?>
                </div>
                <div class="menu_title">
                    <?php if(isset($_SESSION['admin'])): ?>
                        <h2>Chào ông chủ <?= $_SESSION['admin']['full_name'] ?>, chúc ông chủ có một ngày vui vẻ !</h2>
                    <?php elseif(isset($_SESSION['customer'])): ?>
                        <h2>Chào <?= $_SESSION['customer']['full_name'] ?>, chúc bạn có một ngày vui vẻ !</h2>
                    <?php else: ?>
                        <h2>Chào bạn, chúc bạn có một ngày vui vẻ !</h2>
                    <?php endif; ?>
                </div>
                <nav>
                    <ul id="main_menu">
                        <?php if(isset($_SESSION['admin'])): ?>
                            <div id="khoangcach_"></div>
                            <a href="?page=home"><li>Trang chủ</li></a>
                            <a href="?page=add_book"><li>Thêm sách</li></a>
                            <a href="?page=manage_book"><li>Quản lí sách</li></a>
                            <a href="?page=manage_order"><li>Đơn đặt hàng</li></a>
                        <?php elseif(isset($_SESSION['customer'])): ?>
                            <a href="?page=home"><li>Tranng chủ</li></a>
                            <a href="?page=home&action=study"><li>Sách học tập</li></a>
                            <a href="?page=home&action=business"><li>Sách kinh doanh</li></a>
                            <a href="?page=home&action=children"><li>Truyện thiếu nhi</li></a>
                            <a href="?page=home&action=manga"><li>Truyện manga</li></a>
                        <?php else: ?>
                            <a href="?page=home"><li>Tranng chủ</li></a>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            
        </div>
    </div>
    <div class="distance">

    </div>