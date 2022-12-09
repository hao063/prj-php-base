<?php 
    // thêm sách vào của hàng
    $msg = false;
    $error = array();
    $time = date('Y-m-d h:i:s');
    if(isset($_POST['submit_add_book'])){
        $name_book = $_POST['name_book'];
        $kind_of_book = $_POST['kind_of_book'];
        $image_book = $_FILES['image_book']['name'];
        $price_book = $_POST['price_book'];
        $sale_book = $_POST['sale_book'];
        $describe_book = $_POST['describe_book'];

        if(empty($name_book)){
            $error['name_book'] = "Chưa nhập tên sách";
        }
        if(empty($kind_of_book)){
            $error['kind_of_book'] = "Chưa nhập loại sách";
        }
        if(empty($image_book)){
            $error['image_book'] = "Chưa nhập ảnh sách";
        }
        if(empty($price_book)){
            $error['price_book'] = "Chưa nhập giá sách";
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
                $error['sale_book'] = "Giá sách sale chênh lệch";
            }
        }
        if(empty($describe_book)){
            $error['describe_book'] = "Chưa nhập mô tả của sách";
        }
        
        if(!$error){
            $table = "bookstore";
            $image_book =strtotime($time).'_'.$_FILES['image_book']['name'];
            $data = array(
                'name_book' => $name_book,
                'kind_of_book' => $kind_of_book,
                'describe_book' => $describe_book,
                'price_book' => $price_book,
                'sale_book' => $sale_book,
                'image' => $image_book,
                'create_at' => $time
            );
            $path = "sql/data/";
            $tmp_name = $_FILES['image_book']['tmp_name'];
            move_uploaded_file($tmp_name,$path.$image_book);
            db_insert($table,$data);
            $msg = true;
        }

    }


?>
<?php if($msg == true): ?>
<script>
    var result = confirm("Thêm sách thành công");
    if (result == true) {
        window.location = "?page=add_book";
    }
    window.location = "?page=add_book";
</script>
<?php endif;?>
<div class="container_add_book">
    <h2>Nhập thông tin của sách</h2>
    <form method="post" enctype="multipart/form-data">
        <div>
            <input type="text" name="name_book" placeholder="Nhập tên sách" value="<?php show_value('name_book') ?>"> <br>
            <p><?php form_error('name_book'); ?>&emsp;</p> <br>
            <input type="text" name="kind_of_book" placeholder="Loại sách" value="<?php  !isset($error['kind_of_book'])?show_value('kind_of_book'):''?>"> <br>
            <p><?php form_error('kind_of_book'); ?>&emsp;</p> <br>
            <input type="file" name="image_book"> <br>
            <p><?php form_error('image_book'); ?>&emsp;</p> <br>
        </div>
        <div>
            <input type="text" name="price_book" placeholder="Giá sách" value="<?php !isset($error['price_book'])?show_value('price_book'):'' ?>"> <br>
            <p><?php form_error('price_book'); ?>&emsp;</p> <br>
            <input type="text" name="sale_book"  placeholder="Giảm giá" value="<?php !isset($error['sale_book'])?show_value('sale_book'):'' ?>"> <br>
            <p><?php form_error('sale_book'); ?>&emsp;</p> <br>
        </div>
        <br>
        <label for="">Mô tả của sách:</label>
        <div>
            <textarea name="describe_book" ><?=show_value('describe_book')?></textarea> <br>
            <p ><?php form_error('describe_book'); ?>&emsp;</p> <br>
        </div>
        <a class="add_book_out" href="?page=home">Quay lại trang chủ</a>
        <input type="submit" name="submit_add_book" value="Nhập sách">
    </form>
</div>