<?php 
// truy vấn ra thôi tin chi tiết của một quấn sách bằng id được gửi qua url
$table = "bookstore";
$where = "id=".$_GET["id_product_detail"];
$sql = db_select_where($table, $where);
$result = db_query($sql);
$rows = mysqli_fetch_assoc($result);
?>
<div class="product_details">
    <div class="details_book">
        <div class="oder_and_cart">
            <div class="img_oder_and_cart">
                <img src="./sql/data/<?=$rows['image']?>" alt="">
            </div>
        </div>
        <div class="information_details_book">
            <h1><?=$rows['name_book']?></h1>
            <div class="supplier">
                <div>
                    <div>
                        <p>Nhà cung cấp:&nbsp;&nbsp;</p><span id="kim_dong"> Nhà Xuất Bản Kim Đồng</span>
                    </div>
                    <div>
                        <p>Nhà Xuất Bản:&nbsp;&nbsp;</p><span> NXB Kim Đồng</span>
                    </div>
                </div>
                <div class="author">
                    <div>
                        <p>Tác giả:&nbsp;&nbsp;</p> <span>Đắc Trung</span> 
                    </div>
                    <div>
                        <p>Hình thức bìa:&nbsp;&nbsp;</p> <span>Bìa mềm</span>
                    </div>
                </div>
            </div>
            <div class="price">
                <h2><?=number_format($rows['price_book']-$rows['sale_book'])?> đ</h2> 
                <?php  if($rows['sale_book'] != 0): ?>
                <s><?=number_format($rows['price_book'])?> đ</s> <span>-<?= ceil(($rows['sale_book']/$rows['price_book'])*100)?>đ</span>
                <?php endif; ?>
            </div>
            <p>Chính sách đổi trả&ensp;&ensp; Đổi trả sản phẩm trong 30 ngày</p>
            <!-- gửi thông tin trong form đến giỏ hàng bằng mảng quantity được gán với id của sách và value là số lượng của sách từ người dùng nhập  -->
            <?php if(isset($_SESSION['customer'])): ?>
            <form action="?page=cart_book&action=add" method="post">
                <div class="oder__cart">
                    <button type="submit">
                        <i class="fas fa-shopping-basket"></i> 
                        <p>&nbsp;Thêm vào giỏ hàng</p>
                    </button>
                </div>
                <div class="number">
                    <h3>Số lượng: </h3>
                        <input type="number" name="quantity[<?= $rows['id'] ?>]" min="1"  value="1">
                </div>
            </form>
            <?php endif; ?>
            <div class="endow">
                <h3>Ưu đãi liên quan</h3>
                <div>
                    <span> <i class="fas fa-star"></i> Nhập mã "QRMEGA": Giảm ngay 10%, thanh toán qua VNPAY > </span>
                </div>
                <div>
                    <span> <i class="fas fa-star"></i> Hoàn 30%, đổi đa 100k, thanh toán ví Moca ></span>
                </div>
                <div>
                    <span><i class="fas fa-star"></i> Giảm ngay 20k, đơn hàng từ 50K, thanh toán qua Ví ZaloPay > </span>
                </div>
                <div>
                    <span><i class="fas fa-star"></i> Nhập mã "AIRPAY024", giảm ngay 10%, đơn hàng từ 0đ, thanh toán qua ví AirPay </span>
                </div>
            </div>
            <!-- kiểm tra trạng thái của sách nếu còn hàng thì status bằng 1 hết hàng thì bằng 0 -->
            <div class="status">
                <?php if($rows['status_book']==1): ?>
                <span>Vẫn còn hàng</span>
                <?php else : ?>
                <span>Hết hàng</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php 
// truy vấn ra 5 hàng sách có liên quan thông qua loại sách

$product_related = $rows['kind_of_book'];
$select = "SELECT * FROM bookstore WHERE kind_of_book LIKE '%$product_related' LIMIT 5";
$result_related = db_query($select);

