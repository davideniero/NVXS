<?php 
include('config.php'); 

$sneakers_totali = array_filter($prodotti, function($p) {
    return $p['type'] == 'sneaker';
});

$sneakers_anteprima = array_slice($sneakers_totali, 0, 5, true);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>NVXS | Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,900;1,900&display=swap');</style>
</head>
<body class="bg-white" style="font-family: 'Archivo', sans-serif;">
    
    <?php include('header.php'); ?>

    <section class="h-[60vh] flex items-center justify-center bg-gray-50 text-center border-b-4 border-black">
        <div>
            <h1 class="text-8xl uppercase italic font-black leading-none mb-6 tracking-tighter">NVXS MARKET</h1>
            <p class="text-xl text-gray-500 mb-10 italic uppercase font-bold tracking-widest">Sneakers & Pokémon Trading Cards Marketplace</p>
            <div class="flex justify-center gap-6">
                <a href="sneakers.php" class="bg-black text-white px-10 py-4 font-black uppercase italic hover:bg-green-600 transition transform hover:-translate-y-1 shadow-lg">Shop Sneakers</a>
                <a href="pokemon.php" class="bg-black text-white px-10 py-4 font-black uppercase italic hover:bg-blue-600 transition transform hover:-translate-y-1 shadow-lg">Shop Pokémon</a>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="flex flex-col sm:flex-row justify-between items-baseline mb-10 border-b-4 border-black pb-4">
            <h2 class="text-4xl font-black uppercase italic tracking-tight">
                Sneakers
            </h2>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Le più vendute</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-12">
            <?php foreach($sneakers_anteprima as $id_p => $p): ?>
                <a href="prodotto.php?id=<?php echo $id_p; ?>" class="block group border-2 border-black p-4 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-all bg-white">
                    <div class="bg-gray-50 flex items-center justify-center h-48 mb-4 overflow-hidden border border-gray-200 p-2">
                        <img src="<?php echo $p['img']; ?>" 
                             onerror="this.onerror=null; this.src='https://placehold.co/600x400/000000/ffffff?text=NVXS';" 
                             class="max-h-full max-w-full object-contain group-hover:scale-110 transition duration-500" 
                             alt="<?php echo $p['model']; ?>">
                    </div>
                    <h3 class="font-black text-lg uppercase italic leading-none mb-1 truncate"><?php echo $p['brand']; ?></h3>
                    <p class="text-gray-400 text-[11px] font-bold uppercase truncate mb-4"><?php echo $p['model']; ?></p>
                    <p class="text-xl font-black text-green-600">
                        €<?php echo number_format($p['price'], 0, ',', '.'); ?>
                    </p>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12">
            <a href="sneakers.php" class="inline-block border-4 border-black bg-white text-black px-12 py-5 font-black uppercase italic text-lg hover:bg-black hover:text-white transition-colors duration-300 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-none transform hover:translate-x-1 hover:translate-y-1">
                Vedi Tutte le Sneakers →
            </a>
        </div>
    </main>

    <?php include('footer.php'); ?>

</body>
</html>