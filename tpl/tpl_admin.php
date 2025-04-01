<?php

// Check if the user is logged in and is an admin
if (!isUserLoggedIn() || !isUserAdmin()) {
    $htmlContent = "<div class='alert alert-danger'>Zugriff verweigert. Sie müssen ein Administrator sein, um auf diese Seite zuzugreifen.</div>";
    $tpl_index->set("content", $htmlContent);
    return;
}

// Verify database connection
if (!isset($conn)) {
    $htmlContent = "<div class='alert alert-danger'>Datenbankverbindung nicht verfügbar.</div>";
    $tpl_index->set("content", $htmlContent);
    return;
}

// Fetch all users
$sql = "SELECT u_id, u_email, u_username, u_role FROM tblusers";
$result = mysqli_query($conn, $sql);
$users = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    mysqli_free_result($result);
} else {
    $htmlContent = "<div class='alert alert-danger'>Fehler beim Abrufen der Benutzer: " . mysqli_error($conn) . "</div>";
    $tpl_index->set("content", $htmlContent);
    return;
}

// Fetch all posts
$sql = "SELECT p.p_id, p.p_title, p.p_content, p.p_created_at, u.u_username 
        FROM tblposts p 
        JOIN tblusers u ON p.p_user_id = u.u_id";
$result = mysqli_query($conn, $sql);
$posts = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
    mysqli_free_result($result);
} else {
    $htmlContent = "<div class='alert alert-danger'>Fehler beim Abrufen der Beiträge: " . mysqli_error($conn) . "</div>";
    $tpl_index->set("content", $htmlContent);
    return;
}

// Fetch all comments
$sql = "SELECT c.c_id, c.c_content, c.c_created_at, p.p_title, u.u_username 
        FROM tblcomments c 
        JOIN tblposts p ON c.c_post_id = p.p_id 
        JOIN tblusers u ON c.c_user_id = u.u_id";
$result = mysqli_query($conn, $sql);
$comments = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }
    mysqli_free_result($result);
} else {
    $htmlContent = "<div class='alert alert-danger'>Fehler beim Abrufen der Kommentare: " . mysqli_error($conn) . "</div>";
    $tpl_index->set("content", $htmlContent);
    return;
}

$htmlContent = <<<HTML
<h1 class="wow fadeInUp">Admin-Dashboard</h1>
<div class="row">
    <div class="col-md-12">
        <h2>Benutzer verwalten</h2>
        <table id="tblUsers" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>E-Mail</th>
                    <th>Benutzername</th>
                    <th>Rolle</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
HTML;

if (empty($users)) {
    $htmlContent .= '<tr><td colspan="5">Keine Benutzer gefunden.</td></tr>';
} else {
    foreach ($users as $user) {
        $htmlContent .= '<tr>';
        $htmlContent .= '<td>' . rpl($user['u_id']) . '</td>';
        $htmlContent .= '<td>' . rpl($user['u_email']) . '</td>';
        $htmlContent .= '<td>' . rpl($user['u_username']) . '</td>';
        $htmlContent .= '<td>' . rpl($user['u_role']) . '</td>';
        $htmlContent .= '<td>';
        $htmlContent .= '<a href="index.php?p=admin&action=delete_user&id=' . rpl($user['u_id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Sind Sie sicher, dass Sie diesen Benutzer löschen möchten?\');">Löschen</a>';
        $htmlContent .= '</td>';
        $htmlContent .= '</tr>';
    }
}

$htmlContent .= <<<HTML
            </tbody>
        </table>
    </div>

    <!-- Posts Section -->
    <div class="col-md-12">
        <h2>Beiträge verwalten</h2>
        <table id="tblPosts" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titel</th>
                    <th>Autor</th>
                    <th>Erstellt am</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
HTML;

if (empty($posts)) {
    $htmlContent .= '<tr><td colspan="5">Keine Beiträge gefunden.</td></tr>';
} else {
    foreach ($posts as $post) {
        $htmlContent .= '<tr>';
        $htmlContent .= '<td>' . rpl($post['p_id']) . '</td>';
        $htmlContent .= '<td>' . rpl($post['p_title']) . '</td>';
        $htmlContent .= '<td>' . rpl($post['u_username']) . '</td>';
        $htmlContent .= '<td>' . rpl($post['p_created_at']) . '</td>';
        $htmlContent .= '<td>';
        $htmlContent .= '<a href="index.php?p=edit&id=' . rpl($post['p_id']) . '" class="btn btn-primary btn-sm">Bearbeiten</a> ';
        $htmlContent .= '<a href="index.php?p=delete&id=' . rpl($post['p_id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Sind Sie sicher, dass Sie diesen Beitrag löschen möchten?\');">Löschen</a>';
        $htmlContent .= '</td>';
        $htmlContent .= '</tr>';
    }
}

$htmlContent .= <<<HTML
            </tbody>
        </table>
    </div>

    <!-- Comments Section -->
    <div class="col-md-12">
        <h2>Kommentare verwalten</h2>
        <table id="tblComments" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kommentar</th>
                    <th>Beitrag</th>
                    <th>Autor</th>
                    <th>Erstellt am</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
HTML;

if (empty($comments)) {
    $htmlContent .= '<tr><td colspan="6">Keine Kommentare gefunden.</td></tr>';
} else {
    foreach ($comments as $comment) {
        $htmlContent .= '<tr>';
        $htmlContent .= '<td>' . rpl($comment['c_id']) . '</td>';
        $htmlContent .= '<td>' . rpl($comment['c_content']) . '</td>';
        $htmlContent .= '<td>' . rpl($comment['p_title']) . '</td>';
        $htmlContent .= '<td>' . rpl($comment['u_username']) . '</td>';
        $htmlContent .= '<td>' . rpl($comment['c_created_at']) . '</td>';
        $htmlContent .= '<td>';
        $htmlContent .= '<a href="index.php?p=edit_comment&id=' . rpl($comment['c_id']) . '" class="btn btn-primary btn-sm">Bearbeiten</a> ';
        $htmlContent .= '<a href="index.php?p=delete_comment&id=' . rpl($comment['c_id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Sind Sie sicher, dass Sie diesen Kommentar löschen möchten?\');">Löschen</a>';
        $htmlContent .= '</td>';
        $htmlContent .= '</tr>';
    }
}

$htmlContent .= <<<HTML
            </tbody>
        </table>
    </div>
</div>
HTML;

// Handle delete user action
if (isset($_GET['action']) && $_GET['action'] === 'delete_user' && isset($_GET['id'])) {
    $userId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    
    // Prevent admin from deleting themselves
    if ($userId == $_SESSION["userId"]) {
        $htmlContent .= "<div class='alert alert-danger mt-3'>Sie können sich nicht selbst löschen.</div>";
    } else {
        $sql = "DELETE FROM tblusers WHERE u_id = ? AND u_id != ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $userId, $_SESSION["userId"]);
            $success = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
            if ($success) {
                // Redirect to refresh the page after deletion
                header("Location: index.php?p=admin");
                exit();
            } else {
                $htmlContent .= "<div class='alert alert-danger mt-3'>Fehler beim Löschen des Benutzers.</div>";
            }
        } else {
            $htmlContent .= "<div class='alert alert-danger mt-3'>Fehler beim Vorbereiten der Abfrage.</div>";
        }
    }
}

$tpl_index->set("content", $htmlContent);
?>