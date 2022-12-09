<?php
    // Sửa sách
    $error = array();
    $time = date('Y-m-d h:i:s');
    $table = "bookstore";
    $where = "id = {$_GET['id']}";
    $sql = db_select_where($table,$where);
    $row = db_fetch_row($sql);
    if(isset($_POST['submit_add_book'])){
        $name_book = $_POST['name_book'];
        $kind_of_book = $_POST['kind_of_book'];
        $price_book = $_POST['price_book'];
        $sale_book = $_POST['sale_book'];
        $describe_book = $_POST['describe_book'];
        if(empty($name_book)){
            $error['name_book'] = "Tên sách không được để chống";
        }
        if(empty($kind_of_book)){
            $error['kind_of_book'] = "Tên loại sách không được để chống";
        }
        if(empty($price_book)){
            $error['price_book'] = "Giá sách không được để chống";
        }
        else{
            if(!is_numeric($price_book)){
                $error['price_book'] = "Giá sách không hợp lệ";
            }
        }
        if(!is_numeric($sale_book)){
            $error['sale_book'] = "Giá sách sale không hợp lệ";
        }
        else{
            if ($sale_book > $price_book) {
                $error['sale_book'] = "Giá sách sale chênh lệch giá gốc";
            }
        }
        if(empty($describe_book)){
            $error['describe_book'] = "Chưa nhập mô tả của sách";
        }

        if(!$error){
            $table = "bookstore";
            $data = array(
                'name_book' => $name_book,
                'kind_of_book' => $kind_of_book,
                'describe_book' => $describe_book,
                'price_book' => $price_book,
                'sale_book' => $sale_book,
                'update_at' => $time
            );
            $where = "id = {$_GET['id']}";
            db_update($table, $data, $where);
            header_js("?page=manage_book&id_book={$_GET['id']}");
        }

    }
?>
<!-- form sửa thông tin của sách -->
<div class="container_edit_book">
    <h2>Nhập thông tin của sách</h2>
    <form method="post" enctype="multipart/form-data">
        <div>
            <input type="text" name="name_book" placeholder="Nhập tên sách" value="<?= $row['name_book'] ?>"> <br>
            <p><?php form_error('name_book'); ?>&emsp;</p> <br>
            <input type="text" name="kind_of_book" placeholder="Loại sách" value="<?= $row['kind_of_book'] ?>"> <br>
            <p><?php form_error('kind_of_book'); ?>&emsp;</p> <br>
           
        </div>
        <div>
            <input type="text" name="price_book" placeholder="Giá sách" value="<?= $row['price_book'] ?>"> <br>
            <p><?php form_error('price_book'); ?>&emsp;</p> <br>
            <input type="text" name="sale_book" placeholder="Giảm giá" value="<?= $row['sale_book'] ?>"> <br>
            <p><?php form_error('sale_book'); ?>&emsp;</p> <br>
        </div>
        <br>
        <label class="edit_book" for="">Mô tả của sách:</label>
        <div>
            <textarea class="edit_describe_book" name="describe_book"><?= $row['describe_book'] ?></textarea> <br>
            <p ><?php form_error('describe_book'); ?>&emsp;</p> <br>
        </div>
        <a href="?page=manage_book" class="a_edit_book">Quay lại</a>
        <input type="submit" name="submit_add_book" value="Cập nhật sách">
    </form>
</div>