
<?php

$time = date('Y-m-d h:i:s');
$error = array();
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
if(isset($_GET['action'])){
    // Tạo func thêm vào giỏ hàng
    function up_cart($add = false) {     
        foreach($_POST['quantity'] as $id => $quantity){
            if($quantity == 0){
                unset($_SESSION['cart'][$id]);
            }
            else{
                $_SESSION['cart'][$id] = !empty($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id]: 0;
                if($add){
                    $_SESSION['cart'][$id]+= $quantity;
                }
                else{
                    $_SESSION['cart'][$id] = $quantity;
                }
                header_js('?page=cart_book');
            }
        }
    }
    switch($_GET['action']){
        case "add";
            up_cart(true);
            break;
        case "delete";
            if($_GET["id"]){
                unset($_SESSION['cart'][$_GET["id"]]);
            }
            break;
        case "submit";
            if(isset($_POST["up_click"])){
                up_cart();
            }
            elseif(isset($_POST["oder_click"])){
                $username_order = $_POST['username_order'];
                $address_order = $_POST['address_order'];
                $email_order = $_POST['email_order'];
                $number_phone = $_POST['number_phone'];
                $note = $_POST['note'];
                if(empty($username_order)){
                    $error['username_order'] = "Bạn chưa nhập tên";
                }
                if(empty($address_order)){
                    $error['address_order'] = "Bạn chưa nhập đia trỉ";
                }
                if(empty($email_order)){
                    $error['email_order'] = "Bạn chưa nhập email";
                }
                else{
                    if(!is_email($email_order)){
                        $error['email_order'] = "Email của bạn chưa đúng";
                    }
                }
                if(empty($number_phone)){
                    $error['number_phone'] = "Bạn chưa nhập số điện thoại";
                }
                else{
                    if(!is_numeric($number_phone)){
                        $error['number_phone'] = "Số điện thoại chưa đúng";
                    }
                    else{
                        if(strlen($number_phone) != 10){
                            $error['number_phone'] = "Số điện thoại chưa đúng";
                        }
                    }
                }
                if(!$error && !empty($_POST['quantity'])){
                    $id_user = $_SESSION['customer']['id'];
                    // truy vấn sách thông tin của các loại sách bằng các id
                    $sql = "SELECT * FROM bookstore where id in (".implode(',',array_keys($_SESSION['cart'])).")";
                    $result = db_query($sql);
                    $total = 0;
                    $oder_product = array();
                    while($row = mysqli_fetch_array($result)){
                        $oder_product[] = $row;
                        $total += (($row['price_book']- $row['sale_book']) *  $_POST['quantity'][$row['id']]);
                    }
                    $total_quantity = 0;
                    foreach($_POST['quantity'] as $value){
                        $total_quantity += $value;
                    }
                    // thêm thông tin của khách hàng order vào bảng order
                    $sql_order = "INSERT INTO `order` (`id_user`, `name_orderer`, `address_orderer`, `email_orderer`, `number_orderer`, `note_orderer`, `total_quantity`, `total`,  `create_at`) VALUES ( '$id_user', '$username_order', '$address_order', '$email_order', '$number_phone', '$note', '$total_quantity', '$total', '$time')";
                    $insertOder = db_query($sql_order);     
                    // lấy id vừa thực thi query               
                    $orderID = $conn->insert_id;
                    $stringOderDetail = "";
                    // lấy mảng vừa lưu các thông tin của từng quyển sách, duyệt và gán vào 1 chuỗi 
                    foreach($oder_product as $key => $product){
                        $price_new = $product['price_book']-$product['sale_book'];
                        $stringOderDetail .= "('{$orderID}','{$product['id']}','{$product['name_book']}','{$price_new}','{$_POST['quantity'][$product['id']]}','$time')";
                        if($key != count($oder_product)-1){
                            $stringOderDetail .= ",";
                        }
                    }
                    //  Insert dữ liệu vào bảng Đơn hàng chi tiết
                    $insertOderDetail = "INSERT INTO `order_details` (`id_order`, `id_bookstore`, `name_book`, `price`, `quantity`, `create_at`) VALUES {$stringOderDetail}";
                    $result = db_query($insertOderDetail);
                    unset($_SESSION['cart']);
                    header_js('?page=order_book&action=order');
                }
            }
            else if(isset($_POST['delete_all'])){
                unset($_SESSION['cart']);
            }
            break;
    }
}
if(!empty($_SESSION['cart'])){
    $sql = "SELECT * FROM bookstore where id in (".implode(',',array_keys($_SESSION['cart'])).")";
    $product = db_query($sql);
}

