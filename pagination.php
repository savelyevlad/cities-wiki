<?php

    define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
    include(ABS_PATH . '/wiki/database/database.php');

    $limit = 5;
    if(isset($_GET["page"])) {
        $page = $_GET["page"];
    }
    else {
        $page = 1;
    }

    $start_from = ($page - 1)*$limit;
    $sql_request = "select * from miasto order by name asc limit $start_from, $limit";
    $sql_result = mysqli_query($connection, $sql_request);
?>

<table class="table table-bordered table-striped">  
    <thead>
        <tr>  
            <th>Nazwa</th>
        </tr>
    </thead>  
    <tbody>  
        <?php  
            while ($row = mysqli_fetch_array($sql_result)) {  
        ?>  
        <tr>
            <td><a href="citi-information.php"><?php echo $row["name"]; ?></a></td>
        </tr>
        <?php
            };
        ?>
    </tbody>  
</table>