?>
    <div class="related_products">
        <h2>SẢN PHẨM LIÊN QUAN</h2>
        <span>Boy E2KO Giới Thiệu</span>
        <div class="container_related">
            <?php foreach ($result_related as $item):?>
            <div class="related">
                <a href="?page=product_details&id_product_detail=<?= $item['id'] ?>">
                    <div>
                         <?php  if($item['sale_book'] != 0): ?>
                        <span>-<?= ceil(($item['sale_book']/$item['price_book'])*100)?>đ</span>
                        <?php endif; ?>
                        <img src="./sql/data/<?=$item['image']?>" alt="">
                        <p><?=$item['name_book']?></p>
                        <h5><?= number_format($item['price_book']) ?> đ</h5>
                        <?php  if($item['sale_book'] != 0): ?>
                        <s><?= number_format($item['sale_book'])?> đ</s>
                        <?php endif; ?>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach;?>
        </div>
    </div>

    <div class="product_review">
        <h3>Thông tin sản phẩm</h3>
        <div class="v__"></div>
        <p>Mã Hàng &ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; 8935244857191</p>
        <p>Tên nhà cung cấp  &nbsp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; <span>Nhà Xuất Bản Kim Đồng</span></p>
        <p>Tác giả &ensp; &ensp; &ensp;&ensp;&ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; Đắc Trung</p>
        <p>NXB &ensp; &ensp; &ensp; &ensp;&ensp;&ensp;&ensp;&ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; NXB Kim Đồng</p>
        <p>Trọng lượng (gr) &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; 200</p>
        <p>Kích thước bao bì &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; 19 x 13 cm</p>
        <p>Số trang &ensp; &ensp;&ensp;&ensp;&ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; 172</p>
        <p>Hình thức &ensp; &ensp;&ensp;&ensp;  &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; <span>Bìa Mền</span></p>
        <p>Sản phẩm hiển thị trong  &ensp; &ensp; &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; <span>Nhà Xuất Bản Kim Đồng</span></p>
        <p>Sản phẩm bán chạy nhất &ensp;  &ensp; &ensp;&ensp; &ensp; &ensp; &ensp; &ensp; <span>Top 100 sản phẩm Đội - Đoàn - Đảng bán chạy nhất của tháng</span></p>
        <div class="contain_tittle">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus aperiam ad ullam temporibus et nostrum distinctio explicabo suscipit? Nesciunt quidem cum esse hic minus velit! Hic, cum maxime. Facilis, eius?dolor sit amet consectetur adipisicing elit. Delectus aperiam , cum maxime. Facilis, eius?</p> 
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus aperiam ad ullam temporibus et nostrum distinctio explicabo suscipit? Nesciunt quidem cum esse hic minus velit! Hic, cum maxime. Facilis, eius?licabo suscipit? Nesciunt quidem cum esse hic minus velit! Hic, cum maxime. Facilis, eius?dolor sit amet consectetur adipisicing elit. Delectus aperiam , </p> 
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus aperiam ad ullam temporibus et nostrum distinctio explicabo suscipit? Nesciunt quidem cum esse hic minus velit! Hic, cum maxime. Facilis, eius?nt quidem cum esse hic minus velit! Hic, cum maxime. Facilis, eius?licabo suscipit? Nesciunt quidem cum esse hic minus velit! Hic, cum maxime. Facilis, eius?dolor sit amet consectetur adipisicing elit. Delectus aperiam ,</p> 
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus aperiam ad ullam temporibus! Hic, cum maxime. Facilis, eius?</p> 
        </div>

    </div>
    <div class="shipper">
        <div><i class="fas fa-shopping-bag"></i> <span>Chính sách khách sỉ </span></div>
        <div><i class="fas fa-shipping-fast"></i> <span>Thời gian giao hàng </span></div>
        <div><i class="fab fa-hackerrank"></i> <span>Chính sách đổi trả </span> </div>
    </div>
<?php 
    // phần bình luận của khách hàng tương tac với admin
    $id = isset($_SESSION['login'])?$_SESSION['login']['id']:'';
    $id_book = $_GET["id_product_detail"];
    $name = isset($_SESSION['login'])?($_SESSION['login']['full_name']):'';
    if(isset($_POST['submit_comment'])){
        if(!empty($_POST['comment'])){
            $comment = $_POST['comment'];
            $table = "judge";
            $data = array(
                'id_account' => $id,
                'id_book' => $id_book,
                'name' => $name,
                'comment' => $comment
            );
            db_insert($table, $data);
        }
    }
    $table_com = "judge";
    $where = "id_book={$id_book}";
    $sql = db_select_where($table_com,$where);
    $result_com = db_query($sql);

?>

    <div class="comment">
        <h2>Đánh giá sản phẩm</h2>
        <?php if(isset($_SESSION['login'])): ?>
        <form method="post">
            <input type="text" name="comment" placeholder="Comment . . . ">
            <button type="submit" name="submit_comment">Bình luận</button>
        </form>
        <?php else: ?>
        <h3>&ensp;&ensp;&ensp;Bạn phải <a href="">Đăng Nhập</a> tài khoản để có thể bình luận</h3>
        <?php endif; ?>
<?php foreach($result_com as $value ):?>
<?php
// truy vấn ra thông tin của tài khoản bình luận lấy thông tin người bình luận
    $id_vl = $value['id_account'];
    $sql_avatar = "SELECT * FROM account WHERE id = '$id_vl'";
    $result_ava = db_fetch_row($sql_avatar);
?>
        <div class="customer_comment">
            <div class="account">
                <img src="./sql/avatar/<?=$result_ava['avatar']?>" alt="">
                <?php if($result_ava['decentralization'] == 'admin'): ?>
                    <p class="red"><?=$value['name']?>&ensp; <i class="fas fa-check-circle"></i></p>
                <?php else : ?>
                    <p class="gray"><?=$value['name']?></p>
                <?php endif; ?>
            </div>
            <p><?=$value['comment']?></p>
            <span><?=$value['time']?></span>
            <div class="icon_com">
                <a> <i class="fas fa-thumbs-up"></i></a>
                <a><i class="far fa-comments"></i></a>
                <!-- chỉ có admin mới có chức năng xóa comment -->
                <?php if(isset($_SESSION['admin'])): ?>
                <a href="?page=delete_comment&id=<?=$value['id']?>&id_product_detail=<?=$_GET['id_product_detail']?>">
                    <i class="far fa-trash-alt"></i>
                </a>
                <?php endif ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- JS sử lí nút number chọn số lượng của sản phẩm -->
<script type="text/javascript">
        $(function(){
            $('input[type="number"]').niceNumber();
        });
</script>

