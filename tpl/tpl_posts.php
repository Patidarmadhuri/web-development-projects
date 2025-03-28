<?php
include_once "inc/post_functions.php";

$htmlContent = '<h1 class="wow fadeInUp">Beiträge</h1>';

$searchQuery = isset($_GET["search"]) ? trim(filter_input(INPUT_GET, "search", FILTER_DEFAULT)) : '';
$searchQuery = htmlspecialchars($searchQuery, ENT_QUOTES, 'UTF-8'); 

// Add search form
$htmlContent .= '<div class="row mb-4">';
$htmlContent .= '<div class="col-md-12">';
$htmlContent .= '<form method="get" action="index.php" class="d-flex">';
$htmlContent .= '<input type="hidden" name="p" value="posts">';
$htmlContent .= '<input type="text" name="search" class="form-control me-2" placeholder="Suche nach Beiträgen..." value="' . htmlspecialchars($searchQuery) . '">';
$htmlContent .= '<button type="submit" class="btn btn-primary">Suchen</button>';
if (!empty($searchQuery)) {
    $htmlContent .= ' <a href="index.php?p=posts" class="btn btn-secondary ms-2">Suche zurücksetzen</a>';
}
$htmlContent .= '</form>';
if (!empty($searchQuery)) {
    $htmlContent .= '<p class="mt-2">Suchergebnisse für: <strong>' . htmlspecialchars($searchQuery) . '</strong></p>';
}
$htmlContent .= '</div>';
$htmlContent .= '</div>';

// Handle comment submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && forumIsLoggedIn()) {
    $postId = filter_input(INPUT_POST, "commentPostId", FILTER_SANITIZE_NUMBER_INT);
    $commentContent = trim($_POST["txtComment"] ?? "");
    $commentContent = htmlspecialchars($commentContent, ENT_QUOTES, 'UTF-8'); 

    if (empty($postId) || empty($commentContent)) {
        $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Bitte füllen Sie alle Felder aus.</div>';
    } else {
        if (forumAddComment($postId, $_SESSION["userId"], $commentContent)) {
            $htmlContent .= '<div class="alert alert-success wow fadeIn" data-wow-delay="0.2s">Kommentar erfolgreich hinzugefügt!</div>';
        } else {
            $htmlContent .= '<div class="alert alert-danger wow fadeIn" data-wow-delay="0.2s">Fehler beim Hinzufügen des Kommentars.</div>';
        }
    }
}

// Pagination setup
$postsPerPage = 5;
$currentPage = isset($_GET["page"]) ? max(1, filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT)) : 1;
$totalPosts = forumGetTotalPostsCount($searchQuery);
$totalPages = ceil($totalPosts / $postsPerPage);

// Redirect to the last valid page if the current page is invalid
if ($currentPage < 1) {
    $currentPage = 1;
    header("Location: index.php?p=posts" . (!empty($searchQuery) ? "&search=" . urlencode($searchQuery) : "") . "&page=1");
    exit();
}
if ($currentPage > $totalPages && $totalPages > 0) {
    $currentPage = $totalPages;
    header("Location: index.php?p=posts" . (!empty($searchQuery) ? "&search=" . urlencode($searchQuery) : "") . "&page=" . $totalPages);
    exit();
}

$offset = ($currentPage - 1) * $postsPerPage;
$postsArray = forumGetPosts($offset, $postsPerPage, $searchQuery);

