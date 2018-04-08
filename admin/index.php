<?php
session_start();
if(isset($_POST['rendben'])) {
//valtozok tisztitasa
    $email = strip_tags(strtolower(trim($_POST['email'])));
    $jelszo = strip_tags($_POST['jelszo']);

//valtozok ellenorzese
    if(empty($email) || 
    !filter_var($email, FILTER_VALIDATE_EMAIL) || 
    !preg_match("/^[a-zA-Z ]*$/", $jelszo)) {
        $hiba ="Hibas E-mail cimet vagy jelszot adtal meg!";
    //beleptetes
    } else {
        //sikeress
        if($email == "jancsi@gmail.com" && sha1($jelszo) == "49cef48df229f6e608f4b57c11ef05c4f014f0c6") {
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
    <link rel="stylesheet" type="text/css" media="screen" href="../stilus.css" />
    
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