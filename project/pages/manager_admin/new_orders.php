<!-- 

        - mặc định status bằng null => hàng đang chờ phản hồi
        - Nếu status bằng 1 thì hàng đã được chấp nhập => vẫn chuyển hàng
        - Nếu status bằng 2 thì hành đã bị từ chối => hàng đã từ chối //(xem lí do)
        - Nếu status bằng 3 là khi người dùng ấn vào "hủy đặt hàng"
        - nếu status bằng 4 thì hàng đã bị hủy
        - nếu status bằng 5 thì giao hàng thành công
     -->
<?php
    $sql = "SELECT * FROM `order` WHERE status is null";
    $result = db_query($sql);
?>
<!-- view -->
<div class="container_news_order">
        <?php  if(mysqli_num_rows($result) > 0):?>
            <?php foreach($result as $row):?>
                <div class="body_orders">
                    <div class="img">
                        <img src="./public/image/book_cart.png" alt="">
                    </div>
                    <div class="name">
                        <h3><?=$row['name_orderer']?></h3>
                        <p>Tống sản phẩm: <?=$row['total_quantity']?></p>
                    </div>
                    <div class="many_total">
                        <h4>Tổng tiền: <?= number_format($row['total'])?></h4>
                    </div>
                    <div class="inf">
                        <span><a href="?page=manage_order&page_ad=view_detail&id_order=<?=$row['id']?>&ac=new">Xem chi tiết</a></span>
                    </div>
                    <p class="time"> <?=$row['create_at']?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
        <div class="empty_cart">
            <img src="./public/image/empty_cart.jpg" alt="">
            <h3>Chống! chưa có gì mới</h3>
        </div>
        <?php endif; ?>
</div>