<?php
//Lapvedelem
session_start();
if(!isset($_SESSION['belepett'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_REQUEST['id'])) header("Location: lista.php");


require("../kapcsolat.php");
//urlap feldolgozasa
if(isset($_POST['rendben'])){
    //print_r($_POST);
    //valtozok tisztitasa
    $mime = ["image/jpeg", "image/pjpeg", "image/gif", "image/png"];
    $nev = strip_tags(ucwords(strtolower(trim($_POST['nev']))));
    $cegnev = strip_tags(trim($_POST['cegnev']));
    $Mobil = strip_tags(trim($_POST['Mobil']));
    $Email = strip_tags(strtolower(trim($_POST['Email'])));

    //valtozok vizsgalata
    if(empty($nev)) $hibak[] = "Nem adtal meg nevet!";
    elseif(strlen($nev) < 5) $hibak[] = "Rossz nevet adtal meg!";

    if(!empty($Mobil) && strlen($Mobil)< 9) $hibak[] = "Rossz mobil szamot adtal meg!";

    if(!empty($Email) && !filter_var($Email,FILTER_VALIDATE_EMAIL)) $hibak[]= "Rossz e-mail cimet adtal meg!";

    if($_FILES['foto']['error'] == 0 && $_FILES['foto']['size'] > 2000000) 
    $hibak[] = "Tul nagy kepet toltottel fel!";
    if($_FILES['foto']['error'] == 0 && !in_array($_FILES['foto']['type'],$mime)) 
    $hibak[] = "NEm megfelelo kepformatum!";

    //Filenev elkeszitese
    switch($_FILES['foto']['type']) {
        case "image/png": $kit=".png"; break;
        case "image/gif": $kit=".gif"; break;
        default: $kit = ".jpg";
    }
    $foto = date("U").$kit;

    //hibauzenet osszeallitasa
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
    SET foto = '{$foto}', nev = '{$nev}' , cegnev = '{$cegnev}', Mobil = '{$Mobil}', Email = '{$Email}'
    WHERE id = {$id}";
    mysqli_query($dbconn,$sql);

    //kep mozgatasa a vegleges helyere
    move_uploaded_file($_FILES['foto']['tmp_name'], "../kepek/{$foto}");
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
$foto = ($sor['foto'] != "nincskep.png") ? $sor['foto'] : "nincskep.png";
}
//urlap megjelenitese
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nevjegykartyak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../stilus1.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Nevjegykartyak</h1>
    <form method="post" action="" enctype="multipart/form-data">
    <?php
        if(isset($kimenet)) print $kimenet;
    ?>
    <input type="hidden" id="id" name="id" value="<?php print $id; ?>">
    <input type="hidden" name="MAX_FILES_SIZE" value="2000000"/>
    <img src="../kepek/<?php print $foto; ?>" alt="<?php print $nev; ?>">
    <p><label for="foto">Foto:</label></br>
       <input type="file" id="foto" name="foto">
    </p>
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