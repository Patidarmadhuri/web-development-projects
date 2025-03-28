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

$htmlContent = '<h1 class="wow fadeInUp">Kommentar bearbeiten</h1>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentContent = filter_input(INPUT_POST, "txtComment", FILTER_SANITIZE_STRING);

    if (empty($commentContent)) {
        $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Bitte geben Sie einen Kommentar ein.</div>';
    } else {
        if (forumUpdateComment($commentId, $commentContent)) {
            header("Location: index.php?p=posts");
            exit();
        } else {
            $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Fehler beim Aktualisieren des Kommentars.</div>';
        }
    }
}

$htmlContent .= '<form method="post" action="index.php?p=edit_comment&id=' . $commentId . '" class="wow fadeIn" data-wow-delay="0.3s">';
$htmlContent .= '<div class="mb-3">';
$htmlContent .= '<label for="txtComment" class="form-label">Kommentar</label>';
$htmlContent .= '<textarea class="form-control" id="txtComment" name="txtComment" rows="3" required>' . rpl($comment["c_content"]) . '</textarea>';
$htmlContent .= '</div>';
$htmlContent .= '<button type="submit" class="btn btn-primary">Speichern</button>';
$htmlContent .= '</form>';

$tpl_index->set("content", $htmlContent);
?>