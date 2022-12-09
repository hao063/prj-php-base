 <!-- 
    - mặc định status bằng null => hàng đang chờ phản hồi
    - Nếu status bằng 1 thì hàng đã được chấp nhập => vẫn chuyển hàng
    - Nếu status bằng 2 thì hành đã bị từ chối => hàng đã từ chối //(xem lí do)
    - Nếu status bằng 3 là khi người dùng ấn vào "hủy đặt hàng"
    - nếu status bằng 4 thì hàng đã bị hủy
    - nếu status bằng 5 thì hàng đã giao thành công
    -->
<?php
$id_order = $_GET['id_order'];
$sql = "SELECT * FROM `preventive_order_details` INNER JOIN `bookstore` ON preventive_order_details.id_bookstore = bookstore.id WHERE id_order = '$id_order'";
$result = db_query($sql);
$sql2 = "SELECT * FROM `preventive_order` WHERE id = '$id_order'";
$result2 = db_query($sql2);
$row =  mysqli_fetch_array($result2);
?>
<!-- view -->
<div class="container_view_user">
    <div>
        <h5><?= $row['name_orderer']?></h5>
        <p>tổng số lượng: <?= $row['total_quantity'] ?></p>
    </div>
    <div class="block2">
        <p>Địa chỉ: <?= $row['address_orderer']?></p>
        <p>Số điện thoại: <?= $row['number_orderer']?></p>
        <p>Email: <?=$row['email_orderer']?></p>
    </div>
</div>
<div class="container_all_or">
    <div class="container_products">
        <div class="contain_all">
            <div class="header_all">
                <div>
                    <h5>Thông tin sản phẩm</h5>
                </div>
            <div>
                <div class="title">
                </div>
            </div>
        </div>
    <?php foreach($result as $value): ?>
        <div class="bottom"></div>
            <div class="header_body">
                <div class="contain_image">
                    <img src="./sql/data/<?=$value['image']?>" alt="">
                </div>
                <div class="name_book">
                    <h4>Tên Sách: <?=$value['name_book']?></h4>
                    <p class="describe">Mô tả: <?=$value['describe_book']?></p>
                    <p class="gray">Số lượng: <?=$value['quantity']?></p>
                </div>
                <div class="price">
                    <del><?= number_format($value['price_book'])  ?>đ</del>&ensp;&ensp;
                    <p> <?= number_format($value['price_book']-$value['sale_book']) ?>đ</p>
                </div>
            </div>
        <div class="bottom"></div>
    <?php endforeach; ?>
    <div class="footer_f">
        <div class="container_for">
            <div class="total">
                <h2>Tổng tiền:</h2>
                <h3>
                <?=number_format($row['total'])?>
                </h3>
            </div>
        </div>
    </div>
</div>


