<?php

// Include guard to prevent multiple inclusions
if (defined('POST_FUNCTIONS_INCLUDED')) {
    return;
}
define('POST_FUNCTIONS_INCLUDED', true);

// Utility function to insert breaking points in text
function insertBreakingPoints($text)
{
    return nl2br($text);
}

// Get posts with pagination
function forumGetPosts($offset, $postsPerPage, $searchQuery = '')
{
    global $conn;

    $sql = "SELECT p.p_id, p.p_title, p.p_content, p.p_created_at, p.p_user_id, u.u_username 
            FROM tblposts p 
            JOIN tblusers u ON p.p_user_id = u.u_id";
    
    $params = [];
    $types = "";
    
    if (!empty($searchQuery)) {
        $sql .= " WHERE p.p_title LIKE ? OR p.p_content LIKE ?";
        $searchTerm = "%" . $searchQuery . "%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= "ss";
    }
    
    $sql .= " ORDER BY p.p_created_at DESC LIMIT ?, ?";
    $params[] = $offset;
    $params[] = $postsPerPage;
    $types .= "ii";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return [];
    }

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $posts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }

    mysqli_stmt_close($stmt);
    return $posts;
}

// Get total number of posts
function forumGetTotalPostsCount($searchQuery = '')
{
    global $conn;

    $sql = "SELECT COUNT(*) as total FROM tblposts p";
    
    $params = [];
    $types = "";
    
    if (!empty($searchQuery)) {
        $sql .= " WHERE p.p_title LIKE ? OR p.p_content LIKE ?";
        $searchTerm = "%" . $searchQuery . "%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
        $types .= "ss";
    }

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return 0;
    }

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'];

    mysqli_stmt_close($stmt);
    mysqli_free_result($result);
    return $total;
}

// Get a post by its ID
function getPostById($conn, $postId)
{
    $sql = "SELECT p.*, u.u_username 
            FROM tblposts p 
            JOIN tblusers u ON p.p_user_id = u.u_id 
            WHERE p.p_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Error preparing statement: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "i", $postId);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
    return $row;
}

// Create a new post
function forumCreatePost($userId, $title, $content)
{
    global $conn;

    $sql = "INSERT INTO tblposts (p_user_id, p_title, p_content, p_created_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iss", $userId, $title, $content);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success;
}

// Update a post
function forumUpdatePost($postId, $title, $content)
{
    global $conn;

    $sql = "UPDATE tblposts SET p_title = ?, p_content = ? WHERE p_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $postId);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success;
}

// Delete a post
function forumDeletePost($postId)
{
    global $conn;

    // First, delete all comments associated with the post
    $sql = "DELETE FROM tblcomments WHERE c_post_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $postId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Then, delete the post
    $sql = "DELETE FROM tblposts WHERE p_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $postId);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success;
}

// Add a comment to a post
function forumAddComment($postId, $userId, $content)
{
    global $conn;

    $sql = "INSERT INTO tblcomments (c_post_id, c_user_id, c_content) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iis", $postId, $userId, $content);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success;
}

// Get comments for a specific post
function forumGetCommentsByPostId($postId)
{
    global $conn;

    $sql = "SELECT c.c_id, c.c_content, c.c_user_id, c.c_post_id, c.c_created_at, u.u_username 
            FROM tblcomments c 
            JOIN tblusers u ON c.c_user_id = u.u_id 
            WHERE c.c_post_id = ? 
            ORDER BY c.c_created_at ASC";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return [];
    }

    mysqli_stmt_bind_param($stmt, "i", $postId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    return $comments;
}

// Get a comment by its ID
function forumGetCommentById($commentId)
{
    global $conn;

    $sql = "SELECT c.c_id, c.c_content, c.c_user_id, c.c_post_id, c.c_created_at, u.u_username 
            FROM tblcomments c 
            JOIN tblusers u ON c.c_user_id = u.u_id 
            WHERE c.c_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $commentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $comment = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return $comment;
}

// Update a comment
function forumUpdateComment($commentId, $content)
{
    global $conn;

    $sql = "UPDATE tblcomments SET c_content = ? WHERE c_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "si", $content, $commentId);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success;
}

// Delete a comment
function forumDeleteComment($commentId)
{
    global $conn;

    $sql = "DELETE FROM tblcomments WHERE c_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $commentId);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success;
}
?>