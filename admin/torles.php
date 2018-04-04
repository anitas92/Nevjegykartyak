<?php

if(isset($_GET['id'])) {
    require("../kapcsolat.php");
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM nevjegyek
    WHERE id = {$id}";
    mysqli_query($dbconn, $sql);
}
header("Location: lista.php");
?>