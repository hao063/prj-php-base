<?php 
function show_value($label_field){
    global $$label_field;
    if(isset($$label_field)){
        echo $$label_field;
    }
}

function form_error($message){
    global $error;
    if(isset($error[$message])){
        echo $error[$message];
    }
}

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}


function header_js($url){
    echo "<script>";
        echo "window.location = '$url'";
    echo "</script>";
}


?>