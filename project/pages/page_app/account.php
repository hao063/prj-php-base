<?php
// thay đổi avata avata
$avatar_old = $_SESSION['login']['avatar'];
$id = $_SESSION['login']['id'];
if(isset($_POST['upload_avatar'])){
    $avatar = $_FILES['avatar']['name'];
    if(!empty($_FILES['avatar']['name'])){
        $sql = "UPDATE account SET avatar = '$avatar' WHERE id = '$id'";
        $path = "sql/avatar/";
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $avatar = $_FILES['avatar']['name'];
        move_uploaded_file($tmp_name,$path.$avatar);
        db_query($sql);
        if($avatar_old != 'user.jpg'){
            unlink("./sql/avatar/{$avatar_old}");
        }
        header_js('?page=account');
    }
}

$sql_avatar = "SELECT avatar FROM account WHERE id='$id'";
$result = db_query($sql_avatar);
$nu_avatar = mysqli_fetch_assoc($result);

?>
<form  method="post" enctype="multipart/form-data">
    <div class="container_avatar">
            <img src="./sql/avatar/<?=$nu_avatar['avatar']?>" alt="">
            <input type="file" name="avatar" class="file">
    </div>
    <input type="submit" name="upload_avatar" class="upload_avatar"value="Thay đổi">
</form>
<div class="container_account">
    <table>
        <tr>
            <th>Tên người dùng</th>
            <td><?=$_SESSION['login']['full_name']?></td>
        </tr>
        <tr>
            <th>Tên toài khoản</th>
            <td><?=$_SESSION['login']['username']?></td>
        </tr>
        <tr>
            <th>Địa trỉ</th>
            <td><?=$_SESSION['login']['address']?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?=$_SESSION['login']['email']?></td>
        </tr>
    </table>
</div>
<?php if(isset($_SESSION['customer'])): ?>
<div class="customer_order">
    <a href="?page=customer_order">Thông tin các đơn hàng</a>
</div>
<?php endif; ?>
<div class="change_mk">
    <a href="?page=change_password">Đổi mật khẩu</a>
</div>
<div class="dayy"></div>


