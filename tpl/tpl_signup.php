<?php
include_once "inc/auth_functions.php";

$htmlContent = '<h1 class="wow fadeInUp">Registrieren</h1>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["txtEmail"] ?? "");
    $userName = trim($_POST["txtUserName"] ?? ""); 
    $passWord = $_POST["txtPassword"] ?? ""; 

    if (empty($email) || empty($userName) || empty($passWord)) {
        $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Bitte füllen Sie alle Felder aus.</div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Bitte geben Sie eine gültige E-Mail-Adresse ein.</div>';
    } elseif (strlen($email) > 100) {
        $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Die E-Mail-Adresse darf maximal 100 Zeichen lang sein.</div>';
    } elseif (strlen($userName) > 50) {
        $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Der Benutzername darf maximal 50 Zeichen lang sein.</div>';
    } elseif (strlen($passWord) < 8) {
        $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Das Passwort muss mindestens 8 Zeichen lang sein.</div>';
    } else {
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $userName = htmlspecialchars($userName, ENT_QUOTES, 'UTF-8');
        $result = forumSignup($email, $userName, $passWord);
        if ($result["success"]) {
            $htmlContent .= '<div class="alert alert-success wow fadeIn" data-wow-delay="0.2s">' . $result["message"] . ' Sie können sich jetzt <a href="index.php?p=login">anmelden</a>.</div>';
        } else {
            $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">' . $result["message"] . '</div>';
        }
    }
}

$htmlContent .= '<form method="post" action="index.php?p=signup" class="wow fadeIn" data-wow-delay="0.3s">';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtEmail" class="form-label">E-Mail-Adresse</label>';
$htmlContent .= '<input type="email" class="form-control" id="txtEmail" name="txtEmail" maxlength="100" required>';
$htmlContent .= '</div>';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtUserName" class="form-label">Benutzername (für Anzeige)</label>';
$htmlContent .= '<input type="text" class="form-control" id="txtUserName" name="txtUserName" maxlength="50" required>';
$htmlContent .= '</div>';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtPassword" class="form-label">Passwort</label>';
$htmlContent .= '<input type="password" class="form-control" id="txtPassword" name="txtPassword" minlength="8" required>';
$htmlContent .= '</div>';
$htmlContent .= '<button type="submit" class="btn btn-primary">Registrieren</button>';
$htmlContent .= '</form>';

$tpl_index->set("content", $htmlContent);
?>