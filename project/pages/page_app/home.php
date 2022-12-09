<?php 
    // các bộ lọc của menu header được truyên vấn theo các action các action này được gắn với mỗi định danh cho loại sách
    $table = "bookstore";
    $sql = db_select($table);
    $result = db_query($sql);
    if(isset($_GET['action'])){
        switch ($_GET['action']) {
            case 'study':
                $sql = "SELECT * FROM bookstore WHERE kind_of_book LIKE '%Học tập'";
                $result = db_query($sql);
                break;
            case 'business':
                $sql = "SELECT * FROM bookstore WHERE kind_of_book LIKE '%Kinh doanh'";
                $result = db_query($sql);
                break;
            case 'children':
                $sql = "SELECT * FROM bookstore WHERE kind_of_book LIKE '%Thiếu nhi'";
                $result = db_query($sql);
                break;
            case 'manga':
                $sql = "SELECT * FROM bookstore WHERE kind_of_book LIKE '%Manga'";
                $result = db_query($sql);
                break;
            default:
                # code...
                break;
        }
    }
?>

<!-- thanh tìm kiếm sách của phần Home -->
<div class="header_search">
    <form method="post">
        <input type="text" name="search" value="<?= isset($_POST['search']) ? $_POST['search'] : '';?>"placeholder="&ensp; Tìm kiếm ...">
        <input type="submit" name="submit_search" value="Tìm kiếm">
    </form>
</div>
<div class="header_connten">
    <div class="menu_contact">
        <div class="mn_contact_contain_one">
            <img src="./public/image/logo1.png">
            <span>Ship COD Trên Toàn Quốc</span>
        </div>  
        <div class="mn_contact_contain_two">
            <img src="./public/image/logo2.png">
            <span>Free Ship Đơn Hàng Trên 300k</span>
        </div>  
        <div class="mn_contact_contain_three">
            <img src="./public/image/logo3.png">
            <span>Hotline: 0989 849 396</span>
        </div>  
    </div>
    
<!-- Tên sách, học loại sách được nhập từ form tìm kiếm sẽ được sử lí dưới đây -->
    <?php if(isset($_POST['submit_search'])): ?>
        <?php 
            $search = $_POST['search'];
            $sql = "SELECT * FROM bookstore WHERE name_book LIKE '%$search%' or kind_of_book LIKE '%$search%'";            
            $result = db_query($sql);            
        ?>
    <?php else: ?>
<!-- sidle chuyển ảnh -->
    <div class="sidle_img">
        <div class="sidle_img_moved_slide">
            <img src="./public/image/sidle1.jpg" alt="">
            <img src="./public/image/sidle2.jpg" alt="">
            <img src="./public/image/sidle3.jpg" alt="">
            <img src="./public/image/silde4.jpg" alt="">
        </div>
    </div>
    <?php endif; ?>
</div>
<!-- View Sách -->
<h2 id="text_bookstore">Kho Sách Hào Book !</h2>
<?php foreach ($result as $row):?>
<div class="container_product">

    <div class="product">
        <div class="discount_title">
            <?php if($row['sale_book'] != '0'): ?>
            <div class="percent_discount">
                <span>  -<?= ceil(($row['sale_book']/$row['price_book'])*100)?>%</span>
            </div>
            <?php endif; ?>
            <div class="title_status">
                <span>HOT</span>
            </div>
        </div>
        <div>
            <img src="<?= "sql/data/{$row['image']}" ?>" alt="">
        </div>
        <div>
            <h4><?= $row['name_book'] ?></h4>
        </div>
        <div>
            <p><?= $row['describe_book'] ?></p>
        </div>
        <div class="functional_product">
        <?php if(!isset($_SESSION['admin'])): ?>
            <form action="?page=cart_book&action=add" method="post">
                <input type="hidden" name="quantity[<?= $row['id'] ?>]" value="1">
                <input type="submit" value="Thêm vào giỏ hàng">
            </form>
        <?php endif; ?>
            <a class="functional_icon" href="?page=product_details&id_product_detail=<?=$row['id']?>"><i class="far fa-eye"></i></a>
            <a class="functional_icon" href="?page=home"><i class="fas fa-sync-alt"></i></a>
        </div>
        <div class="product_price">
            <h5>Giá: </h5>
            <?php if($row['sale_book'] != '0'): ?>
            <s> <?= number_format($row['price_book']) ?> đ</s>
            <?php endif; ?>
            <span><?= number_format($row['price_book']- $row['sale_book'])  ?> đ</span>
        </div>
    </div>
</div>
<?php endforeach; ?>


<script type="text/javascript" src="./public/js/moved.js"></script>
