<?php
//Lapvedelem
session_start();
if(!isset($_SESSION['belepett'])) {
    header("Location: index.php");
    exit();
}

if(isset($_GET['id'])) {
    require("../kapcsolat.php");
    $id = (int)$_GET['id'];
    //foto torlese
    $sql= "SELECT foto
            FROM nevjegyek
            WHERE id = {$id}";
    $eredmeny = mysqli_query($dbconn, $sql);
    $sor = mysqli_fetch_assoc($eredmeny);

    if ($sor['foto'] != "nincskep.png") {
    unlink("../kepek/{$sor['foto']}");
    }
    //rekord torlese
    $sql = "DELETE FROM nevjegyek
    WHERE id = {$id}";
    mysqli_query($dbconn, $sql);

    
}
header("Location: lista.php");
?>