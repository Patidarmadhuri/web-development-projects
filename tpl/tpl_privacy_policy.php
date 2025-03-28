<?php
$htmlContent = '<section id="sectionPrivacyPolicy">';
$htmlContent .= '<div class="title-bar wow fadeInUp">';
$htmlContent .= '<h1>Datenschutz</h1>';
$htmlContent .= '<div class="heading-border"></div>';
$htmlContent .= '</div>';

$htmlContent .= '<div class="container">';
$htmlContent .= '<div class="content-card wow fadeIn" data-wow-delay="0.2s">';
$htmlContent .= '<h2>1. Einleitung</h2>';
$htmlContent .= '<p>Willkommen im AI Forum! Wir legen großen Wert auf den Schutz Ihrer persönlichen Daten und die Einhaltung der Datenschutzgesetze, insbesondere der Datenschutz-Grundverordnung (DSGVO). Diese Datenschutzrichtlinie erläutert, wie wir Ihre Daten erheben, verwenden, speichern und schützen.</p>';

$htmlContent .= '<h2>2. Verantwortliche Stelle</h2>';
$htmlContent .= '<p>Die verantwortliche Stelle für die Datenverarbeitung ist:<br>';
$htmlContent .= '<strong>AI Forum</strong><br>';
$htmlContent .= 'Adresse: [Ihre Adresse hier einfügen]<br>';
$htmlContent .= 'E-Mail: [Ihre E-Mail-Adresse hier einfügen]</p>';

$htmlContent .= '<h2>3. Welche Daten wir erheben</h2>';
$htmlContent .= '<p>Wir erheben die folgenden Daten, wenn Sie sich registrieren oder Beiträge erstellen:</p>';
$htmlContent .= '<ul>';
$htmlContent .= '<li><strong>Benutzername</strong>: Zur Identifikation und Anzeige bei Ihren Beiträgen.</li>';
$htmlContent .= '<li><strong>Passwort</strong>: Verschlüsselt gespeichert, um Ihr Konto zu schützen.</li>';
$htmlContent .= '<li><strong>Beitragsdaten</strong>: Titel und Inhalt Ihrer Beiträge sowie Datum und Uhrzeit der Erstellung.</li>';
$htmlContent .= '<li><strong>Technische Daten</strong>: IP-Adresse, Browser-Typ und Geräteinformationen (nur zu Sicherheitszwecken).</li>';
$htmlContent .= '</ul>';

$htmlContent .= '<h2>4. Wie wir Ihre Daten verwenden</h2>';
$htmlContent .= '<p>Ihre Daten werden verwendet, um:</p>';
$htmlContent .= '<ul>';
$htmlContent .= '<li>Ihr Konto zu verwalten und Ihnen den Zugang zum Forum zu ermöglichen.</li>';
$htmlContent .= '<li>Ihre Beiträge anzuzeigen und Interaktionen im Forum zu ermöglichen.</li>';
$htmlContent .= '<li>Die Sicherheit des Forums zu gewährleisten (z. B. durch Protokollierung von IP-Adressen bei verdächtigen Aktivitäten).</li>';
$htmlContent .= '</ul>';

$htmlContent .= '<h2>5. Weitergabe Ihrer Daten</h2>';
$htmlContent .= '<p>Wir geben Ihre Daten nicht an Dritte weiter, außer:</p>';
$htmlContent .= '<ul>';
$htmlContent .= '<li>Wenn dies gesetzlich vorgeschrieben ist (z. B. bei einer behördlichen Anfrage).</li>';
$htmlContent .= '<li>Zum Schutz der Rechte und Sicherheit des AI Forums oder seiner Nutzer.</li>';
$htmlContent .= '</ul>';

$htmlContent .= '<h2>6. Ihre Rechte</h2>';
$htmlContent .= '<p>Gemäß der DSGVO haben Sie folgende Rechte:</p>';
$htmlContent .= '<ul>';
$htmlContent .= '<li><strong>Auskunftsrecht</strong>: Sie können Auskunft über die von uns gespeicherten Daten verlangen.</li>';
$htmlContent .= '<li><strong>Berichtigungsrecht</strong>: Sie können die Berichtigung unrichtiger Daten verlangen.</li>';
$htmlContent .= '<li><strong>Löschungsrecht</strong>: Sie können die Löschung Ihrer Daten verlangen (sofern keine gesetzlichen Aufbewahrungspflichten bestehen).</li>';
$htmlContent .= '<li><strong>Widerspruchsrecht</strong>: Sie können der Verarbeitung Ihrer Daten widersprechen.</li>';
$htmlContent .= '</ul>';
$htmlContent .= '<p>Um diese Rechte auszuüben, kontaktieren Sie uns bitte unter der oben angegebenen E-Mail-Adresse.</p>';

$htmlContent .= '<h2>7. Datensicherheit</h2>';
$htmlContent .= '<p>Wir setzen technische und organisatorische Maßnahmen ein, um Ihre Daten zu schützen, einschließlich:</p>';
$htmlContent .= '<ul>';
$htmlContent .= '<li>Verschlüsselung von Passwörtern.</li>';
$htmlContent .= '<li>Regelmäßige Sicherheitsüberprüfungen.</li>';
$htmlContent .= '<li>Einschränkung des Zugriffs auf Ihre Daten.</li>';
$htmlContent .= '</ul>';

$htmlContent .= '<h2>8. Änderungen dieser Datenschutzrichtlinie</h2>';
$htmlContent .= '<p>Wir können diese Datenschutzrichtlinie gelegentlich aktualisieren. Die aktuelle Version wird auf dieser Seite veröffentlicht, und wir informieren Sie über wesentliche Änderungen.</p>';

$htmlContent .= '<h2>9. Kontakt</h2>';
$htmlContent .= '<p>Bei Fragen zur Datenschutzrichtlinie oder zur Verarbeitung Ihrer Daten wenden Sie sich bitte an:<br>';
$htmlContent .= 'E-Mail: madhuripatidar49@gmail.com<br>';
$htmlContent .= 'Datum der letzten Aktualisierung: 25. März 2025</p>';

$htmlContent .= '</div>';
$htmlContent .= '</div>';
$htmlContent .= '</section>';

$tpl_index->set("content", $htmlContent);
?>