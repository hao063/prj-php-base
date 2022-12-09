<?php 
// tạo tài khoản
$error = array();
$time = date('Y-m-d h:i:s');
if(isset($_POST['submit_registration'])){
    $name_user = $_POST['name_user'];
    $email_user = $_POST['email_user'];
    $address_user = $_POST['address_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    if(empty($name_user)){
        $error['name_user'] = "Bạn chưa nhập họ tên";
    }
    if(empty($email_user)){
        $error['email_user'] = "Bạn chưa nhập email";
    }
    else{
        if (!is_email($email_user)){
            $error['email_user'] = "Email không đúng định dạng";
        }
        else{
            $table = "account";
            $where = "email = '$email_user'";
            $sql = db_select_where($table, $where);
            $result = db_query($sql);
            if (mysqli_num_rows($result) == 1) {
                $error['email_user'] = "Email đã tồn tại";
            }
        }
    }
    if(empty($address_user)){
        $error['address_user'] = "Bạn chưa nhập địa trỉ";
    }
    if(empty($username)){
        $error['username'] = "Hãy nhập tên tài khoản";
    }
    else{
        if (!is_password($username)){
            $error['username'] = "Tài khoản không đúng định dạng";
        }
        else{
            $table = "account";
            $where = "username = '$username'";
            $sql = db_select_where($table, $where);
            $result = db_query($sql);
            if (mysqli_num_rows($result) == 1) {
                $error['username'] = "Tài khoản đã tồn tại";
            }
        }
    }
    if(empty($password)){
        $error['password'] = "Hãy nhập mật khẩu";
    }
    else{
        if (!is_password($password)){
            $error['password'] = "Mật khẩu không đúng định dạng";
        } 
    }
    if(empty($re_password)){
        $error['re_password'] = "Hãy nhập lại mật khẩu";
    }
    else{
        if($re_password != $password){
            $error['re_password'] = "Mật khẩu nhập lại không khớp";
        }
    }
    $password = md5($password);
    if(!$error){
        $table = "account";
        
        $data = array(
            'full_name' =>  $name_user,
            'email' =>  $email_user,
            'address' =>  $address_user,
            'username' =>  $username,
            'password' =>  $password,
            'create_at'=> $time
        );
        $sql = db_insert($table,$data);
        header_js('?page=create');
    }
}

?>
<!-- đăng kí tài khoản -->
<div class="container_registration">
    <h2>Đăng kí tài khoản</h2>
    <form method="post">
        <div>
            <input type="text" name="name_user" placeholder="Họ tên" value="<?php show_value('name_user') ?>"> <br>
            <p><?php form_error('name_user'); ?>&emsp;</p> <br>
            <input type="text" name="email_user" placeholder="Nhập email" value="<?php  !isset($error['email_user'])?show_value('email_user'):''?>"> <br>
            <p><?php form_error('email_user'); ?>&emsp;</p> <br>
            <input type="text" name="address_user" placeholder="Nhập address" value="<?php show_value('address_user') ?>"> <br>
            <p><?php form_error('address_user'); ?>&emsp;</p> <br>
        </div>
        <div>
            <input type="text" name="username" placeholder="Nhập tài khoản" value="<?php !isset($error['username'])?show_value('username'):'' ?>"> <br>
            <p><?php form_error('username'); ?>&emsp;</p> <br>
            <input type="password" name="password" placeholder="Mật khẩu"> <br>
            <p><?php form_error('password'); ?>&emsp;</p> <br>
            <input type="password" name="re_password" placeholder="Nhập lại mật khẩu"> <br>
            <p><?php form_error('re_password'); ?>&emsp;</p> <br>
        </div>
        <a href="?page=login">Quay lại</a>
        <p id="message_login"><?php form_error('create'); ?>&emsp;</p> <br>
        <input type="submit" name="submit_registration" value="Đăng kí">
    </form>
</div>