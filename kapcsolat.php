<?php
header("Content-Type: text/html; charset=utf-8");
define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","");
define("DBNAME","kezdo");
$dbconn=@mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME) or die ("hiba az adatbazis csatlakozashoz");
mysqli_query($dbconn, "SET NAMES utf8");
?>