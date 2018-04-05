<?php
if (isset($_POST['rendben'])){
   $kimenet = "<h3>Feltoltott fajl adatai</h3>
   <ul>
   <li>Fajlnev: {$_FILES['fajl'] ['name']}</li>
   <li>Ideiglenes nev: {$_FILES['fajl'] ['tmp_name']}</li>
   <li>Hibakod: {$_FILES['fajl'] ['error']}</li>
   <li>Fajlmeret: {$_FILES['fajl'] ['size']} bytes</li>
   <li>Fajltipus: {$_FILES['fajl'] ['type']} </li>
   </ul>";
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