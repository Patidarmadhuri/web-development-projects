<?php
include_once "inc/post_functions.php";

if (!forumIsLoggedIn()) {
    header("Location: index.php?p=login");
    exit();
}

$commentId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$comment = null;

if ($commentId) {
    $comment = forumGetCommentById($commentId);
    if (!$comment || (!forumIsAdmin() && $comment["c_user_id"] != $_SESSION["userId"])) {
        header("Location: index.php?p=posts");
        exit();
    }
} else {
    header("Location: index.php?p=posts");
    exit();
}

if (forumDeleteComment($commentId)) {
    header("Location: index.php?p=posts");
    exit();
} else {
    $htmlContent = '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Fehler beim Löschen des Kommentars.</div>';
    $tpl_index->set("content", $htmlContent);
}
?>