?>

<!-- view giỏ hàng -->
<div class="cart_book">
    <?php if(empty($_SESSION['cart'])):?>

    <div class="no_products">
        <h2>GIỎ HÀNG TRỐNG</h2>
        <div class="img_no_book">
            <img src="./public/image/pay_book.png" alt="">
        </div>
        <P>Chưa có sản phẩm trong giỏ hàng của bạn !</P>
        <a href="?page=home">
            <div class="continue_pay_book">
                <span>TIẾP TỤC MUA SẮM</span>
            </div>
        </a>
    </div>
    <?php endif; ?>
    <?php if(!empty($_SESSION['cart'])):?>
    <div class="goods_available">
        <h1>GIỎ HÀNG</h1>
        <form action="?page=cart_book&action=submit" method="post">
            <table>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Xóa</th>
                </tr>
                <?php 
                if(!empty($product)):
                    $num = 1;
                    $total = 0;
                    foreach($product as $row): ?>
                    <tr>
                        <td><?= $num++; ?></td>
                        <td>
                            <img src="./sql/data/<?=$row['image']?>" alt="">
                            <p><?=$row['name_book']?></p>
                        </td>
                        <td><?=number_format($row['price_book']-$row['sale_book'])?> đ</td>
                        <td>
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" name="up_click" class="minus">-</button>
                            <input class="number-input" min="0" name="quantity[<?=$row['id']?>]" value="<?= $_SESSION['cart'][$row['id']] ?>" type="number">
                            <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" name="up_click" class="plus">+</button>
                        </td>
                        <td><?= number_format(($row['price_book']-$row['sale_book']) *  $_SESSION['cart'][$row['id']]) ?> đ</td>
                        <td>
                            <a class="delete_book_row" href="?page=cart_book&action=delete&id=<?=$row['id']?>">xóa</a>
                        </td>
                    </tr>
                <?php
                    $total += ($row['price_book']-$row['sale_book'])*  $_SESSION['cart'][$row['id']];
                    endforeach; 
                endif;
                ?>
                <tr class="total">
                    <th></th>
                    <th></th>
                    <th>Tổng tiền: </th>
                    <th></th>
                    <th><?= number_format($total) ?> đ</th>
                    <th></th>
                </tr>
            </table>
            <input type="submit" class="delete_all" name="delete_all" value="Xóa tất cả"> 
            <input type="submit" class="up_click" name="up_click" value="cập nhật">
            <?php if(isset($_SESSION['customer'])): ?>

                <?php 
                // Show value thông tin người dùng order từ tài khoản
                $id_user = $_SESSION['customer']['id'];
                $sql_user = "SELECT * FROM account where id  = '$id_user'";
                $result_user = db_query($sql_user);
                $row_user =  mysqli_fetch_array($result_user);
                ?>
                
            <div class="pay_book">
                <h2>Nhập đầy đủ thông tin để đặt hàng</h2>
                <label for="">Nhập đầy đủ họ tên:</label> <br>
                <input type="text" name="username_order" value="<?= $row_user['full_name'] ?>" placeholder=". . . ">
                <p><?= form_error('username_order') ?>&ensp;</p>

                <label for="">Địa trỉ:</label> <br>
                <input type="text" name="address_order" value="<?= $row_user['address'] ?>" placeholder=". . . ">
                <p><?= form_error('address_order') ?>&ensp;</p>

                <label for="" >Email:</label> <br>
                <input type="text" name="email_order" value="<?= $row_user['email']?>" placeholder=". . .">
                <p><?= form_error('email_order') ?>&ensp;</p>

                <label for="">Số điện thoại:</label> <br>
                <input type="text" name="number_phone" value="<?= show_value('number_phone') ?>" placeholder=". . .">
                <p><?= form_error('number_phone') ?>&ensp;</p>
                
                <label id="text_area_pay" for="">Ghi chú:</label> 
                <textarea name="note" id="" cols="30" rows="10"><?= show_value('note') ?></textarea>
                <input type="submit" name="oder_click" value="Đặt hàng">
            </div>
            <?php else: ?>
            <h2>Bạn cần đăng nhập tài khoản để có thể thực hiện chức năng đặt hàng....( <a href="?page=login">Đăng nhập ngay</a>)</h2>
            <?php endif; ?>
        </form>

    </div>
    <?php endif; ?>              
</div>





