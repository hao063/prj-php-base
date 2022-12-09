<?php 
// thêm dữ liệu order của các vào bảng phụ dành riêng cho admin (Lưu chữ thông tin)
$id = $_GET['id'];
$action = $_GET['action'];
$time = date('Y-m-d H:i:s');
switch($action) {
    case 'accept':
        $note = $_POST['note'];
        $create_feedback = $_POST['create_feedback'];
        $sql = "UPDATE `order` SET `status` = 1, `response_at` = '$time', `feedback_at` = '$create_feedback', `note_order` = '$note' WHERE id = $id";
        db_query($sql);
        header_js('?page=manage_order');
        break;
    case 'cancel':
        $note = $_POST['note'];
        $sql = "UPDATE `order` SET `status` = 2, `response_at` = '$time',  `note_order` = '$note' WHERE id = $id";
        if(db_query($sql)){
            $sel = "SELECT * FROM `order` WHERE `status` = 2 AND id = $id";
            $sel2 = "SELECT * FROM `order_details` WHERE id_order = $id";
            $re = db_query($sel);
            $row = mysqli_fetch_array($re);
            $re2 = db_query($sel2);
            $table = 'preventive_order';
            $data = [
                'id_user' => $row['id_user'],
                'name_orderer' => $row['name_orderer'],
                'address_orderer' => $row['address_orderer'],
                'email_orderer' => $row['email_orderer'],
                'number_orderer' => $row['number_orderer'],
                'note_orderer' => $row['note_orderer'],
                'total_quantity' => $row['total_quantity'],
                'total' => $row['total'],
                'status' => $row['status'],
                'note_order' => $row['note_order'],
                'create_at' => $row['create_at'],
                'response_at' => $row['response_at'],
                'feedback_at' => $row['feedback_at']
            ];
            db_insert($table, $data);
            $orderID = $conn->insert_id;
            foreach ($re2 as $row2){
                $table2 = 'preventive_order_details';
                $data2 = [
                    'id_order' => $orderID,
                    'id_bookstore' => $row2['id_bookstore'],
                    'name_book' => $row2['name_book'],
                    'price' => $row2['price'],
                    'quantity' => $row2['quantity'],
                    'create_at' => $row2['create_at']
                ];
                db_insert($table2, $data2);
            }
        }
        header_js('?page=manage_order');
        break;
    case 'bring':
        $sql = "UPDATE `order` SET `status` = 5, `response_at` = '$time' WHERE id = $id";
        if(db_query($sql)){
            $sel = "SELECT * FROM `order` WHERE `status` = 5 AND id = $id";
            $sel2 = "SELECT * FROM `order_details` WHERE id_order = $id";
            $re = db_query($sel);
            $row = mysqli_fetch_array($re);
            $re2 = db_query($sel2);
            $table = 'preventive_order';
            $data = [
                'id_user' => $row['id_user'],
                'name_orderer' => $row['name_orderer'],
                'address_orderer' => $row['address_orderer'],
                'email_orderer' => $row['email_orderer'],
                'number_orderer' => $row['number_orderer'],
                'note_orderer' => $row['note_orderer'],
                'total_quantity' => $row['total_quantity'],
                'total' => $row['total'],
                'status' => $row['status'],
                'note_order' => $row['note_order'],
                'create_at' => $row['create_at'],
                'response_at' => $row['response_at'],
                'feedback_at' => $row['feedback_at']
            ];
            db_insert($table, $data);
            $orderID = $conn->insert_id;
            foreach ($re2 as $row2){
                $table2 = 'preventive_order_details';
                $data2 = [
                    'id_order' => $orderID,
                    'id_bookstore' => $row2['id_bookstore'],
                    'name_book' => $row2['name_book'],
                    'price' => $row2['price'],
                    'quantity' => $row2['quantity'],
                    'create_at' => $row2['create_at']
                ];
                db_insert($table2, $data2);
            }
        }
        header_js('?page=manage_order&page_ad=bring_order');
        break;
    case 'feed':
        $id = $_GET['id'];
        $table = 'order';
        $data = [
            'status' => 4,
            'response_at' => $time
        ];
        $where = "id = $id";
        if(db_update($table, $data, $where)){
            $sel = "SELECT * FROM `order` WHERE `status` = 4 AND id = $id";
            $sel2 = "SELECT * FROM `order_details` WHERE id_order = $id";
            $re = db_query($sel);
            $row = mysqli_fetch_array($re);
            $re2 = db_query($sel2);
            $table = 'preventive_order';
            $data = [
                'id_user' => $row['id_user'],
                'name_orderer' => $row['name_orderer'],
                'address_orderer' => $row['address_orderer'],
                'email_orderer' => $row['email_orderer'],
                'number_orderer' => $row['number_orderer'],
                'note_orderer' => $row['note_orderer'],
                'total_quantity' => $row['total_quantity'],
                'total' => $row['total'],
                'status' => $row['status'],
                'note_order' => $row['note_order'],
                'create_at' => $row['create_at'],
                'response_at' => $row['response_at'],
                'feedback_at' => $row['feedback_at']
            ];
            db_insert($table, $data);
            $orderID = $conn->insert_id;
            foreach ($re2 as $row2){
                $table2 = 'preventive_order_details';
                $data2 = [
                    'id_order' => $orderID,
                    'id_bookstore' => $row2['id_bookstore'],
                    'name_book' => $row2['name_book'],
                    'price' => $row2['price'],
                    'quantity' => $row2['quantity'],
                    'create_at' => $row2['create_at']
                ];
                db_insert($table2, $data2);
            }
        }
        header_js('?page=manage_order&page_ad=feedback_order');
        break;
}





?>