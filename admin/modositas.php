<?php
require("../kapcsolat.php");
//urlap feldolgozasa
if(isset($_POST['rendben'])){
    //print_r($_POST);
    //valtozok tisztitasa
    $nev = strip_tags(ucwords(strtolower(trim($_POST['nev']))));
    $cegnev = strip_tags(trim($_POST['cegnev']));
    $Mobil = strip_tags(trim($_POST['Mobil']));
    $Email = strip_tags(strtolower(trim($_POST['Email'])));

    //valtozok vizsgalata
    if(empty($nev)) $hibak[] = "Nem adtal meg nevet!";
    elseif(strlen($nev) < 5) $hibak[] = "Rossz nevet adtal meg!";

    if(!empty($Mobil) && strlen($Mobil)< 9) $hibak[] = "Rossz mobil szamot adtal meg!";

    if(!empty($Email) && !filter_var($Email,FILTER_VALIDATE_EMAIL)) $hibak[]= "Rossz e-mail cimet adtal meg!";

    if(isset($hibak)) {
        $kimenet = "<ul>\n";
        foreach($hibak as $hiba){
            $kimenet.= "<li>{$hiba}</li>\n";
        }
        $kimenet.="</ul>";
    }else{
    //Felvitel az adatbazisba
    $id = (int)$_POST['id'];
    $sql="UPDATE nevjegyek
    SET nev = '{$nev}' , cegnev = '{$cegnev}', Mobil = '{$Mobil}', Email = '{$Email}'
    WHERE id = {$id}";
    mysqli_query($dbconn,$sql);
    header("Location:lista.php");
    }
}
//urlap elozetes kitoltese
else{
    $id = (int)$_GET['id'];
    $sql = "SELECT * 
    FROM nevjegyek
WHERE id = {$id}";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);

$nev = $sor['nev'];
$cegnev = $sor['cegnev'];
$Mobil = $sor['Mobil'];
$Email = $sor['Email'];
}
//urlap megjelenitese
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
    <?php
        if(isset($kimenet)) print $kimenet;
    ?>
    <input type="hidden" id="id" name="id" value="<?php print $id; ?>">
    <p><label for="nev">Nev:*</label></br>
       <input type="text" id="nev" name="nev" value="<?php print $nev ?>">
    </p>
    <p><label for="cegnev">Cegnev:</label></br>
       <input type="text" id="cegnev" name="cegnev" value="<?php print $cegnev ?>">
    </p>
    <p><label for="Mobil">Mobil:</label></br>
       <input type="tel" id="Mobil" name="Mobil" value="<?php print $Mobil ?>">
    </p>
    <p><label for="Email">Email:</label></br>
       <input type="mail" id="Email" name="Email" value="<?php print $Email ?>">
    </p>
    <p><em>A *-al jelolt mezok kitoltese kotelezo</em></p>
    <input type="submit" id="rendben" name="rendben" value="Rendben">
    <input type="reset" value="Megsem">
    </form>

    <p><a href="lista.php">Vissza a tablazathoz</a></p>

</body>
</html>