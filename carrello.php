<?php 
include('config.php'); 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$utente_id = $_SESSION['user_id'];
$_SESSION['carrello'] = $_SESSION['carrello'] ?? [];
$stmt_offerte = $db->prepare("SELECT * FROM offerte WHERE utente_id = ? AND stato = 'ACCETTATA'");
$stmt_offerte->bind_param("i", $utente_id);
$stmt_offerte->execute();
$risultato_offerte = $stmt_offerte->get_result();

if ($risultato_offerte->num_rows > 0) {
    while ($offerta_accettata = $risultato_offerte->fetch_assoc()) {
        $prod_id = $offerta_accettata['prodotto_id'];
        $offerta_db_id = $offerta_accettata['id'];
        $prezzo_pattuito = $offerta_accettata['prezzo_offerta'];
        
        $taglia_offerta = $offerta_accettata['taglia'] ?? 'none';
        
        $chiave_carrello = $prod_id . '_offerta_' . $offerta_db_id;

        $_SESSION['carrello'][$chiave_carrello] = [
            'id' => $prod_id,
            'taglia' => $taglia_offerta,
            'quantita' => 1,
            'prezzo_speciale' => $prezzo_pattuito 
        ];

        $stmt_update_offerta = $db->prepare("UPDATE offerte SET stato = 'IN_CARRELLO' WHERE id = ?");
        $stmt_update_offerta->bind_param("i", $offerta_db_id);
        $stmt_update_offerta->execute();
        $stmt_update_offerta->close();
    }
}
$stmt_offerte->close();
foreach ($_SESSION['carrello'] as $chiave => $info) {
    if (!is_array($info) || !isset($info['id'])) {
        unset($_SESSION['carrello'][$chiave]);
    }
}
$carrello = $_SESSION['carrello']; 

$totale_carrello = 0;
$conteggio_articoli = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['conferma_pagamento'])) {
    if (!empty($carrello)) {
        $db->begin_transaction();

        try {
            $stmt = $db->prepare("INSERT INTO acquisti (utente_id, prodotto_id, prezzo_pagato, quantita) VALUES (?, ?, ?, ?)");
            
            foreach ($carrello as $chiave => $info) {
                $id_p = $info['id'];
                $quantita = $info['quantita'];
                
                if (isset($prodotti[$id_p])) {
                    $prezzo = isset($info['prezzo_speciale']) ? $info['prezzo_speciale'] : $prodotti[$id_p]['price'];
                    $stmt->bind_param("iiii", $utente_id, $id_p, $prezzo, $quantita);
                    $stmt->execute();
                }
            }
            $stmt->close();
            
            $db->commit();
            $_SESSION['carrello'] = [];
            $carrello = [];
            
            echo "<script>alert('Acquisto completato con successo!'); window.location.href='index.php';</script>";
        } catch (Exception $e) {
            $db->rollback();
            echo "<script>alert('Errore durante l\'elaborazione dell\'ordine.');</script>";
        }
    }
}

if (isset($_GET['rimuovi'])) {
    $chiave_da_rimuovere = $_GET['rimuovi'];
    if (isset($_SESSION['carrello'][$chiave_da_rimuovere])) {
        unset($_SESSION['carrello'][$chiave_da_rimuovere]);
    }
    header("Location: carrello.php");
    exit();
}

