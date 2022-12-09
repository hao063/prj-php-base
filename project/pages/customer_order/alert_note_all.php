<?php 
$note = $_GET['note'];
?>
<script>
    var result = confirm("<?=$note?>");
    if (result == true) {
        window.location = "?page=customer_order";
    }
    window.location = "?page=customer_order";
</script>
