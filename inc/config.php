<?php

session_start();

if (!defined("SITE_URL"))
{
    define("SITE_URL", "http://localhost/Website-Basis-Forum/");
}


$hostName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "website_basis_forum";

$conn = mysqli_connect($hostName, $userName, $passWord, $dbName);

if (!$conn)
{
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}
?>