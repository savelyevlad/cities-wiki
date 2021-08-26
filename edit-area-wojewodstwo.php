<?php 

    include 'database/database.php';

    $wojewodstwo_name = $_GET["id"];
    $sql_request = "select * from wojewodstwo where name='$wojewodstwo_name'";
    $sql_result = mysqli_query($connection, $sql_request);
    $row = mysqli_fetch_array($sql_result);

    echo '<div style="width=100%;">';

    echo '<textarea rows="8" style="width: 95%;" id="edited-text">';
    echo $row["description"];
    echo '</textarea>';

    echo '</div>';

    echo '<button type="button" class="btn btn-primary btn-sm" style="margin-top: 10px;" onclick="saveDescription()">Zapisz</button>';
    echo '<button type="button" class="btn btn-primary btn-sm" style="margin-top: 10px; margin-left: 10px;" onclick="reloadPage()">Anulować</button>';
?>