<!DOCTYPE html>
<html>
<head>
    <title>Simple Post Forum</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div id="divHeader">
        <nav>
            <a href="index.php?p=home">Home</a> |
            <a href="index.php?p=posts">Posts</a> |
            <?php if (isUserLoggedIn()) { ?>
                <a href="index.php?p=create">Create Post</a> |
                <a href="index.php?p=logout">Logout (<?php echo htmlspecialchars($_SESSION["userName"]); ?>)</a>
            <?php } else { ?>
                <a href="index.php?p=login">Login</a> |
                <a href="index.php?p=signup">Signup</a>
            <?php } ?>
            | <a href="index.php?p=privacy_policy">Privacy Policy</a>
        </nav>
    </div>

    <div id="divContent">
        <?php echo $content; ?>
    </div>

    <div id="divFooter">
        <p>&copy; 2025 Simple Post Forum</p>
    </div>
</body>
</html>