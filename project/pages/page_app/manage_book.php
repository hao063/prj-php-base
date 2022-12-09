<?php 
    // quản lí sách
    // truy vấn ra tất cả sách
     $table = "bookstore";
     $sql = db_select($table);
     if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql = "SELECT * FROM bookstore WHERE name_book LIKE '%$search%' or kind_of_book LIKE '%$search%'";            
        db_query($sql);            
     }
     if(isset($_GET['id_book'])){
        $where = "id = ".$_GET['id_book'];
        $sql = db_select_where($table,$where);
     }
     $result = db_query($sql);
?>
<!-- tìm kiếm sách -->
<div class="manage_book_search">
    <form method="post">
        <input autocomplete="off" class="book_search" type="text" name="search" value="<?= isset($_POST['search']) ? $_POST['search'] : '';?>"placeholder="&ensp; Tìm kiếm ...">
        <input type="submit" name="manage_book_search" value="Tìm kiếm">
    </form>
</div>
<!-- Bảng view sách -->
<div class="manage_book">
    <table class="manage_book_table">
        <tr class="first_table">
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Date</th>
            <th>Price</th>
            <th>Sale</th>
            <th>Image</th>
            <th>Status</th>
            <th>Function</th>
        </tr>
        <?php foreach($result as $row): ?>
        <tr class="manage_book_show">
            <td><?= $row['id'] ?></td>
            <td><?= $row['name_book'] ?></td>
            <td><?= $row['kind_of_book'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['price_book'] ?></td>
            <td><?= $row['sale_book'] ?></td>
            <td><img class="manage_book_img" src="./sql/data/<?= $row['image'] ?>"></td>
            <td><?= $row['status_book'] ?></td>
            <td class="function">
                <a href="?page=edit_book&id=<?= $row['id'] ?>">Edit</a>
                <a href="?page=delete_book&id=<?=$row['id']?>&image=<?= $row['image'] ?>">Delete</a>
                <a href="?page=manage_book">Reset</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>