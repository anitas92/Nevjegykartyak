<?php
require("kapcsolat.php");
$kifejezes = (isset($_POST['kifejezes'])) ? $_POST['kifejezes'] : "" ;
$sql = "SELECT *
FROM nevjegyek
WHERE nev LIKE '%{$kifejezes}%'
OR cegnev LIKE '%{$kifejezes}%'
OR Mobil LIKE '%{$kifejezes}%'
OR Email LIKE '%{$kifejezes}%'
ORDER by nev ASC";
$eredmeny = mysqli_query($dbconn, $sql);
$kimenet = "";
while ($sor = mysqli_fetch_assoc($eredmeny)){
$kimenet.= "<article>
<h2>{$sor['nev']}</h2>
<h3>{$sor['cegnev']}</h3>
<p>Mobil: <a href=\"tel:{$sor['Mobil']}\">{$sor['Mobil']}</a></p>
<p>E-mail: <a href=\"mailto:{$sor['Email']}\">{$sor['Email']}</a></p>
</article>\n";
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nevjegykartyak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="stilus.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Nevjegykartyak</h1>
    <form method="post" action="">
        <input type="search" id="kifejezes" name="kifejezes">
    </form>

    <?php print $kimenet ?>
    
</body>
</html>