<?php
require("kapcsolat.php");

//lapozo beallitasok
$sql = "SELECT *
FROM nevjegyek";
$eredmeny = mysqli_query($dbconn, $sql);
$osszes = mysqli_num_rows($eredmeny);
$mennyit = 6;
// -->ceil felfele kerekit
$lapok = ceil($osszes/$mennyit);
$aktualis = (isset($_GET['oldal'])) ? (int)$_GET['oldal'] : 1;
$honnan = ($aktualis-1)*$mennyit;

//Lapozo
$lapozo = "<p>";
$lapozo.= ($aktualis != 1) ? "<a href=\"?oldal=1\">Elso </a>| " : "Elso | ";
$lapozo.= ($aktualis > 1 && $aktualis <=$lapok)  ? "<a href=\"?oldal=".($aktualis-1)."\">Elozo </a>| " : "Elözö | ";
for ($oldal=1; $oldal<=$lapok; $oldal++){
    $lapozo.= ($aktualis!=$oldal) ? "<a href=\"?oldal={$oldal}\">{$oldal} </a>| " : $oldal." | ";
}

$lapozo.= ($aktualis > 0 && $aktualis <$lapok) ? "<a href=\"?oldal=".($aktualis+1)."\">Kovetkezo </a>| " : "Következö | ";
$lapozo.= ($aktualis !=$lapok) ? "<a href=\"?oldal=3\">Utolso </a>" : "Utolso";
$lapozo.="</p>";


$kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "" ;
$sql = "SELECT *
FROM nevjegyek
WHERE nev LIKE '%{$kifejezes}%'
OR cegnev LIKE '%{$kifejezes}%'
OR Mobil LIKE '%{$kifejezes}%'
OR Email LIKE '%{$kifejezes}%'
ORDER by nev ASC
LIMIT {$honnan}, {$mennyit}";
$eredmeny = mysqli_query($dbconn, $sql);

if(@mysqli_num_rows($eredmeny) <1){
    $kimenet = "<article>
    <h2>Nincs talalat a rendszerben!</h2>
    </article>\n";
}else{

$kimenet = "";
while ($sor = mysqli_fetch_assoc($eredmeny)){
$kimenet.= "<article>
<img src=\"kepek/{$sor['foto']}\" alt=\"{$sor['nev']}\">
<h2>{$sor['nev']}</h2>
<h3>{$sor['cegnev']}</h3>
<p>Mobil: <a href=\"tel:{$sor['Mobil']}\">{$sor['Mobil']}</a></p>
<p>E-mail: <a href=\"mailto:{$sor['Email']}\">{$sor['Email']}</a></p>
</article>\n";
    }
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nevjegykartyak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="stilus1.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Nevjegykartyak</h1>
    <form method="post" action="">
        <input type="search" id="kifejezes" name="kifejezes">
    </form>
    <?php print $lapozo; ?>
    <?php print $kimenet ?>
    
    
</body>
</html>