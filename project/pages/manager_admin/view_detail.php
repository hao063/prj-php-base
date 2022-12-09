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
$sql = "SELECT * FROM `order_details` INNER JOIN `bookstore` ON order_details.id_bookstore = bookstore.id WHERE id_order = '$id_order'";
$result = db_query($sql);
$sql2 = "SELECT * FROM `order` WHERE id = '$id_order'";
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
    <?php if($_GET['ac'] == 'new'): ?>
        <div class="form">
            <input type="button" onclick="myOnclickCancel()"  value="Từ chối">
            <input type="button" onclick="myOnclickAccept()"  value="Chấp nhận">
        </div>
    <?php elseif($_GET['ac'] == 'bring'): ?>
        <form action="?page=manage_order&page_ad=manipulation&action=bring&id=<?=$row['id']?>" method="post">
            <button class='bring_order_bt' type="submit">Giao hàng xong<i class="fas fa-check"></i></button> 
        </form>
    <?php elseif($_GET['ac'] == 'feed'): ?>
        <form action="?page=manage_order&page_ad=manipulation&action=feed&id=<?=$row['id']?>" method="post">
            <button class='feed_order_bt' type="submit">Hủy đơn hàng&ensp;<i class="far fa-times-circle"></i></button> 
        </form>
    <?php endif; ?>
    </div>
</div>
<!-- form thao tác -->
<div class="container_cancel_accept">
    <div id="accept" class="feedback_view_accept">
        <h3>Nhập ghi chú và ngày giao hàng</h3>
        <form action="?page=manage_order&page_ad=manipulation&action=accept&id=<?=$row['id']?>" method="post" autocomplete="off">
            <textarea name="note" id="" cols="30" rows="10"></textarea>
            <input type="text" name="create_feedback" id="datepicker">
            <input type="submit" name="submit" value="gửi">
        </form>
    </div>
    <div id="cancel" class="feedback_view_cancel">
        <h3>Nhập lí do hủy hàng</h3>
        <form action="?page=manage_order&page_ad=manipulation&action=cancel&id=<?=$row['id']?>" method="post">
            <textarea name="note" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="gửi">
        </form>
    </div>

</div>

