<?php
include_once "inc/post_functions.php"; 

if (!forumIsLoggedIn()) {
    $htmlContent = '<div class="alert alert-warning">Bitte <a href="index.php?p=login">anmelden</a>, um einen Beitrag zu bearbeiten.</div>';
    $tpl_index->set("content", $htmlContent);
    exit();
}

if (!isset($_GET["id"])) {
    $htmlContent = '<div class="alert alert-danger">Keine Beitrags-ID angegeben.</div>';
    $tpl_index->set("content", $htmlContent);
    exit();
}

$postId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$postData = getPostById($conn, $postId); 

if (!$postData || ($postData["p_user_id"] != $_SESSION["userId"] && !forumIsAdmin())) {
    $htmlContent = '<div class="alert alert-danger">Beitrag nicht gefunden oder Sie haben keine Berechtigung, ihn zu bearbeiten.</div>';
    $tpl_index->set("content", $htmlContent);
    exit();
}

$htmlContent = '<h1 class="wow fadeInUp">Beitrag bearbeiten</h1>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postTitle = trim($_POST["txtTitle"] ?? "");
    $postContent = trim($_POST["txtContent"] ?? "");

    if (empty($postTitle) || empty($postContent)) {
        $htmlContent .= '<div class="alert alert-warning">Bitte füllen Sie alle Felder aus.</div>';
    } else {
        $postTitle = htmlspecialchars($postTitle, ENT_QUOTES, 'UTF-8');
        $postContent = htmlspecialchars($postContent, ENT_QUOTES, 'UTF-8');
        if (forumUpdatePost($postId, $postTitle, $postContent)) {
            header("Location: index.php?p=posts");
            exit();
        } else {
            $htmlContent .= '<div class="alert alert-danger">Fehler beim Aktualisieren des Beitrags.</div>';
        }
    }
}

$htmlContent .= '<form method="post" action="index.php?p=edit&id=' . $postId . '">';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtTitle" class="form-label">Titel:</label>';
$htmlContent .= '<input type="text" name="txtTitle" id="txtTitle" class="form-control" value="' . rpl($postData["p_title"]) . '" required>';
$htmlContent .= '</div>';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtContent" class="form-label">Inhalt:</label>';
$htmlContent .= '<textarea name="txtContent" id="txtContent" class="form-control" rows="5" required>' . rpl($postData["p_content"]) . '</textarea>';
$htmlContent .= '</div>';
$htmlContent .= '<button type="submit" class="btn btn-primary">Beitrag aktualisieren</button>';
$htmlContent .= '</form>';

$tpl_index->set("content", $htmlContent);
?>