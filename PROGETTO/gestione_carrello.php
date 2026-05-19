<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id_p = $_GET['id'] ?? null;
$azione = $_GET['azione'] ?? null;
$taglia = $_GET['taglia'] ?? null;

if ($id_p && $azione === 'aggiungi') {
    if (!isset($_SESSION['carrello'])) {
        $_SESSION['carrello'] = [];
    }

    $chiave_carrello = $id_p . '_' . ($taglia ? $taglia : 'none');

    if (isset($_SESSION['carrello'][$chiave_carrello])) {
        $_SESSION['carrello'][$chiave_carrello]['quantita']++;
    } else {
        $_SESSION['carrello'][$chiave_carrello] = [
            'id' => $id_p,
            'taglia' => $taglia,
            'quantita' => 1
        ];
    }
}

header("Location: carrello.php");
exit();
?>