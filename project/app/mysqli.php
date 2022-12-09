<?php

function db_connect(){
    global $conn;
    $db = func_get_arg(0);
    $conn = mysqli_connect($db[0],$db[1],$db[2],$db[3]);
    if (!$conn){
        die("Sịt");
    }
}

function db_query($query_string){
    global $conn;
    $result = mysqli_query($conn, $query_string);
    if (!$result){
        die("Sịt 2");
    }
    return $result;
}

function db_fetch_row($query_string){
    global $conn;
    $result = array();
    $mysqli_result = db_query($query_string);
    $result = mysqli_fetch_assoc($mysqli_result);
    mysqli_free_result($mysqli_result);
    return $result;
}

function db_fetch_array($query_string){
    global $conn;
    $result = array();
    $mysqli_result = db_query($query_string);
    while($row = mysqli_fetch_assoc($mysqli_result)){
        $result[] = $row;
    }
    mysqli_free_result($mysqli_result);
    return $result;
}

function db_select($table){
    global $conn;
    return "SELECT * FROM `{$table}`";
}

function db_select_where($table, $where){
    global $conn;
    return "SELECT * FROM `{$table}` WHERE {$where}";
}

function db_delete($table, $where){
    global $conn;
    $query_string = "DELETE FROM `{$table}` WHERE $where";
    db_query($query_string);
    return mysqli_affected_rows($conn);
}

function db_insert($table, $data){
    global $conn;
    $field = "(".implode(", ",array_keys($data)).")";
    $values = "";
    foreach ($data as $key => $value) {
        if($value === NULL){
            $values .= "NULL, ";
        }
        else{
            $values .= "'".escape_string($value)."', ";
        }
    }
    $values = substr($values, 0, -2);
    db_query("
        INSERT INTO `{$table}` {$field} VALUES ({$values})
    ");
    return mysqli_insert_id($conn);
}

function db_update($table, $data, $where){
    global $conn;
    $values = "";
    foreach ($data as $field => $value) {
        if($value === NULL){
            $values .= "$field = NULL,";
        }
        else{
            $values .= "$field = '".escape_string($value)."', ";
        }
    }
    $values = substr($values, 0, -2);
    db_query("
        UPDATE `{$table}` SET {$values} WHERE {$where}
    ");
    return mysqli_affected_rows($conn);
}

function db_search($table,$column,$search){
    global $conn;
    return "SELECT * FROM `{$table}` where $column LIKE '%{$search}%'";
}

function escape_string($str){
    global $conn;
    return mysqli_real_escape_string($conn, $str);
}

?>