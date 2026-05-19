<?php 
include('config.php'); 
$id_p = $_GET['id'] ?? 0;
$prodotto = $prodotti[$id_p] ?? null;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>NVXS | <?php echo $prodotto ? $prodotto['model'] : 'Prodotto'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');</style>
</head>
<body class="bg-white" style="font-family: 'Archivo', sans-serif;">
    <?php include('header.php'); ?>
    
    <main class="max-w-7xl mx-auto px-6 py-20">
        <?php if ($prodotto): ?>
            <div class="flex flex-col md:flex-row gap-16 items-center">
                
                <div class="md:w-1/2 bg-gray-50 p-10 rounded-2xl border-4 border-black">
                    <img src="<?php echo $prodotto['img']; ?>" 
                         onerror="this.onerror=null; this.src='https://placehold.co/600x400/000000/ffffff?text=NVXS';" 
                         class="w-full drop-shadow-2xl" alt="<?php echo $prodotto['model']; ?>">
                </div>
                
                <div class="md:w-1/2">
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2"><?php echo $prodotto['type']; ?></p>
                    <h1 class="text-5xl font-black uppercase italic mb-2"><?php echo $prodotto['brand']; ?></h1>
                    <h2 class="text-2xl text-gray-600 mb-6"><?php echo $prodotto['model']; ?></h2>
                    <p class="text-gray-500 leading-relaxed mb-8 font-medium"><?php echo $prodotto['desc']; ?></p>
                    
                    <div class="bg-gray-50 border-2 border-black p-6 mb-8">
                        <p class="text-xs font-bold uppercase text-gray-400">Prezzo</p>
                        <p class="text-4xl font-black <?php echo $prodotto['type'] == 'sneaker' ? 'text-green-600' : 'text-blue-600'; ?>">
                            €<?php echo number_format($prodotto['price'], 0, ',', '.'); ?>
                        </p>
                    </div>

                    <form method="GET" class="w-full">
                        <input type="hidden" name="id" value="<?php echo $id_p; ?>">

                        <?php if ($prodotto['type'] == 'sneaker'): ?>
                            <div class="mb-8">
                                <label for="taglia" class="text-xs font-black uppercase text-black block mb-3 tracking-widest">
                                    Seleziona Taglia (EU) <span class="text-red-600">*</span>
                                </label>
                                <select name="taglia" id="taglia" required 
                                        class="w-full border-2 border-black bg-transparent p-4 font-bold uppercase text-sm outline-none focus:border-green-600 focus:bg-gray-50 transition-colors cursor-pointer appearance-none">
                                    <option value="" disabled selected>Scegli la tua misura...</option>
                                    <?php for ($i = 36; $i <= 47; $i++): ?>
                                        <option value="<?php echo $i; ?>">EU <?php echo $i; ?></option>
                                        <option value="<?php echo $i + 0.5; ?>">EU <?php echo $i + 0.5; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <div class="flex gap-4">
                            <button type="submit" formaction="gestione_carrello.php" name="azione" value="aggiungi"
                                    class="flex-1 bg-black text-white py-5 font-black uppercase italic hover:bg-green-600 transition shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)] hover:shadow-none hover:translate-y-1 hover:translate-x-1">
                                Aggiungi al carrello
                            </button>
                            
                            <button type="submit" formaction="offerta.php"
                                    class="flex-1 border-4 border-black py-5 font-black uppercase italic hover:bg-black hover:text-white transition shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-y-1 hover:translate-x-1">
                                Fai Offerta
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-20 border-4 border-black bg-gray-50">
                <h1 class="text-4xl font-black uppercase italic mb-4">Prodotto non trovato</h1>
                <p class="text-gray-500 font-bold uppercase mb-8">L'articolo che stai cercando non esiste o è stato rimosso.</p>
                <a href="index.php" class="inline-block bg-black text-white px-8 py-4 font-black uppercase italic hover:bg-gray-800 transition">Torna alla Home</a>
            </div>
        <?php endif; ?>
    </main>

    <?php include('footer.php'); ?>
</body>
</html>