// Display posts or a message if none are found
if (empty($postsArray) && $currentPage == 1) {
    $htmlContent .= '<div class="alert alert-info wow fadeIn" data-wow-delay="0.3s">';
    $htmlContent .= !empty($searchQuery) ? 'Keine Beiträge gefunden, die Ihrer Suche entsprechen.' : 'Keine Beiträge gefunden.';
    $htmlContent .= '</div>';
} else {
    $htmlContent .= '<div id="divPostsContainer">';
    $delay = 0.1;
    foreach ($postsArray as $row) {
        $htmlContent .= '<div class="post-card wow fadeInUp" data-wow-delay="' . $delay . 's">';
        $htmlContent .= '<h3>' . rpl($row["p_title"]) . '</h3>';

        // Truncate content if longer than 200 characters
        $content = $row["p_content"];
        $contentWithBreaks = insertBreakingPoints(rpl($content));
        $contentLength = mb_strlen($content, 'UTF-8');
        $truncateLength = 200;
        if ($contentLength > $truncateLength) {
            $truncatedContent = mb_substr($content, 0, $truncateLength, 'UTF-8') . '...';
            $truncatedContentWithBreaks = insertBreakingPoints(rpl($truncatedContent));
            $htmlContent .= '<p class="post-content-truncated">' . $truncatedContentWithBreaks . '</p>';
            $htmlContent .= '<p class="post-content-full" style="display: none;">' . $contentWithBreaks . '</p>';
            $htmlContent .= '<button class="btn btn-read-more" onclick="toggleContent(this)">Vollständige Ansicht</button>';
        } else {
            $htmlContent .= '<p class="post-content">' . $contentWithBreaks . '</p>';
        }

        // Format the created date
        $createdAt = $row["p_created_at"] ? (new DateTime($row["p_created_at"]))->format('d.m.Y H:i:s') : 'Unbekannt';
        $htmlContent .= '<p class="text-muted">Gepostet von: ' . rpl($row["u_username"]) . ' am ' . $createdAt . '</p>';

        // Show edit/delete buttons for the post owner or admins
        if (forumIsLoggedIn() && (forumIsAdmin() || $row["p_user_id"] == $_SESSION["userId"])) {
            $htmlContent .= '<p>';
            $htmlContent .= '<a href="index.php?p=edit&id=' . $row["p_id"] . '" class="btn btn-sm btn-warning">Bearbeiten</a> ';
            $htmlContent .= '<a href="index.php?p=delete&id=' . $row["p_id"] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Sind Sie sicher?\')">Löschen</a>';
            $htmlContent .= '</p>';
        }

        // Display a toggle link for comments
        $comments = forumGetCommentsByPostId($row["p_id"]);
        $commentCount = count($comments);
        $htmlContent .= '<div class="comments-toggle mt-3">';
        $htmlContent .= '<button type="button" class="btn btn-link toggle-comments" data-post-id="' . $row["p_id"] . '">';
        $htmlContent .= $commentCount > 0 ? "Kommentare anzeigen ($commentCount)" : "Noch keine Kommentare";
        $htmlContent .= '</button>';
        $htmlContent .= '<div class="comments-section mt-3" id="comments-' . $row["p_id"] . '" style="display: none;">';
        if ($commentCount > 0) {
            $htmlContent .= '<h5>Kommentare (' . $commentCount . ')</h5>';
            foreach ($comments as $comment) {
                $htmlContent .= '<div class="comment mb-2" id="comment-' . $comment["c_id"] . '">';
                $htmlContent .= '<p>' . rpl($comment["c_content"]) . '</p>';
                $htmlContent .= '<p class="text-muted small">Kommentiert von: ' . rpl($comment["u_username"]) . ' am ' . rpl($comment["c_created_at"]) . '</p>';

                // Show edit/delete buttons for the comment owner or admins
                if (forumIsLoggedIn() && (forumIsAdmin() || $comment["c_user_id"] == $_SESSION["userId"])) {
                    $htmlContent .= '<p>';
                    $htmlContent .= '<a href="index.php?p=edit_comment&id=' . $comment["c_id"] . '" class="btn btn-sm btn-warning">Bearbeiten</a> ';
                    $htmlContent .= '<a href="index.php?p=delete_comment&id=' . $comment["c_id"] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Sind Sie sicher?\')">Löschen</a>';
                    $htmlContent .= '</p>';
                }

                $htmlContent .= '</div>';
            }
        }
        $htmlContent .= '</div>';
        $htmlContent .= '</div>';

        // Add comment toggle button and form for logged-in users
        if (forumIsLoggedIn()) {
            $htmlContent .= '<div class="comment-toggle mt-3">';
            $htmlContent .= '<button type="button" class="btn btn-outline-primary btn-sm toggle-comment-form" data-post-id="' . $row["p_id"] . '">Kommentar hinzufügen</button>';
            $htmlContent .= '<div class="comment-form mt-3" id="comment-form-' . $row["p_id"] . '" style="display: none;">';
            $htmlContent .= '<form method="post" action="index.php?p=posts' . (isset($_GET["page"]) ? "&page=" . $currentPage : "") . (!empty($searchQuery) ? "&search=" . urlencode($searchQuery) : "") . '">';
            $htmlContent .= '<input type="hidden" name="commentPostId" value="' . $row["p_id"] . '">';
            $htmlContent .= '<div class="mb-3">';
            $htmlContent .= '<textarea class="form-control" name="txtComment" rows="3" placeholder="Ihr Kommentar..." required></textarea>';
            $htmlContent .= '</div>';
            $htmlContent .= '<button type="submit" class="btn btn-primary">Kommentar absenden</button>';
            $htmlContent .= '</form>';
            $htmlContent .= '</div>';
            $htmlContent .= '</div>';
        }

        $htmlContent .= '</div>';
        $delay += 0.1;
    }
    $htmlContent .= '</div>';

    // Pagination controls (only show if there are posts and more than one page)
    if ($totalPosts > 0 && $totalPages > 1) {
        $htmlContent .= '<nav aria-label="Page navigation" class="mt-4">';
        $htmlContent .= '<ul class="pagination justify-content-center">';

        // Previous page link
        $prevDisabled = $currentPage <= 1 ? "disabled" : "";
        $htmlContent .= '<li class="page-item ' . $prevDisabled . '">';
        $htmlContent .= '<a class="page-link" href="index.php?p=posts' . (!empty($searchQuery) ? "&search=" . urlencode($searchQuery) : "") . '&page=' . ($currentPage - 1) . '" aria-label="Previous">';
        $htmlContent .= '<span aria-hidden="true">«</span>';
        $htmlContent .= '</a>';
        $htmlContent .= '</li>';

        // Dynamic page links (show 5 pages centered around the current page)
        $maxPagesToShow = 5;
        $startPage = max(1, $currentPage - floor($maxPagesToShow / 2));
        $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);
        $startPage = max(1, $endPage - $maxPagesToShow + 1);

        // Add ellipsis before the page numbers if startPage > 1
        if ($startPage > 1) {
            $htmlContent .= '<li class="page-item">';
            $htmlContent .= '<a class="page-link" href="index.php?p=posts' . (!empty($searchQuery) ? "&search=" . urlencode($searchQuery) : "") . '&page=1">1</a>';
            $htmlContent .= '</li>';
            if ($startPage > 2) {
                $htmlContent .= '<li class="page-item disabled">';
                $htmlContent .= '<span class="page-link">...</span>';
                $htmlContent .= '</li>';
            }
        }

        // Page numbers
        for ($i = $startPage; $i <= $endPage; $i++) {
            $active = $i == $currentPage ? "active" : "";
            $htmlContent .= '<li class="page-item ' . $active . '">';
            $htmlContent .= '<a class="page-link" href="index.php?p=posts' . (!empty($searchQuery) ? "&search=" . urlencode($searchQuery) : "") . '&page=' . $i . '">' . $i . '</a>';
            $htmlContent .= '</li>';
        }

        // Add ellipsis after the page numbers if endPage < totalPages
        if ($endPage < $totalPages) {
            if ($endPage < $totalPages - 1) {
                $htmlContent .= '<li class="page-item disabled">';
                $htmlContent .= '<span class="page-link">...</span>';
                $htmlContent .= '</li>';
            }
            $htmlContent .= '<li class="page-item">';
            $htmlContent .= '<a class="page-link" href="index.php?p=posts' . (!empty($searchQuery) ? "&search=" . urlencode($searchQuery) : "") . '&page=' . $totalPages . '">' . $totalPages . '</a>';
            $htmlContent .= '</li>';
        }

        // Next page link
        $nextDisabled = $currentPage >= $totalPages ? "disabled" : "";
        $htmlContent .= '<li class="page-item ' . $nextDisabled . '">';
        $htmlContent .= '<a class="page-link" href="index.php?p=posts' . (!empty($searchQuery) ? "&search=" . urlencode($searchQuery) : "") . '&page=' . ($currentPage + 1) . '" aria-label="Next">';
        $htmlContent .= '<span aria-hidden="true">»</span>';
        $htmlContent .= '</a>';
        $htmlContent .= '</li>';

        $htmlContent .= '</ul>';
        $htmlContent .= '</nav>';
    }
}

$tpl_index->set("content", $htmlContent);
?>