foreach ($carrello as $chiave => $info) {
    if (isset($prodotti[$info['id']])) {
        $prezzo_da_usare = isset($info['prezzo_speciale']) ? $info['prezzo_speciale'] : $prodotti[$info['id']]['price'];
        $totale_carrello += $prezzo_da_usare * $info['quantita'];
        $conteggio_articoli += $info['quantita'];
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>NVXS | Il Tuo Carrello</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');</style>
</head>
<body class="bg-white" style="font-family: 'Archivo', sans-serif;">
    
    <?php include('header.php'); ?>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="border-b-4 border-black pb-4 mb-12">
            <h1 class="text-5xl font-black uppercase italic tracking-tight">Il tuo Carrello</h1>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Riepilogo dei tuoi articoli pronti al checkout</p>
        </div>

        <?php if (empty($carrello)): ?>
            <div class="text-center py-20 border-4 border-black bg-gray-50">
                <h2 class="text-3xl font-black uppercase italic mb-4">Il carrello è vuoto</h2>
                <a href="index.php" class="inline-block bg-black text-white px-10 py-4 font-black uppercase italic hover:bg-gray-800 transition">Torna allo Store</a>
            </div>
        <?php else: ?>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                
                <div class="lg:col-span-2 space-y-6">
                    <?php foreach ($carrello as $chiave => $info): 
                        $id_p = $info['id'];
                        $taglia_selezionata = $info['taglia'] ?? '';
                        $quantita = $info['quantita'];
                        $p = $prodotti[$id_p];
                    ?>
                        <div class="flex items-center gap-6 border-4 border-black p-6 bg-white shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                            <div class="w-28 h-28 bg-gray-50 border border-gray-200 flex-shrink-0 flex items-center justify-center p-2">
                                <img src="<?php echo $p['img']; ?>" class="max-h-full max-w-full object-contain" alt="">
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <h2 class="font-black text-xl uppercase italic leading-none mb-1 truncate"><?php echo $p['brand']; ?></h2>
                                <p class="text-gray-400 text-xs font-bold uppercase truncate mb-3"><?php echo $p['model']; ?></p>
                                
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <?php if ($p['type'] === 'sneaker' && $taglia_selezionata && $taglia_selezionata !== 'none'): ?>
                                        <div class="inline-block bg-gray-100 border border-black px-3 py-1 text-xs font-black uppercase tracking-wider">
                                            Taglia: <span class="text-green-600">EU <?php echo $taglia_selezionata; ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (isset($info['prezzo_speciale'])): ?>
                                        <div class="inline-block bg-amber-100 border border-amber-500 px-3 py-1 text-xs font-black text-amber-800 uppercase tracking-wider">
                                            Proposta Accettata
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="text-xs font-bold uppercase text-gray-500">
                                    Quantità: <span class="text-black font-black"><?php echo $quantita; ?></span>
                                </div>
                            </div>
                            
                            <div class="text-right flex flex-col items-end justify-between h-28">
                                <?php if (isset($info['prezzo_speciale'])): ?>
                                    <div class="text-right">
                                        <p class="text-[10px] text-amber-600 font-black uppercase mb-[-4px]">Prezzo Offerta</p>
                                        <p class="text-2xl font-black text-amber-600">
                                            €<?php echo number_format($info['prezzo_speciale'] * $quantita, 0, ',', '.'); ?>
                                        </p>
                                    </div>
                                <?php else: ?>
                                    <p class="text-2xl font-black text-black">
                                        €<?php echo number_format($p['price'] * $quantita, 0, ',', '.'); ?>
                                    </p>
                                <?php endif; ?>

                                <a href="carrello.php?rimuovi=<?php echo $chiave; ?>" class="text-xs font-black uppercase text-red-600 tracking-widest hover:underline pb-0.5 transition-all">
                                    Rimuovi
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="border-4 border-black p-8 bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="font-black text-2xl uppercase italic border-b-2 border-black pb-4 mb-6">Riepilogo Ordine</h3>
                    <div class="space-y-4 text-sm font-bold uppercase tracking-wider">
                        <div class="flex justify-between text-gray-500">
                            <span>Articoli totali</span>
                            <span><?php echo $conteggio_articoli; ?></span>
                        </div>
                        <div class="flex justify-between text-gray-500">
                            <span>Spedizione</span>
                            <span class="text-green-600 font-black">Gratuita</span>
                        </div>
                        <hr class="border-gray-300 my-4">
                        <div class="flex justify-between text-2xl font-black text-black">
                            <span>Totale</span>
                            <span>€<?php echo number_format($totale_carrello, 0, ',', '.'); ?></span>
                        </div>
                    </div>
                    
                    <form action="carrello.php" method="POST">
                        <button type="submit" name="conferma_pagamento" class="w-full text-center bg-black text-white py-4 font-black uppercase italic tracking-wider hover:bg-gray-800 transition transform hover:-translate-y-1 shadow-xl mt-8 block">
                            Procedi al Pagamento
                        </button>
                    </form>
                </div>

            </div>
        <?php endif; ?>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>