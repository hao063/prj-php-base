 <!-- 
- mặc định status bằng null => hàng đang chờ phản hồi
- Nếu status bằng 1 thì hàng đã được chấp nhập => vẫn chuyển hàng
- Nếu status bằng 2 thì hành đã bị từ chối => hàng đã từ chối //(xem lí do)
- Nếu status bằng 3 là khi người dùng ấn vào "hủy đặt hàng"
- nếu status bằng 4 thì hàng đã bị hủy
- nếu status bằng 5 thì hàng đã giao thành công
-->
<?php
// truy vấn những đơn hàng bị hủy và bị từ chối
    $id_user = $_SESSION['customer']['id'];
    $sql = "SELECT * FROM `order` WHERE (status = 2 OR status = 4) AND id_user = '$id_user'";
    $result = db_query($sql);

?>
<!-- view order -->
<div class="container_all_or">
    <?php foreach($result as $value){ ?>
        <?php
        $sql2 = "SELECT * FROM order_details WHERE id_order =  {$value['id']}";
        $result2 = db_query($sql2);
        ?>
    <div class="container_products">
        <div class="contain_all">
            <div class="header_all">
                <div>
                    <h5>Thông tin sản phẩm</h5>
                </div>
            <div>
                <div class="title">
                    <i class="fas fa-truck success"></i>
                    <?php if($value['status'] == 2): ?>
                    <span class="red2">Đơn hàng đã từ chối (<a href="?page=customer_order&page_or=alert_note&note=<?=$value['note_order']?>">Xem lí do</a> )&ensp;</span>|
                    <span class="inf">BỊ HỦY</span>
                    <?php elseif($value['status'] == 4): ?>
                    <span class="red2">Đơn hàng đã hủy thành công <i class="fas fa-check"></i>&ensp;</span>|
                    <span class="inf">ĐÃ HỦY</span>
                    <?php endif; ?>
                    <a href="?page=customer_order&page_or=delete_user_or&action=delete_cancel&id=<?=$value['id']?>"><i class="fas fa-trash-alt delete_order_user"></i></a>
                </div>
            </div>
        </div>

        <?php foreach ($result2 as $value2){?>
        <?php 
            $id_book = $value2['id_bookstore'];
            $sql = "SELECT * FROM bookstore WHERE id = '$id_book'";
            $result3 = db_query($sql);
            $row = mysqli_fetch_array($result3);
        ?>
        <div class="bottom"></div>
        <div class="header_body">
            <div class="contain_image">
                <img src="./sql/data/<?= $row['image']?>" alt="">
            </div>
            <div class="name_book">
                <h4>Tên Sách</h4>
                <p class="describe">mô tả</p>
                <p class="gray">x<?=$value2['quantity']?></p>
            </div>
            <div class="price">
                <del>  <?=number_format($row['price_book'])?></del>&ensp;&ensp;
                <p> <?= number_format($row['price_book']-$row['sale_book']) ?></p>
            </div>
        </div>
            <div class="bottom"></div>
            <?php } ?>
            </div>
        </div>
    <?php } ?>
    </div>
</div>