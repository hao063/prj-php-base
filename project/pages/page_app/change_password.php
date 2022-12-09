<?php 
// thay đổi mật khẩu
$error = array();
$time = date('Y-m-d h:i:s');

if(isset($_POST['submit_change'])){ 
    $id = $_SESSION['login']['id'];
    $password = $_POST['password']; 
    $password_new = $_POST['password_new']; 
    $re_password_new = $_POST['re_password_new']; 
    if(empty($password)){
        $error['password'] = "Bạn chưa nhập mật khẩu hiện tại";
    }
    else{
        $table = "account";
        $password_md = md5($password);
        $sql = "SELECT * FROM account WHERE password = '$password_md' AND id = '$id'";
        $result = db_query($sql);
        if(mysqli_num_rows($result)==0){
            $error['password'] = "Mật khẩu hiện tại chưa đúng";
        }
        else{
            if(empty($password_new)){
                $error['password_new'] = "Bạn chưa nhập mật khẩu mới";
            }
            else{
                if(!is_password($password_new)){
                    $error['password_new'] = "Mật khẩu không đúng định dạng";
                }
                else{
                    if(empty($re_password_new)){
                        $error['re_password_new'] = "Bạn chưa nhập lại mật khẩu mới";
                    }
                    else{
                        if($re_password_new != $password_new){
                            $error['re_password_new'] = "Mật khẩu không khớp";
                        }
                    }
                }
            }
        }
    }
    if(!$error){
        $password_new = md5($password_new);
        $sql = "UPDATE account SET password = '$password_new', update_at = '$time' WHERE id = '$id'";
        $result = db_query($sql);
        header_js('?page=change');
    }
}


?>
<!-- Thay đổi mk -->
<div class="container_change">
    <h2>Đổi mật khẩu</h2>
    <form method="post">
        <div>
            <label for="">Nhập mật khẩu hiện tại:</label> <br>
            <input type="password" name="password" value="<?php !isset($error['password'])?show_value('password'):'' ?>"> <br>
            <p><?php form_error('password'); ?>&emsp;</p> <br>
            <label for="">Nhập mật khẩu mới:</label><br>
            <input type="password" name="password_new"  value="<?php !isset($error['password_new'])?show_value('password_new'):'' ?>"> <br>
            <p><?php form_error('password_new'); ?>&emsp;</p> <br>
            <label for="">Nhập lại mật khẩu mới:</label><br>
            <input type="password" name="re_password_new" > <br>
            <p><?php form_error('re_password_new'); ?>&emsp;</p> <br>
        </div>
        <a href="?page=account">Quay lại</a>
        <input type="submit" name="submit_change" value="Thay đổi">
    </form>
</div>