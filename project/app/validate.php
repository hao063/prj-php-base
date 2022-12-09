<?php 

    function is_username($username) {
        $part_tern = "/^[A-Za-z0-9_\.]{4,32}$/";
        if (preg_match($part_tern, $username))
            return true;
    }

    function is_password($password) {
        // $part_tern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+)$/";
        $part_tern = "/^[A-Za-z0-9_\.]{3,32}$/";
        if (preg_match($part_tern, $password))
            return true;
    }

    function is_email($email) {
        $part_tern = "/^[A-Za-z0-9_.]{3,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
        if (preg_match($part_tern, $email))
            return true;
    }
    
?>