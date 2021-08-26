<?php

    define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
    include(ABS_PATH . '/wiki/database/database.php');

    if(isset($_GET["edited-text"])) {
        $editedText = $_GET["edited-text"];
    }

    $sql_request = "update miasto set description=$editedText where name='Opole'";
    $sql_result = mysqli_query($connection, $sql_request);
?>

<script>
    alert('it happens');
</script>