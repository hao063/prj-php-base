
<?php
    $sql = "SELECT * FROM `preventive_order` WHERE `status` = 5";
    $result = db_query($sql);
?>
<!-- view -->
<div class="container_news_order">
<?php if(mysqli_num_rows($result) > 0): ?>
    <?php foreach($result as $row): ?>
            <div class="body_orders">
                <div class="img">
                    <img src="./public/image/book_cart.png" alt="">
                </div>
                <div class="name">
                    <h3><?= $row['name_orderer'] ?></h3>
                    <p>Tống sản phẩm: <?=  $row['total_quantity'] ?> </p>
                </div>
                <div class="many_total">
                    <h4>Tổng tiền: <?= number_format($row['total']) ?> </h4>
                </div>
                <div class="inf">
                    <span><a href="?page=manage_order&page_ad=view_detail_admin&id_order=<?=$row['id']?>">Xem chi tiết</a></span>
                </div>
                <p class="time_bring"> Đã giao thành công 
                    <?=date('d/m/Y',strtotime($row['response_at'])) ?>        
                </p>
                <i class="fas fa-clipboard-check"></i>
                <a href="?page=manage_order&page_ad=core&action=delete&id=<?=$row['id']?>"><i class="fas fa-trash-alt delete_order"></i></a>
            </div>
    <?php endforeach; ?>
<?php else: ?>
        <div class="empty_cart">
            <img src="./public/image/empty_cart.jpg" alt="">
            <h3>Chống! chưa có gì mới</h3>
        </div>
<?php endif; ?>
</div>
