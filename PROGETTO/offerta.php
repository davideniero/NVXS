<?php 
include('config.php'); 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id_prodotto = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$taglia_selezionata = isset($_GET['taglia']) ? $_GET['taglia'] : 'none';

if ($id_prodotto <= 0 || !isset($prodotti[$id_prodotto])) {
    die("Prodotto non valido.");
}

$prodotto = $prodotti[$id_prodotto];
$errore = "";
$successo = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prezzo_offerta = (int)$_POST['prezzo_offerta'];
    $taglia_da_salvare = isset($_POST['taglia']) ? $_POST['taglia'] : 'none';
    $utente_id = $_SESSION['user_id'];

    if ($prezzo_offerta > 0) {
        $limite_minimo = $prodotto['price'] * 0.5;
        
        if ($prezzo_offerta < $limite_minimo) {
            $errore = "L'offerta è troppo bassa! Deve essere almeno di €" . number_format($limite_minimo, 0, ',', '.');
        } else {
            $stmt = $db->prepare("INSERT INTO offerte (utente_id, prodotto_id, prezzo_offerta, taglia) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $utente_id, $id_prodotto, $prezzo_offerta, $taglia_da_salvare);
            
            if ($stmt->execute()) {
                $successo = "Offerta ufficiale inviata con successo! Se l'admin accetta, la troverai nel carrello.";
            } else {
                $errore = "Errore durante il salvataggio dell'offerta nel database.";
            }
            $stmt->close();
        }
    } else {
        $errore = "Inserisci un importo valido.";
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>NVXS | Fai un'Offerta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');</style>
</head>
<body class="bg-white" style="font-family: 'Archivo', sans-serif;">

    <?php include('header.php'); ?>

    <main class="max-w-4xl mx-auto px-6 py-16">
        <div class="border-b-4 border-black pb-4 mb-12">
            <h1 class="text-5xl font-black uppercase italic tracking-tight">Fai una Proposta</h1>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Tratta sul prezzo originale in modo ufficiale</p>
        </div>

        <?php if (!empty($errore)): ?>
            <div class="bg-red-100 border-2 border-red-600 text-red-800 p-4 font-bold uppercase text-sm mb-6">
                <?php echo $errore; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($successo)): ?>
            <div class="bg-green-100 border-2 border-green-600 text-green-800 p-4 font-bold uppercase text-sm mb-6">
                <?php echo $successo; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center border-4 border-black p-8 bg-white shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            
            <div class="flex gap-4 items-center">
                <img src="<?php echo $prodotto['img']; ?>" class="w-32 h-32 object-contain border border-gray-200 p-2" alt="">
                <div>
                    <h2 class="text-2xl font-black uppercase italic leading-none mb-1"><?php echo $prodotto['brand']; ?></h2>
                    <p class="text-sm text-gray-400 font-bold uppercase mb-2"><?php echo $prodotto['model']; ?></p>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-gray-500 uppercase">Prezzo Retail: <span class="text-black font-black">€<?php echo $prodotto['price']; ?></span></p>
                        <?php if ($taglia_selezionata !== 'none'): ?>
                            <p class="text-xs font-bold text-gray-500 uppercase">Taglia Scelta: <span class="text-green-600 font-black">EU <?php echo htmlspecialchars($taglia_selezionata); ?></span></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div>
                <form action="offerta.php?id=<?php echo $id_prodotto; ?>&taglia=<?php echo urlencode($taglia_selezionata); ?>" method="POST" class="space-y-6">
                    
                    <input type="hidden" name="taglia" value="<?php echo htmlspecialchars($taglia_selezionata); ?>">

                    <div class="flex flex-col">
                        <label class="text-xs font-black uppercase mb-2 tracking-widest text-gray-400">La Tua Offerta (In Euro)</label>
                        <div class="flex items-center border-b-4 border-black pb-2">
                            <span class="text-3xl font-black mr-2">€</span>
                            <input type="number" name="prezzo_offerta" required min="1" placeholder="Es: <?php echo round($prodotto['price'] * 0.9); ?>" 
                                   class="w-full bg-transparent text-3xl font-black outline-none placeholder-gray-300">
                        </div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold mt-2 tracking-wider">
                            Nota: L'offerta è vincolante. Se il venditore accetta, l'articolo verrà bloccato con la taglia selezionata.
                        </p>
                    </div>

                    <button type="submit" class="w-full bg-black text-white py-5 font-black uppercase italic tracking-wider hover:bg-gray-800 transition transform hover:-translate-y-1 shadow-xl">
                        Invia Offerta Ufficiale
                    </button>
                </form>
            </div>

        </div>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>