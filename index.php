<?php

if (!file_exists("inc/config.php")) {
    die("Error: inc/config.php not found.");
}
require_once "inc/config.php";

if (!file_exists("inc/auth_functions.php")) {
    die("Error: inc/auth_functions.php not found.");
}
require_once "inc/auth_functions.php";

if (!file_exists("inc/post_functions.php")) {
    die("Error: inc/post_functions.php not found.");
}
require_once "inc/post_functions.php";

if (!file_exists("inc/template.php")) {
    die("Error: inc/template.php not found.");
}
require_once "inc/template.php";

$tpl_index = new Template();

function rpl($text, $escape = true)
{
    if ($escape) {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
    return $text;
}

$allowedPages = [
    'home',
    'posts',
    'create',
    'edit',
    'delete',
    'login',
    'signup',
    'logout',
    'privacy_policy',
    'edit_comment',
    'delete_comment',
    'admin' 
];

$page = isset($_GET["p"]) ? $_GET["p"] : 'home';
$page = is_string($page) ? $page : 'home';

if (!in_array($page, $allowedPages, true)) {
    $page = '404';
}

switch ($page) {
    case "home":
        include "tpl/tpl_home.php";
        break;
    case "posts":
        include "tpl/tpl_posts.php";
        break;
    case "create":
        include "tpl/tpl_create.php";
        break;
    case "edit":
        include "tpl/tpl_edit.php";
        break;
    case "delete":
        include "tpl/tpl_delete.php";
        break;
    case "login":
        include "tpl/tpl_login.php";
        break;
    case "signup":
        include "tpl/tpl_signup.php";
        break;
    case "logout":
        include "tpl/tpl_logout.php";
        break;
    case "privacy_policy":
        include "tpl/tpl_privacy_policy.php";
        break;
    case "edit_comment":
        include "tpl/tpl_edit_comment.php";
        break;
    case "delete_comment":
        include "tpl/tpl_delete_comment.php";
        break;
    case "admin":
        include "tpl/tpl_admin.php";
        break;
    default:
        include "tpl/tpl_404.php";
        break;
}

include "tpl/tpl_index.php";
?>