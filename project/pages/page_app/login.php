<?php 

$error = array();
if(isset($_POST['submit_login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_md5 = md5($password);
    if(empty($username)){
        $error['username'] = "Bạn chưa đăng nhập tài khoản";
    }
    if(empty($password)){
        $error['password'] = "Bạn chưa đăng nhập mật khẩu";
    }
    // cài đặt cookie có thời gian sống là một ngày
    if(isset($_POST['remember_password'])){
        setcookie('userName',$username,time()+86400);
        setcookie('passWord',$password,time()+86400);
    }
    else{
        // xóa cookie
        setcookie('userName',$username,time()-1);
        setcookie('passWord',$password,time()-1);
    }

    if(!$error){
        $sql = "SELECT id,full_name,avatar, email, address, username,decentralization FROM account WHERE username = '$username' AND password = '$password_md5'" ;
        $result = db_query($sql);
        if(mysqli_num_rows($result) == 1){
            $rows_login = mysqli_fetch_assoc($result);
            $_SESSION['login'] = $rows_login;
            if($rows_login['decentralization'] == "customer"){
                $_SESSION['customer'] = $rows_login;
                header_js('?page=home');
            }
            else{
                $_SESSION['admin'] = $rows_login;
                header_js('?page=home');
            }
        }
        else{
            $error['login'] = "Tài khoản sai";
        }
    }
}
// lưu dữ liệu cookie biến
if(isset($_COOKIE['userName']) && isset($_COOKIE['passWord'])){
    $username = $_COOKIE['userName'];
    $password_cookie = $_COOKIE['passWord'];
    $check = "checked";
}
?>

<!-- form đăng nhập tài khoản -->
<div class="wapper_login">
    <div class="container_login">
        <h2>Đăng Nhập Tài Khoản</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Tài khoản" value="<?= show_value('username') ?>"> <br>
            <p><?= form_error('username'); ?>&emsp;</p> <br>
            <input type="password" name="password" placeholder="Mật khẩu" value="<?= !empty($password_cookie) ? $password_cookie :''; ?>"> <br>
            <p><?php form_error('password'); ?>&emsp;</p> <br>
            <input <?= isset($check)? $check:"" ;?> type="checkbox" name="remember_password" id="remember_password" ><label for="remember_password">Nhớ mật khẩu</label> <a href="?page=create_account">Tạo tài khoản</a> <br>
            <p id="validate_login"><?php form_error('login'); ?>&emsp;</p> <br>
            <input type="submit" name="submit_login" value="Đăng nhập">
        </form>
    </div>
</div>
