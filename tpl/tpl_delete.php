<?php
include_once "inc/post_functions.php";

if (!forumIsLoggedIn()) {
    header("Location: index.php?p=login");
    exit();
}

if (!isset($_GET["id"])) {
    $htmlContent = '<div class="alert alert-danger">Keine Beitrags-ID angegeben.</div>';
    $tpl_index->set("content", $htmlContent);
    exit();
}

$postId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
if (!$postId) {
    $htmlContent = '<div class="alert alert-danger">Ungültige Beitrags-ID.</div>';
    $tpl_index->set("content", $htmlContent);
    exit();
}

$postData = getPostById($conn, $postId);
if (!$postData || ($postData["p_user_id"] != $_SESSION["userId"] && !forumIsAdmin())) {
    $htmlContent = '<div class="alert alert-danger">Beitrag nicht gefunden oder Sie haben keine Berechtigung, ihn zu löschen.</div>';
    $tpl_index->set("content", $htmlContent);
    exit();
}

if (forumDeletePost($postId)) {
    header("Location: index.php?p=posts");
    exit();
} else {
    $htmlContent = '<div class="alert alert-danger">Fehler beim Löschen des Beitrags.</div>';
    $tpl_index->set("content", $htmlContent);
}
?>