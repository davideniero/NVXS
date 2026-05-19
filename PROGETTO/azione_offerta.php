<?php
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$utente_id = $_SESSION['user_id'];
$id_offerta = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$azione = $_GET['azione'] ?? '';

$stmt_check = $db->prepare("SELECT ruolo FROM utenti WHERE id = ?");
$stmt_check->bind_param("i", $utente_id);
$stmt_check->execute();
$res_check = $stmt_check->get_result()->fetch_assoc();
$stmt_check->close();

if (!$res_check || $res_check['ruolo'] !== 'admin') {
    die("ACCESSO NEGATO: Solo gli amministratori possono gestire le offerte.");
}

if ($id_offerta > 0 && ($azione === 'accetta' || $azione === 'rifiuta')) {
    $nuovo_stato = ($azione === 'accetta') ? 'ACCETTATA' : 'RIFIUTATA';
    
    $stmt = $db->prepare("UPDATE offerte SET stato = ? WHERE id = ?");
    $stmt->bind_param("si", $nuovo_stato, $id_offerta);
    $stmt->execute();
    $stmt->close();
}

header("Location: dashboard_offerte.php");
exit();
?>