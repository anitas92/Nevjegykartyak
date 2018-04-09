<?php
//Lapvedelem
session_start();
if(!isset($_SESSION['belepett'])) {
    header("Location: index.php");
    exit();
}
//urlap feldolgozasa
if(isset($_POST['rendben'])){
    //print_r($_POST);
    //valtozok tisztitasa
    $nev = strip_tags(mb_convert_case(mb_convert_case(trim($_POST['nev']), MB_CASE_LOWER, "UTF-8"), MB_CASE_TITLE));
    $cegnev = strip_tags(trim($_POST['cegnev']));
    $Mobil = strip_tags(trim($_POST['Mobil']));
    $Email = strip_tags(mb_convert_case(trim($_POST['Email']), MB_CASE_LOWER, "UTF-8"));

    $mime = ["image/jpeg", "image/pjpeg", "image/gif", "image/png"];
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

    if(isset($hibak)) {
        $kimenet = "<ul>\n";
        foreach($hibak as $hiba){
            $kimenet.= "<li>{$hiba}</li>\n";
        }
        $kimenet.="</ul>";
    }else{
    //Felvitel az adatbazisba
    require("../kapcsolat.php");
    $sql="INSERT INTO `nevjegyek` (`foto`,`nev`, `cegnev`, `Mobil`, `Email`) VALUES ('{$foto}','{$nev}', '{$cegnev}', '{$Mobil}', '{$Email}');";
    mysqli_query($dbconn,$sql);

    //kep mozgatasa a vegleges helyere
    move_uploaded_file($_FILES['foto']['tmp_name'], "../kepek/{$foto}");
    header("Location:lista.php");
    }
}
//urlap megjelenitese
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nevjegykartyak</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../stilus1.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Nevjegykartyak</h1>
    <form method="post" action="" enctype="multipart/form-data">
    <?php
        if(isset($kimenet)) print $kimenet;
    ?>

    <input type="hidden" name="MAX_FILES_SIZE" value="2000000"/>
    <p><label for="foto">Foto:</label></br>
       <input type="file" id="foto" name="foto">
    </p>
    <p><label for="nev">Nev:*</label></br>
       <input type="text" id="nev" name="nev" value="<?php if(isset($nev)) print $nev ?>">
    </p>
    <p><label for="cegnev">Cegnev:</label></br>
       <input type="text" id="cegnev" name="cegnev" value="<?php if(isset($cegnev)) print $cegnev ?>">
    </p>
    <p><label for="Mobil">Mobil:</label></br>
       <input type="tel" id="Mobil" name="Mobil" value="<?php if(isset($Mobil)) print $Mobil ?>">
    </p>
    <p><label for="Email">Email:</label></br>
       <input type="mail" id="Email" name="Email" value="<?php if(isset($Email)) print $Email ?>">
    </p>
    <p><em>A *-al jelolt mezok kitoltese kotelezo</em></p>
    <input type="submit" id="rendben" name="rendben" value="Rendben">
    <input type="reset" value="Megsem">
    </form>

    <p><a href="lista.php">Vissza a tablazathoz</a></p>

</body>
</html>