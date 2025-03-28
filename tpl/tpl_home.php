<?php

$content = '<div class="text-center">';
$content .= '<h1 class="wow fadeInUp">Willkommen im AI Forum</h1>';
$content .= '<p class="lead">Dies ist ein einfaches Forum, in dem Sie Beiträge erstellen und anzeigen können.</p>';
$content .= '<p><a href="index.php?p=posts" class="btn btn-primary">Alle Beiträge anzeigen</a></p>';
$content .= '</div>';

$tpl_index->set("content", $content);
?>