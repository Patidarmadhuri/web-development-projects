<?php
include_once "inc/post_functions.php"; 
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Forum</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- WOW.js CSS (for animations) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header id="divHeader">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand wow fadeIn" href="index.php?p=home">AI Forum</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link wow fadeIn" data-wow-delay="0.1s" href="index.php?p=home">Startseite</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link wow fadeIn" data-wow-delay="0.2s" href="index.php?p=posts">Beiträge</a>
                        </li>
                        <?php if (isUserLoggedIn()) { ?>
                            <li class="nav-item">
                                <a class="nav-link wow fadeIn" data-wow-delay="0.3s" href="index.php?p=create">Beitrag erstellen</a>
                            </li>
                            <?php if (isUserAdmin()) { ?>
                                <li class="nav-item">
                                    <a class="nav-link wow fadeIn" data-wow-delay="0.4s" href="index.php?p=admin">Admin Dashboard</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="nav-link wow fadeIn" data-wow-delay="0.5s" href="index.php?p=logout">Abmelden (<?php echo htmlspecialchars($_SESSION["userName"]); ?>)</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link wow fadeIn" data-wow-delay="0.3s" href="index.php?p=login">Anmelden</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link wow fadeIn" data-wow-delay="0.4s" href="index.php?p=signup">Registrieren</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link wow fadeIn" data-wow-delay="0.6s" href="index.php?p=privacy_policy">Datenschutz</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main id="divContent" class="container mt-5">
        <?= rpl($tpl_index->get("content"), false); ?>
    </main>

    <button id="btnBackToTop" class="btn btn-primary" title="Nach oben">
        <i class="fas fa-arrow-up"></i>
    </button>

    <footer id="divFooter" class="py-3 mt-5">
        <div class="container text-center">
            <p>© 2025 AI Forum. Alle Rechte vorbehalten.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- WOW.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="public/js/scripts.js"></script>
</body>
</html>