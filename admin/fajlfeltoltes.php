<?php

function ekezettelen($szoveg){
    $mit  = array("é","á","í","ó","ö","ü","ő","ű","ú","É","Á","Ó","Ö","Ü","Ő","Ű","Ú","_"," ");
    $mire = array("e","a","i","o","o","u","o","u","u","E","A","O","O","U","O","U","U","-","-");
    return str_replace($mit, $mire, $szoveg);
}

if (isset($_POST['rendben'])){
   
    //engedelyezett mime tipusok
    $mime = ["image/jpeg", "image/pjpeg", "image/gif", "image/png"];

    //fajltipus es meret korlatozasaink
   if (in_array($_FILES['fajl']['type'],$mime) && $_FILES['fajl']['size'] < 2000000) {
    $kimenet = "<h3>Feltoltott fajl adatai</h3>
    <ul>
        <li>Fajlnev: {$_FILES['fajl'] ['name']}</li>
        <li>Ideiglenes nev: {$_FILES['fajl'] ['tmp_name']}</li>
        <li>Hibakod: {$_FILES['fajl'] ['error']}</li>
        <li>Fajlmeret: {$_FILES['fajl'] ['size']} bytes</li>
        <li>Fajltipus: {$_FILES['fajl'] ['type']} </li>
    </ul>";

    //uj fajlnev 
    $fajl = ekezettelen($_FILES['fajl'] ['name']);
        if(!file_exists("kepek/".$fajl)) {
        move_uploaded_file($_FILES['fajl'] ['tmp_name'], "kepek/".$fajl);
        }
   }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fajlfeltöltes</title>
</head>
<body>
    <h1>Fajlfeltöltes</h1>
   <form method="post" action="" enctype="multipart/form-data">
        <?php if (isset($kimenet)) print $kimenet; ?>
        <input type="file" id="fajl" name="fajl">
        <input type="submit" id="rendben" name="rendben" value="Feltöltes">
   </form>
</body>
</html>