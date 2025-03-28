<?php

if (!isUserLoggedIn()) {
    header("Location: index.php?p=login");
    exit();
}

$postTitle = "";
$postContent = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postTitle = trim($_POST["txtTitle"] ?? "");
    $postContent = trim($_POST["txtContent"] ?? "");

    if (empty($postTitle) || empty($postContent)) {
        $errorMessage = "Titel und Inhalt sind erforderlich.";
    } else {
        // Sanitize inputs to prevent XSS
        $postTitle = htmlspecialchars($postTitle, ENT_QUOTES, 'UTF-8');
        $postContent = htmlspecialchars($postContent, ENT_QUOTES, 'UTF-8');

        $userId = $_SESSION["userId"];
        if (forumCreatePost($userId, $postTitle, $postContent)) {
            $successMessage = "Beitrag erfolgreich erstellt!";
            header("Location: index.php?p=posts&page=1");
            exit();
        } else {
            $errorMessage = "Fehler beim Erstellen des Beitrags.";
        }
    }
}

$htmlContent = '<h1 class="wow fadeInUp">Beitrag erstellen</h1>';

if (!empty($errorMessage)) {
    $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">' . htmlspecialchars($errorMessage) . '</div>';
}
if (!empty($successMessage)) {
    $htmlContent .= '<div class="alert alert-success wow fadeIn" data-wow-delay="0.2s">' . htmlspecialchars($successMessage) . '</div>';
}

$htmlContent .= '<form method="post" action="index.php?p=create" class="wow fadeIn" data-wow-delay="0.3s">';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtTitle" class="form-label">Titel</label>';
$htmlContent .= '<input type="text" class="form-control" id="txtTitle" name="txtTitle" value="' . rpl($postTitle) . '" required>';
$htmlContent .= '</div>';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtContent" class="form-label">Inhalt</label>';
$htmlContent .= '<textarea class="form-control" id="txtContent" name="txtContent" rows="5" required>' . rpl($postContent) . '</textarea>';
$htmlContent .= '</div>';
$htmlContent .= '<button type="submit" class="btn btn-primary">Beitrag erstellen</button>';
$htmlContent .= '</form>';

$tpl_index->set("content", $htmlContent);
?>