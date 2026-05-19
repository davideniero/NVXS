<?php 
include('config.php'); 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$utente_id = $_SESSION['user_id'];

// --- NUOVA LOGICA: CANCELLAZIONE DELLA PROPOSTA ---
if (isset($_GET['azione']) && $_GET['azione'] === 'cancella_offerta' && isset($_GET['id_offerta'])) {
    $id_offerta = (int)$_GET['id_offerta'];

    // Elimina l'offerta SOLO se appartiene all'utente loggato e se è ancora "IN ATTESA"
    $stmt_delete = $db->prepare("DELETE FROM offerte WHERE id = ? AND utente_id = ? AND stato = 'IN ATTESA'");
    $stmt_delete->bind_param("ii", $id_offerta, $utente_id);
    
    if ($stmt_delete->execute()) {
        header("Location: dashboard_offerte.php?successo=1");
        exit();
    } else {
        $errore_canc = "Impossibile annullare l'offerta.";
    }
    $stmt_delete->close();
}

$stmt_ruolo = $db->prepare("SELECT ruolo FROM utenti WHERE id = ?");
$stmt_ruolo->bind_param("i", $utente_id);
$stmt_ruolo->execute();
$res_ruolo = $stmt_ruolo->get_result()->fetch_assoc();
$stmt_ruolo->close();

$is_admin = ($res_ruolo && $res_ruolo['ruolo'] === 'admin');

if ($is_admin) {
    $query = "SELECT * FROM offerte ORDER BY creato_il DESC";
    $risultato = $db->query($query);
} else {
    $stmt_offerte = $db->prepare("SELECT * FROM offerte WHERE utente_id = ? ORDER BY creato_il DESC");
    $stmt_offerte->bind_param("i", $utente_id);
    $stmt_offerte->execute();
    $risultato = $stmt_offerte->get_result();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>NVXS | <?php echo $is_admin ? 'Pannello Admin Offerte' : 'Le Mie Offerte'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');</style>
</head>
<body class="bg-white text-black" style="font-family: 'Archivo', sans-serif;">
    <?php include('header.php'); ?>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-6xl font-black uppercase italic mb-10 border-b-4 border-black pb-4">
            <?php echo $is_admin ? 'Pannello Admin Offerte' : 'Le Mie Offerte Inviate'; ?>
        </h1>

        <?php if (isset($_GET['successo'])): ?>
            <div class="bg-green-100 border-l-4 border-green-600 text-green-700 p-4 mb-8 font-bold uppercase text-xs tracking-wider">
                Proposta annullata con successo!
            </div>
        <?php endif; ?>

        <?php if ($risultato->num_rows === 0): ?>
            <div class="text-center py-20 border-2 border-dashed border-gray-200">
                <p class="text-xl font-bold uppercase text-gray-400">Nessuna offerta da mostrare.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full border-4 border-black text-left uppercase text-sm font-bold tracking-wider">
                    <thead class="bg-black text-white text-xs">
                        <tr>
                            <th class="p-4">Prodotto</th>
                            <th class="p-4">Prezzo Listino</th>
                            <th class="p-4">Offerta Proposta</th>
                            <th class="p-4">Data</th>
                            <th class="p-4">Stato</th>
                            <th class="p-4 text-right">Azioni</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black">
                        <?php 
                        while ($off = $risultato->fetch_assoc()): 
                            $id_p = $off['prodotto_id'];
                            if (!isset($prodotti[$id_p])) continue;
                            $p = $prodotti[$id_p];
                        ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 flex items-center gap-4">
                                    <img src="<?php echo $p['img']; ?>" class="w-12 h-12 object-cover border border-black p-1 bg-white" alt="">
                                    <div>
                                        <p class="font-black italic"><?php echo $p['brand']; ?></p>
                                        <p class="text-xs text-gray-400"><?php echo $p['model']; ?></p>
                                        <p class="text-[10px] text-gray-500 font-normal">ID Utente: #<?php echo $off['utente_id']; ?></p>
                                    </div>
                                </td>
                                
                                <td class="p-4">€<?php echo number_format($p['price'], 0, ',', '.'); ?></td>
                                <td class="p-4 font-black text-lg text-amber-600">€<?php echo number_format($off['prezzo_offerta'], 0, ',', '.'); ?></td>
                                <td class="p-4 text-xs text-gray-500"><?php echo date("d/m/Y H:i", strtotime($off['creato_il'])); ?></td>
                                
                                <td>
                                    <div class="p-4">
                                        <?php if ($off['stato'] === 'IN ATTESA'): ?>
                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 text-xs font-black border border-yellow-400">In Attesa</span>
                                        <?php elseif ($off['stato'] === 'ACCETTATA'): ?>
                                            <span class="bg-green-100 text-green-800 px-3 py-1 text-xs font-black border border-green-400">Accettata</span>
                                        <?php else: ?>
                                            <span class="bg-red-100 text-red-800 px-3 py-1 text-xs font-black border border-red-400">Rifiutata</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                
                                <td class="p-4 text-right">
                                    <?php if ($is_admin): ?>
                                        <?php if ($off['stato'] === 'IN ATTESA'): ?>
                                            <div class="flex justify-end gap-2 text-xs font-black">
                                                <a href="azione_offerta.php?azione=accetta&id=<?php echo $off['id']; ?>" 
                                                   class="bg-green-600 text-white px-4 py-2 hover:bg-green-700 transition">
                                                    Accetta
                                                </a>
                                                <a href="azione_offerta.php?azione=rifiuta&id=<?php echo $off['id']; ?>" 
                                                   class="bg-black text-white px-4 py-2 hover:bg-gray-800 transition">
                                                    Rifiuta
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-xs text-gray-400 italic">Gestita</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if ($off['stato'] === 'IN ATTESA'): ?>
                                            <a href="dashboard_offerte.php?azione=cancella_offerta&id_offerta=<?php echo $off['id']; ?>" 
                                               onclick="return confirm('Sei sicuro di voler annullare questa proposta ufficiale?');"
                                               class="bg-red-600 text-white px-4 py-2 text-xs font-black hover:bg-red-700 transition inline-block">
                                                Annulla
                                            </a>
                                        <?php else: ?>
                                            <span class="text-xs text-gray-400 italic">-</span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>