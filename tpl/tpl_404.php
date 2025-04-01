<?php
// Template file for displaying a 404 Not Found page

$htmlContent = '<h1 class="wow fadeInUp">404 - Seite nicht gefunden</h1>';
$htmlContent .= '<div class="alert alert-warning wow fadeIn" data-wow-delay="0.2s">';
$htmlContent .= 'Die von Ihnen angeforderte Seite existiert nicht. ';
$htmlContent .= 'Bitte überprüfen Sie die URL oder kehren Sie zur <a href="index.php?p=home">Startseite</a> zurück.';
$htmlContent .= '</div>';

// Set the content for the template
if (isset($tplIndex)) {
    $tplIndex->set("content", $htmlContent);
} else {
    // Fallback in case $tplIndex is not defined
    echo $htmlContent;
}
?>