<?php
//Lapvedelem
session_start();
if(!isset($_SESSION['belepett'])) {
    header("Location: index.php");
    exit();
}

require("../kapcsolat.php");

$kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "" ;
$sql = "SELECT *
FROM nevjegyek
WHERE nev LIKE '%{$kifejezes}%'
OR cegnev LIKE '%{$kifejezes}%'
OR Mobil LIKE '%{$kifejezes}%'
OR Email LIKE '%{$kifejezes}%'
ORDER by nev ASC";
$eredmeny = mysqli_query($dbconn, $sql);
$kimenet = "<table>
<tr>
<th>Nev</th>
<th>Cegnev</th>
<th>Mobil</th>
<th>Email</th>
<th>Müvelet</th>
</tr>";
while ($sor = mysqli_fetch_assoc($eredmeny)){
    $kimenet.="<tr>
    <td>{$sor['nev']}</td>
    <td>{$sor['cegnev']}</td>
    <td>{$sor['Mobil']}</td>
    <td>{$sor['Email']}</td>
    <td><a href=\"torles.php?id={$sor['id']}\">Törles</a> | <a href=\"modositas.php?id={$sor['id']}\">Modositas</a></td>
    </tr>";
};
$kimenet.= "</table>\n";
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nevjegykartyak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../stilus.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Nevjegykartyak</h1>
    <form method="post" action="">
        <input type="search" id="kifejezes" name="kifejezes">
    </form>

   
    <p><a href="felvitel.php">Uj nevjegy </a> | <a href="kilepes.php">Kilepes </a></p>
    <?php 
    print $kimenet 
    ?>
     <p><a href="felvitel.php">Uj nevjegy </a> | <a href="kilepes.php">Kilepes </a></p>
</body>
</html>