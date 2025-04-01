<?php
include_once "inc/auth_functions.php";

$htmlContent = '<h1 class="wow fadeInUp">Anmelden</h1>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginInput = trim($_POST["txtLoginInput"] ?? "");
    $passWord = $_POST["txtPassword"] ?? ""; 

    if (empty($loginInput) || empty($passWord)) {
        $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Bitte füllen Sie alle Felder aus.</div>';
    } else {
        $result = userLogin($loginInput, $passWord);
        if ($result["success"]) {
            header("Location: index.php?p=posts");
            exit();
        } else {
            $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">' . $result["message"] . '</div>';
        }
    }
}

$htmlContent .= '<form method="post" action="index.php?p=login" class="wow fadeIn" data-wow-delay="0.3s">';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtLoginInput" class="form-label">E-Mail-Adresse oder Benutzername</label>';
$htmlContent .= '<input type="text" class="form-control" id="txtLoginInput" name="txtLoginInput" required>';
$htmlContent .= '</div>';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtPassword" class="form-label">Passwort</label>';
$htmlContent .= '<input type="password" class="form-control" id="txtPassword" name="txtPassword" required>';
$htmlContent .= '</div>';
$htmlContent .= '<button type="submit" class="btn btn-primary">Anmelden</button>';
$htmlContent .= '</form>';

$tpl_index->set("content", $htmlContent);
?>