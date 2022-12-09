<?php 
$note = $_GET['note'];
?>
<script>
    var result = confirm("<?=$note?>");
    if (result == true) {
        window.location = "?page=customer_order&page_or=cancelled";
    }
    window.location = "?page=customer_order&page_or=cancelled";
</script>
