<?php
session_start();
if(isset($_POST['rendben'])) {
//valtozok tisztitasa
    require("../kapcsolat.php");
    $email = mysqli_real_escape_string($dbconn, strip_tags(strtolower(trim($_POST['email']))));
    $jelszo = sha1($_POST['jelszo']);

//valtozok ellenorzese
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))  {
        $hiba ="ribas E-mail cimet vagy jelszot adtal meg!";
    //beleptetes
    } else {
        
        $sql = "SELECT id
        FROM felhasznalok
        WHERE email = '{$email}'
        AND jelszo = '{$jelszo}'
        LIMIT 2";
        $eredmeny = mysqli_query($dbconn, $sql);
        
        //sikeress
        if (mysqli_num_rows($eredmeny) == 1) {
            $_SESSION['belepett']=true;
            header("Location:lista.php");
        //sikertelen
        } else {
            $hiba ="Hibas E-mail cimet vagy jelszot adtal meg!";
        }
    }
}

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Nevjegykartyak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../stilus1.css" />
    
</head>
<body>
    <h1>Belepes</h1>
    <form method="post" action="">
    <?php if(isset($hiba)) print $hiba; ?>
        <label for="email"></label>E-mail:*</br>
        <p><input type="email" id="email" name="email" required></p>
        <label for="jelszo"></label>Jelszo:*</br>
        <p><input type="password" id="jelszo" name="jelszo" required></p>
        <p><em>A *-al jelölt mezök kitöltese kötelezö!</em></p>
        <input type="submit" id="rendben" name="rendben" value="Belepes">
    </form>
    
    
</body>
</html>